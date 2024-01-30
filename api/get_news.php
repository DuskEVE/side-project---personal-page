<?php
include_once "./db.php";
$news;
if(isset($_POST['id'])) $news = $News->search(['id'=>$_POST['id']]);
else if(isset($_POST['type_id'])){
    $target = [];
    $option = $_POST['option'];
    unset($_POST['option']);
    if($_POST['type_id'] != 0) $target = ['type_id'=>$_POST['type_id']];
    $news = $News->searchAll($target, $option);
}
echo json_encode($news);
?>