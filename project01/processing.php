<?php
include "common.php";

if (!isset($_SESSION["manager"])) {
    exit;
}

if (isset($_POST["process"])) {
    $lock = lock_file("goods.xml");
    $xml = load_xml("goods.xml", "goods");
    foreach ($xml->xpath("item[sold > 0]") as $item) {
        $item->sold = 0;
    }
    foreach ($xml->xpath("item[available = 0 and hold = 0]") as $item) {
        unset($item[0]);
    }
    save_xml($xml, "goods.xml");
    echo "The sold items have been processed";
} else {
    echo transform_goods("processing.xsl");
}
