<?php
class Conversion {
    public $input;
    public $output;
    public $description;
}

session_start();

if (!isset($_SESSION["history"])) {
    $_SESSION["history"] = array();
}

$i = $_GET["i"] ?? "";
$t = $_GET["t"] ?? 1;
$ans = "";
$name = "";

if ($i !== "") {
    switch ($t) {
        case 1: $ans = $i * 2.54 . "см";
            $name = "Инч - СМ";
            break;
        case 2: $ans = $i * 1.6 . "км";
            $name = "Бээр - КМ";
            break;
        case 3: $ans = $i * 745 . "ватт";
            $name = "Морины хүч - Ватт";
            break;
        case 4: $ans = $i * 453 . "грамм";
            $name = "Паунд - Грамм";
            break;
        case 5: $ans = $i * 158 . "литр";
            $name = "Баррель - Литр";
            break;
    }

    $c = new Conversion();
    $c->input = $i;
    $c->output = $ans;
    $c->description = $name;

    array_push($_SESSION["history"], $c);
    if (count($_SESSION["history"]) > 5) {
        array_shift($_SESSION["history"]);
    }
}
?>
<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>Unit convertor</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include "../header.php"; ?>
    <div class="content">
    <form action="convert_lab03.php" method="get">
    <table align="center">
        <tr>
            <td>Утга хөрвүүлэх</td>
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
                    <option value="2">Бээр - КМ</option>
                    <option value="3">Морины хүч - Ватт</option>
                    <option value="4">Паунд - Грамм</option>
                    <option value="5">Баррель - Литр</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                Нэгжийн Утга<br>
                <input type="text" value="<?= $ans ?>">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="хувиргах">
                <input type="button" value="цуцлах" onclick="location.href = 'convert_lab03.php'">
            </td>
        </tr>
    </table>
    </form>

    <p align="center">хөрвүүлсэн сүүлийн 5 утга</p>
    <table align="center" border="1">
        <tr><th>No</th><th>Нэгж</th><th>Оролт</th><th>Гаралт</th></tr>
        <?php
        $h = array_reverse($_SESSION["history"]);
        for ($k = 0; $k < count($h); $k++) {
            echo "<tr><td>" . ($k + 1) . "</td><td>" . $h[$k]->description . "</td><td>" . $h[$k]->input . "</td><td>" . $h[$k]->output . "</td></tr>";
        }
        ?>
    </table>
    </div>
</body>
</html>
