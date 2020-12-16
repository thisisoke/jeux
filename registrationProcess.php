<?php
//start session
session_start();



//receive inputs
$userName = $_POST["userName"];
$emailAddress= $_POST["emailAddress"];
$avatar= $_POST["avatar"];
$password = $_POST["password"];

$_SESSION["userName"] = $username;

//connect to db
include('includes/dbconfig.php');

//CHECK IF Username EXIST ALREADY
$stmt1 = $pdo->prepare("SELECT * FROM `hostUser`
WHERE `userName` = '$userName'");

$stmt1->execute();

$row = $stmt1->fetch(PDO::FETCH_ASSOC);

if($row){
    //session declarations
    $_SESSION["userName"] = $row["userName"];
    
    //username exist so you cannot register. Tell FrontEnd
    echo("Username is not available");
    
} else {
    //user name doesnt exist, so you can register

    $stmt = $pdo->prepare("INSERT INTO `hostUser`(`hostId`, `userName`, `emailAddress`, `password`, `created_at`, `avatarHost`) VALUES  (NULL, '$username', '$emailAddress', '$password', NULL, $avatar);");

    $stmt->execute();

    echo("Success");

}


