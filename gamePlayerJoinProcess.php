<?php
//start session
session_start();


//store the players username in the session variable
$roomCode = $_POST["roomCode"];
$userNamePlayer = $_POST["userNamePlayer"];
$avatar = $_POST["avatar"];


//connect to db
include('includes/dbconfig.php');


//Find GameRoom
$stmt = $pdo->prepare("SELECT * FROM `gameRoom` WHERE `gameCode` = '$roomCode'");

$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
//Store Needed Variables
$gameRoomId = $row["gameRoomId"];


//Insert player into Game Players Table
$stmt3 = $pdo->prepare("INSERT INTO `gamePlayers`(`playerId`, `userName`, `points`, `gameRoomId`, `avatar`) VALUES  (NULL,'$userNamePlayer', '0', '$gameRoomId', '$avatar');");

$stmt3->execute();




if (true){

    echo($gameRoomId);
    //store the players username in the session
    $_SESSION["userNamePlayer"] = $userNamePlayer;


} else {

    echo("The Game Room Does Not Exist");

}

?>






