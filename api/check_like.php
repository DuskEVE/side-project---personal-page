<?php
// 接受來自dusk.js 中的 galleryDisplay function 的請求，用以檢查當前登入的使用者對於圖片按讚的狀態
include_once "./db.php";
$check = $GalleryLike->count(['gallery_id'=>$_POST['id'], 'user'=>$_POST['user']]);

echo $check;
?>