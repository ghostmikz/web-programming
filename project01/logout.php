<?php
include "common.php";

$customer = $_SESSION["customer"] ?? "";
$manager = $_SESSION["manager"] ?? "";

if (!empty($_SESSION["cart"])) {
    cancel_cart();
}
session_destroy();

if ($customer != "") {
    echo "Thanks for shopping with BuyOnline, your customer id is $customer";
} else if ($manager != "") {
    echo "Thanks for using BuyOnline, your manager id is $manager";
} else {
    echo "You are not logged in";
}
