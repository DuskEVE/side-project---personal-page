<?php
// 接受dusk.js中的updateNewsPop function的請求並以json型式回傳news資料表中的指定資料
include_once "./db.php";
echo json_encode($Type->searchAll($_GET));
?>