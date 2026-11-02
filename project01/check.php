<?php
include "common.php";
$role = $_GET["role"] ?? "";
if ($role == "customer" || $role == "manager") {
    echo $_SESSION[$role] ?? "";
}
