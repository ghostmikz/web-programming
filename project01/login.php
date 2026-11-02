<?php
include "common.php";

$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if ($email == "" || $password == "") {
    echo "Please enter your email address and password";
    exit;
}

$xml = load_xml("customer.xml", "customers");
foreach ($xml->customer as $c) {
    if (strtolower($c->email) == strtolower($email) && password_verify($password, $c->password)) {
        $_SESSION["customer"] = (string) $c->id;
        echo "OK";
        exit;
    }
}
echo "Invalid email address or password";
