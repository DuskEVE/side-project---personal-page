<?php
include_once "./db.php";
$check = $User->count(['user'=>$_POST['user']]);

if($check) echo "該帳號已被註冊!";
else{
    $_POST['admin'] = 0;
    $User->update($_POST);
    $_SESSION['user'] = $_POST['user'];
    echo "success";
}
?>