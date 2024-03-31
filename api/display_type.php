<?php
// 接受來自dusk.js中的displayType function的請求，切換type資料表中指定版面的顯示狀態(0 or 1)
include_once "./db.php";
$target = $Type->search(['id'=>$_POST['id']]);

if($target['display']){
    echo 0;
    $target['display'] = 0;
    $Type->update($target);
}
else{
    echo 1;
    $target['display'] = 1;
    $Type->update($target);
}
?>