<?php
include_once "./db.php";
$check = $GalleryLike->count(['gallery_id'=>$_POST['id'], 'user'=>$_POST['user']]);
$gallery = $Gallery->search(['id'=>$_POST['id']]);

if($check){
    $GalleryLike->delete(['gallery_id'=>$_POST['id'], 'user'=>$_POST['user']]);
    $gallery['like_count'] -= 1;
    $Gallery->update($gallery);
    echo 0;
}
else{
    $GalleryLike->update(['gallery_id'=>$_POST['id'], 'user'=>$_POST['user']]);
    $gallery['like_count'] += 1;
    $Gallery->update($gallery);
    echo 1;
}
?>