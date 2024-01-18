<?php
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