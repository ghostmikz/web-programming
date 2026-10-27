<?php
include "db.php";
$petid = (int) ($_REQUEST["petid"] ?? 0);
$msg = "";

if (isset($_POST["petid"])) {
    $name = mysqli_real_escape_string($conn, trim($_POST["name"]));
    $owner = mysqli_real_escape_string($conn, trim($_POST["owner"]));
    $type = mysqli_real_escape_string($conn, trim($_POST["type"]));
    $gender = $_POST["gender"];
    $birth = mysqli_real_escape_string($conn, $_POST["birth"]);

    if ($name == "" || $owner == "" || $type == "" || $birth == "") {
        $msg = "Бүх талбарыг бөглөнө үү";
    } else if ($gender != "m" && $gender != "f") {
        $msg = "Хүйс буруу байна";
    } else {
        mysqli_query($conn, "UPDATE pet SET name = '$name', owner = '$owner', type = '$type', gender = '$gender', birth = '$birth' WHERE petid = $petid");
        $msg = "Data updated";
    }
}
?>
<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>Засварлах</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="pet.css">
</head>
<body>
    <?php include "../header.php"; ?>
    <div class="content pet">
    <?php include "menu.php"; ?>
    <h3>PET Registration</h3>
    <form action="edit.php" method="post">
        <input type="hidden" name="petid" value="<?= $petid ?>">
        <div class="grid">
            <label>Name:<input type="text" name="name" maxlength="20" required value="<?= htmlspecialchars($_REQUEST["name"] ?? "") ?>"></label>
            <label>Owner:<input type="text" name="owner" maxlength="20" required value="<?= htmlspecialchars($_REQUEST["owner"] ?? "") ?>"></label>
            <label>Type:<input type="text" name="type" maxlength="20" required value="<?= htmlspecialchars($_REQUEST["type"] ?? "") ?>"></label>
            <label>Gender:
                <select name="gender">
                    <option value="m">Male</option>
                    <option value="f" <?php if (($_REQUEST["gender"] ?? "") == "f") echo "selected"; ?>>Female</option>
                </select>
            </label>
            <label>Birth:<input type="date" name="birth" required value="<?= htmlspecialchars($_REQUEST["birth"] ?? "") ?>"></label>
        </div>
        <input type="submit" value="Save"> <input type="reset" value="reset">
    </form>
    <p class="msg"><?php echo $msg; ?></p>
    </div>
</body>
</html>
