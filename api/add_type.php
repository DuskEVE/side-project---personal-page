<?php
include_once "./db.php";
$_POST['display'] = 1;
$Type->update($_POST);

header("location:../index.php?ad=main");
?>