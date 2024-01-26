<?php
include_once "./db.php";
if(is_array($_POST['id'])){
    foreach($_POST['id'] as $index=>$id){
        if(isset($_POST['del']) && in_array($id, $_POST['del'])){
            $News->delete(['id'=>$id]);
            continue;
        }

        $news = $News->search(['id'=>$id]);
        $news['display'] = (isset($_POST['display'])&&in_array($id, $_POST['display'])? 1:0);
        $News->update($news);
    }
}
else $News->update($_POST);

header("location:../index.php?ad=news");
?>