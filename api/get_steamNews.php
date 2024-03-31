<?php
// 接受來自./front/news.php 的getNews function的請求，向steam提供的開放api發出請求並回傳取得的json資料
include_once "./db.php";
$datas = [];
foreach($_GET as $key=>$value){
    $str = "$key=$value";
    array_push($datas, $str);
}
$datas = join("&", $datas);
echo file_get_contents("https://api.steampowered.com/ISteamNews/GetNewsForApp/v2/?$datas");
?>