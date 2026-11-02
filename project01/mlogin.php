<?php
include "common.php";

$id = trim($_POST["managerid"] ?? "");
$password = trim($_POST["password"] ?? "");

if ($id == "" || $password == "") {
    echo "Please enter your manager id and password";
    exit;
}

foreach (file(DATA . "manager.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
    $parts = array_map("trim", explode(",", $line));
    if ($parts[0] == $id && ($parts[1] ?? "") == $password) {
        $_SESSION["manager"] = $id;
        echo "OK";
        exit;
    }
}
echo "Invalid manager id or password";
