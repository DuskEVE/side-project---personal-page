<?php
include_once "./db.php";
foreach($_SESSION as $key=>$value){
    unset($_SESSION[$key]);
}
?>