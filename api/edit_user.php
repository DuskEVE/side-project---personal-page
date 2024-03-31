<?php
// 接受來自dusk.js中的editUser function的請求並修改user資料表中指定的資料
include_once "./db.php";
$origin = $User->search(['id'=>$_POST['id']]);
$check = ($origin['user']==$_POST['user']? 0:$User->count(['user'=>$_POST['user']]));

if($check) echo "該帳號已被註冊!";
else{
    $User->update($_POST);
    echo "success";
}
?>