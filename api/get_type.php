<?php
include_once "./db.php";
echo json_encode($Type->searchAll($_GET));
?>