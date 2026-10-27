<?php
include "db.php";
$petid = (int) $_GET["petid"];
mysqli_query($conn, "DELETE FROM pet WHERE petid = $petid");
header("Location: list.php");
