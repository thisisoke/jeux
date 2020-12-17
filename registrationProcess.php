<?php
//start session
session_start();



//receive inputs
$userName = $_POST["userName"];
$emailAddress= $_POST["emailAddress"];
$avatar= $_POST["avatar"];
$password = $_POST["password"];

//connect to db
include('includes/dbconfig.php');

//CHECK IF Username EXIST ALREADY
$stmt1 = $pdo->prepare("SELECT * FROM `hostUser`
WHERE `userName` = '$userName'");

$stmt1->execute();

$row = $stmt1->fetch(PDO::FETCH_ASSOC);

if($row){
    
    //username exist so you cannot register. Tell FrontEnd
    echo("Username is not available");
    
} else {
    //user name doesnt exist, so you can register


    $stmt = $pdo->prepare("INSERT INTO `hostUser`(`hostId`, `userName`, `emailAddress`, `password`, `created_at`, `avatarHost`) VALUES  (NULL, '$userName', '$emailAddress', '$password', NULL, $avatar);");

    $stmt->execute();

    //Get the Generated Host Id BY checking if the user was added in the DB and using the credentials in the session
    $stmt1 = $pdo->prepare("SELECT * FROM `hostUser`
    WHERE `emailAddress` = '$emailAddress' AND `password` = '$password'");

    $stmt1->execute();

    $row = $stmt1->fetch(PDO::FETCH_ASSOC);

    //session declarations. Make the Session the user that just signed up
    $_SESSION["userNameHost"] = $row["userName"];
    $_SESSION["hostId"] = $row["hostId"];

    //Echo a success message to front end
    echo("Success");


}


