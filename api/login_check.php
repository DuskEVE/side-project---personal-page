<?php
// 接受來自dusk.js 中的 login function 的請求，用以檢查登入的使用者帳號密碼是否正確
include_once "./db.php";

if(isset($_POST['user']) && isset($_POST['password'])){
    $check = $User->count(['user'=>$_POST['user']]);
    if($check){
        $user = $User->search(['user'=>$_POST['user']]);
        if(password_verify($_POST['password'], $user['password'])){
            $_SESSION['user'] = $_POST['user'];
            if($user['admin'] == 1) $_SESSION['admin'] = 1;
            echo "success";
        }
        else echo "密碼錯誤!";
    }
    else echo "此帳號不存在!";
}
else if(!isset($_POST['user'])) echo "請輸入使用者帳號!";
else if(!isset($_POST['password'])) echo "請輸入使用者密碼!";

?>