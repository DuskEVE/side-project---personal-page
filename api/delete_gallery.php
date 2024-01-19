<?php
include_once "./db.php";
$Gallery->delete(['id'=>$_POST['id']]);
?>