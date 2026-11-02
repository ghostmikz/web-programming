<?php
// Student: NAME, ID. File: check.php. Function: prints the logged in customer or manager id, empty if none.
include "common.php";
$role = $_GET["role"] ?? "";
if ($role == "customer" || $role == "manager") {
    echo $_SESSION[$role] ?? "";
}
