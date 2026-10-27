<?php
include "db.php";
$msg = "";

if (isset($_POST["name"])) {
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
        mysqli_query($conn, "INSERT INTO pet(name, owner, type, gender, birth) VALUES ('$name', '$owner', '$type', '$gender', '$birth')");
        $msg = "Data saved";
    }
}
?>
<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>Бүртгэл</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="pet.css">
</head>
<body>
    <?php include "../header.php"; ?>
    <div class="content pet">
    <?php include "menu.php"; ?>
    <h3>PET Registration</h3>
    <form action="register.php" method="post">
        <div class="grid">
            <label>Name:<input type="text" name="name" maxlength="20" required></label>
            <label>Owner:<input type="text" name="owner" maxlength="20" required></label>
            <label>Type:
                <select name="type">
                    <option>Dog</option>
                    <option>Cat</option>
                    <option>Hamster</option>
                    <option>Snake</option>
                    <option>Bird</option>
                </select>
            </label>
            <label>Gender:
                <select name="gender">
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                </select>
            </label>
            <label>Birth:<input type="date" name="birth" required></label>
        </div>
        <input type="submit" value="Save"> <input type="reset" value="reset">
    </form>
    <p class="msg"><?php echo $msg; ?></p>
    </div>
</body>
</html>
