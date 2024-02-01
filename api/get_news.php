<?php
include_once "./db.php";
$news;
if(isset($_POST['id'])) $news = $News->search(['id'=>$_POST['id']]);
else if(isset($_GET['type_id'])){
    $target = [];
    $option = $_GET['option'];
    unset($_GET['option']);
    if($_GET['type_id'] != 0) $target = ['type_id'=>$_GET['type_id']];
    $news = $News->searchAll($target, $option);
}
echo json_encode($news);
?>