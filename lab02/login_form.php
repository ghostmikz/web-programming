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
    <form action="login.php" method="post">
        <h3>Нэвтрэх</h3>
        Id: <input type="text" name="id" required>
        <br>Pass: <input type="password" name="pass" required>
        <br><input type="submit" value="Нэвтрэх">
    </form>
    </div>
</body>
</html>
