<?php
include_once "./db.php";
if(is_array($_POST['id'])){
    foreach($_POST['id'] as $index=>$id){
        if(isset($_POST['del']) && in_array($id, $_POST['del'])) $News->delete(['id'=>$id]);
    }
}
else $News->update($_POST);