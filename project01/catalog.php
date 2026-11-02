<?php
include "common.php";
if (isset($_SESSION["customer"])) {
    echo transform_goods("catalog.xsl");
}
