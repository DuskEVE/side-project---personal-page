<?php
// 接受來自使用者管理頁面的請求並修改或刪除指定的使用者
include_once "./db.php";

foreach($_POST['id'] as $id){
    $data = ['id'=>$id, 'admin'=>0];
    if(isset($_POST['del']) && in_array($id, $_POST['del'])) $User->delete(['id'=>$id]);
    else if(isset($_POST['admin']) && in_array($id, $_POST['admin'])) $data['admin'] = 1;

    $User->update($data);
}

header("location:../index.php?ad=account");
?>