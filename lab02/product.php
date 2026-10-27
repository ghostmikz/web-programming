<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login_form.php");
    exit;
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Бүтээгдэхүүн</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include "../header.php"; ?>
    <div class="content">
    <p>Сайн байна уу, <?php echo $_SESSION["username"]; ?></p>
    <table border="1">
        <tr><th>Product</th><th>Price</th></tr>
        <?php
        foreach (file("product.txt") as $line) {
            $i = strrpos($line, " ");
            echo "<tr><td>" . substr($line, 0, $i) . "</td><td>" . substr($line, $i) . "</td></tr>";
        }
        ?>
    </table>
    <br><a href="logout.php">LOGOUT</a>
    </div>
</body>
</html>
