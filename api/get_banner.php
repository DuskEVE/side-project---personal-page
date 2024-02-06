<?php
include_once "./db.php";
echo json_encode($Banner->search($_GET));
?>