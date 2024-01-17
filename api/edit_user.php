<?php
include_once "./db.php";
$origin = $User->search(['id'=>$_POST['id']]);
$check = ($origin['user']==$_POST['user']? 0:$User->count(['user'=>$_POST['user']]));

if($check) echo "該帳號已被註冊!";
else{
    $User->update($_POST);
    echo "success";
}
?>