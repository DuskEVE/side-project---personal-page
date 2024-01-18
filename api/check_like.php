<?php
include_once "./db.php";
$check = $GalleryLike->count(['gallery_id'=>$_POST['id'], 'user'=>$_POST['user']]);

echo $check;
?>