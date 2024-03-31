<?php
// 接受來自dusk.js 中的 reg function 的請求，用以檢查註冊的使用者帳號是否已被使用，並且將新註冊的使用者資料寫入user資料表
include_once "./db.php";
$check = $User->count(['user'=>$_POST['user']]);

if($check) echo "該帳號已被註冊!";
else{
    $_POST['admin'] = 0;
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $User->update($_POST);
    $_SESSION['user'] = $_POST['user'];
    echo "success";
}
?>