<?php 
//db-config.php
$dsn = "mysql:host=localhost;dbname=jeux;charset=utf8mb4";

$dbusername = "root";
$dbpassword = "root";
$pdo = new PDO($dsn, $dbusername, $dbpassword); 

?>