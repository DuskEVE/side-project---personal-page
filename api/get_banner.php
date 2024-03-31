<?php
// 接受./front/news.php中的switchBanner function的請求並以json型式回傳banner資料表中的指定資料
include_once "./db.php";
echo json_encode($Banner->search($_GET));
?>