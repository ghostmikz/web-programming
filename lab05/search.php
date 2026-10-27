<?php
include "db.php";
$search = $_GET["search"] ?? "";
$s = mysqli_real_escape_string($conn, $search);
$result = mysqli_query($conn, "SELECT * FROM pet WHERE name LIKE '%$s%'");
?>
<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>Хайлт</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="pet.css">
</head>
<body>
    <?php include "../header.php"; ?>
    <div class="content pet">
    <?php include "menu.php"; ?>
    <form action="search.php" method="get">
        Name: <input type="text" name="search" value="<?= htmlspecialchars($search) ?>">
        <input type="submit" value="Search">
    </form>
    <br>
    <table border="1">
        <tr><th>Name</th><th>Owner</th><th>Gender</th><th>Type</th><th>Birth</th><th>Action</th></tr>
        <?php
        while ($r = mysqli_fetch_assoc($result)) {
            $name = htmlspecialchars($r["name"]);
            $owner = htmlspecialchars($r["owner"]);
            $type = htmlspecialchars($r["type"]);
            $edit = "edit.php?petid=$r[petid]&name=" . urlencode($r["name"]) . "&owner=" . urlencode($r["owner"]) . "&gender=$r[gender]&type=" . urlencode($r["type"]) . "&birth=$r[birth]";
            echo "<tr><td>$name</td><td>$owner</td><td>$r[gender]</td><td>$type</td><td>$r[birth]</td>";
            echo "<td><a href='delete.php?petid=$r[petid]' onclick=\"return confirm('Delete?')\">Delete</a>, <a href='$edit'>Edit</a></td></tr>";
        }
        ?>
    </table>
    </div>
</body>
</html>
