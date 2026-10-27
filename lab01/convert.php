<?php
$i = $_GET["i"];
$t = $_GET["t"];
$ans = "";

if ($i !== "") {
    switch ($t) {
        case 1: $ans = $i * 2.54 . "см";
            break;
        case 2: $ans = $i * 1.6 . "км";
            break;
        case 3: $ans = $i * 745 . "ватт";
            break;
        case 4: $ans = $i * 453 . "грамм";
            break;
        case 5: $ans = $i * 158 . "литр";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit convertor</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include "../header.php"; ?>
    <div class="content">
    <form action="convert.php" method="get">
    <table align="center" class="convertor">
        <tr>
            <td>Утга хөрвүүлэх</td>
            <td>
                <select>
                    <option>lab01</option>
                    <option>lab02</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                Хувиргах Утга<br>
                <input type="number" name="i" value="<?= $i ?>">
            </td>
            <td>
                Хувиргах Төрөл<br>
                <select name="t">
                    <option value="1">Инч - СМ</option>
                    <option value="2">Майл - КМ</option>
                    <option value="3">Морины хүч - Ватт</option>
                    <option value="4">Паунд - грамм</option>
                    <option value="5">Баррель -литр</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                Нэгжийн Утга<br>
                <input type="text" name="ans" value="<?= $ans ?>">
            </td>
        </tr>
        <tr>
            <td>
                <input class="submitt" type="submit" value="хувиргах">
                <input type="button" value="цуцлах" onclick="location.href = 'convert.php'">
            </td>
        </tr>
    </table>
    </form>
    </div>
</body>
</html>
