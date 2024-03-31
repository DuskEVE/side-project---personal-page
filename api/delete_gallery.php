<?php
// 接受來自dusk.js中的galleryDelete function的請求，從gallery資料表中刪除指定的圖片
include_once "./db.php";
$Gallery->delete(['id'=>$_POST['id']]);
?>