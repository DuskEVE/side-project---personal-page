<?php
// 接受來自./front/upload_gallery.php的表單請求，將接收到的圖片檔案移動到./gallery並且將資料寫入gallery資料表
include_once "./db.php";

if(!empty($_FILES['file']['name'])){
    move_uploaded_file($_FILES['file']['tmp_name'], "../gallery/{$_FILES['file']['name']}");
    $_POST['img'] = $_FILES['file']['name'];
}
$Gallery->update($_POST);

header("location:../index.php?do=upload_gallery");
?>