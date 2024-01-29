<?php
include_once "./db.php";
$news = $News->search(['id'=>$_POST['id']]);
echo json_encode($news);
?>