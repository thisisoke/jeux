<?php
//start session
session_start();

$emailAddress = $_POST["emailAddress"];
$password = $_POST["password"];


include('includes/dbconfig.php');

$stmt = $pdo->prepare("SELECT * FROM `hostUser`
WHERE `emailAddress` = '$emailAddress' AND `password` = '$password'");

$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if($row){
    //session declarations
    $_SESSION["userName"] = $row["userName"];
    $_SESSION["hostId"] = $row["hostId"];
    //successful login
    echo("Succesful Login");
} else {
    //incorrect input
    echo("Can't log you in as a Host, something is wrong with your email or password");

}