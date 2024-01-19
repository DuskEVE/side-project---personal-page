<?php
include_once "./db.php";
$gallery = $Gallery->search(['id'=>$_POST['id']]);
if($_POST['user']=="admin" || $_POST['user']==$gallery['user']) echo 1;
else echo 0;
?>