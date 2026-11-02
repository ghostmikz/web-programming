<?php
// Student: NAME, ID. File: listing.php. Function: validates a new item and adds it to goods.xml.
include "common.php";

if (!isset($_SESSION["manager"])) {
    echo "Please log in first";
    exit;
}

$name = trim($_POST["name"] ?? "");
$price = trim($_POST["price"] ?? "");
$quantity = trim($_POST["quantity"] ?? "");
$description = trim($_POST["description"] ?? "");

if ($name == "" || $price == "" || $quantity == "" || $description == "") {
    echo "Please fill in all fields";
} else if (!is_numeric($price) || $price <= 0) {
    echo "Item price must be a number greater than 0";
} else if (!ctype_digit($quantity) || $quantity == 0) {
    echo "Item quantity must be a whole number greater than 0";
} else {
    $lock = lock_file("goods.xml");
    $xml = load_xml("goods.xml", "goods");
    $number = next_id($xml, "item/number");
    $item = $xml->addChild("item");
    $item->number = $number;
    $item->name = $name;
    $item->price = $price;
    $item->available = $quantity;
    $item->description = $description;
    $item->hold = 0;
    $item->sold = 0;
    save_xml($xml, "goods.xml");
    echo "The item has been listed in the system, and the item number is: $number";
}
