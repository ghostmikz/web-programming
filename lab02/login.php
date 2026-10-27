<?php
session_start();

$valid_id   = "admin";
$valid_pass = "123";

$id   = $_POST["id"] ?? "";
$pass = $_POST["pass"] ?? "";

if ($id === $valid_id && $pass === $valid_pass) {
    $_SESSION["username"] = $id;
    header("Location: product.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>Нэвтрэх</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include "../header.php"; ?>
    <div class="content">
        <p>Нэр эсвэл нууц үг буруу байна.</p>
        <a href="login_form.php">Буцах</a>
    </div>
</body>
</html>
