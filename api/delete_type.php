<?php
// 接受來自dusk.js中的deleteType function的請求，從type資料表中刪除指定的版面
include_once "./db.php";
$Type->delete(['id'=>$_POST['id']]);
?>