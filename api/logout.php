<?php
// 透過清除session來登出使用者
include_once "./db.php";

unset($_SESSION['user']);
unset($_SESSION['admin']);

?>