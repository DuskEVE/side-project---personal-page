<?php
include_once "./db.php";
$datas = [];
foreach($_GET as $key=>$value){
    $str = "$key=$value";
    array_push($datas, $str);
}
$datas = join("&", $datas);
echo file_get_contents("https://api.steampowered.com/ISteamNews/GetNewsForApp/v2/?$datas");
?>