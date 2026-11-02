<?php
// Student: NAME, ID. File: catalog.php. Function: returns the catalog table, made from goods.xml with catalog.xsl.
include "common.php";
if (isset($_SESSION["customer"])) {
    echo transform_goods("catalog.xsl");
}
