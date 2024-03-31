<?php
// 接受dusk.js中的galleryDisplay function的請求並以json型式回傳gallery資料表中的指定資料
include_once "./db.php";
$gallery = $Gallery->search(['id'=>$_POST['id']]);
echo json_encode($gallery);
?>