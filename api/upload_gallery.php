<?php
include_once "./db.php";

if(!empty($_FILES['file']['name'])){
    move_uploaded_file($_FILES['file']['tmp_name'], "../gallery/{$_FILES['file']['name']}");
    $_POST['img'] = $_FILES['file']['name'];
}
$Gallery->update($_POST);

header("location:../index.php?do=upload_gallery");
?>