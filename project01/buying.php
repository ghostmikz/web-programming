<?php
include "common.php";

if (!isset($_SESSION["customer"])) {
    exit;
}

$action = $_POST["action"] ?? "view";
$number = (int) ($_POST["number"] ?? 0);
$reply = new SimpleXMLElement("<cart/>");
$_SESSION["cart"] = $_SESSION["cart"] ?? [];

if ($action == "add") {
    $lock = lock_file("goods.xml");
    $xml = load_xml("goods.xml", "goods");
    $item = find_item($xml, $number);
    if ($item && (int) $item->available > 0) {
        $item->available = (int) $item->available - 1;
        $item->hold = (int) $item->hold + 1;
        save_xml($xml, "goods.xml");
        $_SESSION["cart"][$number] = ($_SESSION["cart"][$number] ?? 0) + 1;
    } else {
        $reply["unavailable"] = "1";
    }
} else if ($action == "remove") {
    $quantity = $_SESSION["cart"][$number] ?? 0;
    $lock = lock_file("goods.xml");
    $xml = load_xml("goods.xml", "goods");
    $item = find_item($xml, $number);
    if ($item) {
        $item->available = (int) $item->available + $quantity;
        $item->hold = (int) $item->hold - $quantity;
        save_xml($xml, "goods.xml");
    }
    unset($_SESSION["cart"][$number]);
} else if ($action == "confirm") {
    $lock = lock_file("goods.xml");
    $xml = load_xml("goods.xml", "goods");
    $total = 0;
    foreach ($_SESSION["cart"] as $no => $quantity) {
        $item = find_item($xml, $no);
        $item->hold = (int) $item->hold - $quantity;
        $item->sold = (int) $item->sold + $quantity;
        $total += $quantity * (float) $item->price;
    }
    save_xml($xml, "goods.xml");
    $_SESSION["cart"] = [];
    $reply["confirmed"] = round($total, 2);
} else if ($action == "cancel") {
    cancel_cart();
    $reply["cancelled"] = "1";
}

$xml = load_xml("goods.xml", "goods");
$total = 0;
foreach ($_SESSION["cart"] as $no => $quantity) {
    $price = find_item($xml, $no)->price;
    $row = $reply->addChild("item");
    $row->number = $no;
    $row->price = $price;
    $row->quantity = $quantity;
    $total += $quantity * (float) $price;
}
$reply["total"] = round($total, 2);

header("Content-Type: text/xml");
echo $reply->asXML();
