<?php
$lines = file("poll.txt", FILE_IGNORE_NEW_LINES);
$question = $lines[0];
$votes = explode(",", $lines[1]);
$msg = "";

if (isset($_POST["answer"])) {
    if (isset($_COOKIE["voted"])) {
        $msg = "Дахин санал өгөх боломжгүй";
    } else {
        $votes[$_POST["answer"]]++;
        file_put_contents("poll.txt", $question . "\n" . implode(",", $votes) . "\n");
        setcookie("voted", "1", time() + 180);
    }
}

$total = array_sum($votes);
?>
<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>Санал асуулга</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="poll.css">
</head>
<body>
    <?php include "../header.php"; ?>
    <div class="content poll">
    <h3>САНАЛ АСУУЛГА</h3>
    <p class="question"><?= $question ?></p>
    <form action="poll.php" method="post">
        <label class="option"><input type="radio" name="answer" value="0" required> Тийм</label>
        <label class="option"><input type="radio" name="answer" value="1"> Үгүй</label>
        <label class="option"><input type="radio" name="answer" value="2"> Мэдэхгүй</label>
        <input type="submit" value="САНАЛ ӨГӨХ"> <span class="total">(Нийт санал: <?= $total ?>)</span>
    </form>
    <p class="error"><?= $msg ?></p>
    </div>
</body>
</html>
