<?php
// 接受來自dusk.js 中的 galleryDisplay function 的請求，用以檢查當前登入的使用者是否是圖片的上傳者
include_once "./db.php";
$gallery = $Gallery->search(['id'=>$_POST['id']]);
if($_POST['user']=="admin" || $_POST['user']==$gallery['user']) echo 1;
else echo 0;
?>