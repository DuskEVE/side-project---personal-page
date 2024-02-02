<?php
include_once "./db.php";
if($_GET['type_id'] == 0) echo $News->count(['display'=>1]);
else echo $News->count($_GET);
?>