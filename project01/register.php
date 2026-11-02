<?php
include "common.php";

$email = trim($_POST["email"] ?? "");
$firstname = trim($_POST["firstname"] ?? "");
$surname = trim($_POST["surname"] ?? "");
$password = $_POST["password"] ?? "";
$password2 = $_POST["password2"] ?? "";
$phone = trim($_POST["phone"] ?? "");

$lock = lock_file("customer.xml");
$xml = load_xml("customer.xml", "customers");

$used = false;
foreach ($xml->customer as $c) {
    if (strtolower($c->email) == strtolower($email)) {
        $used = true;
    }
}

if ($email == "" || $firstname == "" || $surname == "" || $password == "" || $password2 == "") {
    echo "Please fill in all fields except the phone number";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email address is not valid";
} else if ($password != $password2) {
    echo "The two passwords are not the same";
} else if ($phone != "" && !preg_match('/^(\(0\d\)\d{8}|0\d \d{8})$/', $phone)) {
    echo "Phone number must look like (0d)dddddddd or 0d dddddddd";
} else if ($used) {
    echo "This email address is already registered";
} else {
    $id = next_id($xml, "customer/id");
    $customer = $xml->addChild("customer");
    $customer->id = $id;
    $customer->firstname = $firstname;
    $customer->surname = $surname;
    $customer->email = $email;
    $customer->password = password_hash($password, PASSWORD_DEFAULT);
    $customer->phone = $phone;
    save_xml($xml, "customer.xml");
    echo "Registration successful. Your customer id is: $id";
}
