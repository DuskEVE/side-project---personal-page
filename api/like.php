<?php
include_once "./db.php";
$check = $GalleryLike->count(['gallery_id'=>$_POST['id'], 'user'=>$_POST['user']]);

if($check){
    $GalleryLike->delete(['gallery_id'=>$_POST['id'], 'user'=>$_POST['user']]);
    echo 0;
}
else{
    $GalleryLike->update(['gallery_id'=>$_POST['id'], 'user'=>$_POST['user']]);
    echo 1;
}
?>