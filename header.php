<?php $lab = basename(dirname($_SERVER["PHP_SELF"])); ?>
<div class="header">
    <select onchange="location.href = this.value">
        <option value="../lab01/convert.php" <?= $lab == "lab01" ? "selected" : "" ?>>Lab 1</option>
        <option value="../lab02/login_form.php" <?= $lab == "lab02" ? "selected" : "" ?>>Lab 2</option>
        <option value="../lab03/convert_lab03.php" <?= $lab == "lab03" ? "selected" : "" ?>>Lab 3</option>
        <option value="../lab04/poll.php" <?= $lab == "lab04" ? "selected" : "" ?>>Lab 4</option>
        <option value="../lab05/list.php" <?= $lab == "lab05" ? "selected" : "" ?>>Lab 5</option>
    </select>
</div>
