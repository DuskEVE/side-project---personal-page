<?php
include_once "./db.php";
$gallery = $Gallery->search(['id'=>$_POST['id']])['img'];
echo $gallery;
?>