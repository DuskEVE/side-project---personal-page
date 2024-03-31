<?php
// 接受來自新增版面modal (./modal/add_type.php)的表單請求並新增版面進type資料表
include_once "./db.php";
$_POST['display'] = 1;
$Type->update($_POST);

header("location:../index.php?ad=main");
?>