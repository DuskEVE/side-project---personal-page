<?php
// 接受來自編輯版面橫幅modal (./modal/edit_banner.php)的表單請求並修改banner資料表中指定的資料
include_once "./db.php";
$banner['type_id'] = $_POST['id'];
$check = $Banner->count(['type_id'=>$banner['type_id']]);
if($check) $banner['id'] = $Banner->search(['type_id'=>$banner['type_id']])['id'];

if(!empty($_FILES['file']['name'])){
    move_uploaded_file($_FILES['file']['tmp_name'], "../banner/{$_FILES['file']['name']}");
    $banner['img'] = $_FILES['file']['name'];
}
$Banner->update($banner);

header("location:../index.php?ad=main");
?>