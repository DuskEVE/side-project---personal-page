<?php
// 接受dusk.js中的like function的請求並新增或刪除galleryLike資料表中的資料以及修改gallery資料表中指定資料的like_count
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