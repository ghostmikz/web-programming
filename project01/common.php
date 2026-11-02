<?php
// Student: NAME, ID. File: common.php. Function: data folder, XML load/save and cart helpers used by the other PHP files.
session_start();

define("DATA", __DIR__ . "/data/");

// Keep other requests out while this one changes the file. Released when the script ends.
function lock_file($file) {
    $handle = fopen(DATA . $file, "c");
    flock($handle, LOCK_EX);
    return $handle;
}

// Load an XML file, or start a new one if it does not exist yet.
function load_xml($file, $root) {
    if (is_file(DATA . $file) && filesize(DATA . $file) > 0) {
        return simplexml_load_file(DATA . $file);
    }
    return new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><$root/>");
}

function save_xml($xml, $file) {
    $doc = new DOMDocument();
    $doc->preserveWhiteSpace = false;
    $doc->formatOutput = true;
    $doc->loadXML($xml->asXML());
    $doc->save(DATA . $file);
}

// The next id is one more than the biggest id already used.
function next_id($xml, $path) {
    $max = 0;
    foreach ($xml->xpath($path) as $id) {
        $max = max($max, (int) $id);
    }
    return $max + 1;
}

function find_item($xml, $number) {
    $found = $xml->xpath("item[number = " . (int) $number . "]");
    return $found ? $found[0] : null;
}

// Turn goods.xml into HTML with a stylesheet.
function transform_goods($stylesheet) {
    $xsl = new DOMDocument();
    $xsl->load(__DIR__ . "/" . $stylesheet);
    $processor = new XSLTProcessor();
    $processor->importStylesheet($xsl);
    $xml = load_xml("goods.xml", "goods");
    return $processor->transformToXML(dom_import_simplexml($xml)->ownerDocument);
}

// Put everything in the cart back on sale and empty the cart.
function cancel_cart() {
    $lock = lock_file("goods.xml");
    $xml = load_xml("goods.xml", "goods");
    foreach ($_SESSION["cart"] ?? [] as $number => $quantity) {
        $item = find_item($xml, $number);
        if ($item) {
            $item->available = (int) $item->available + $quantity;
            $item->hold = (int) $item->hold - $quantity;
        }
    }
    save_xml($xml, "goods.xml");
    $_SESSION["cart"] = [];
}
