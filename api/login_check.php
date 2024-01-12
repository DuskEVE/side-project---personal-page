<?php
include_once "./db.php";

if(isset($_POST['user']) && isset($_POST['password'])){
    $check = $User->count($_POST);
    if($check){
        $_SESSION['user'] = $_POST['user'];
        $data = $User->search($_POST);
        if($data['admin'] == 1) $_SESSION['admin'] = 1;
        echo "success";
    }
    else echo "帳號或密碼錯誤!";
}
else if(!isset($_POST['user'])) echo "請輸入使用者帳號!";
else if(!isset($_POST['password'])) echo "請輸入使用者密碼!";

?>