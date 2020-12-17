<?php
//start session to keep it allive
session_start();

//receive inputs
$hostId = $_POST["hostId"];
$roomName= $_POST["roomName"];
$roomCode= $_POST["roomCode"];
$gameId = $_POST["gameId"];


//connect to db
include('includes/dbconfig.php');

$stmt = $pdo->prepare("INSERT INTO `gameRoom`(`gameRoomId`, `hostId`, `gameId`, `roomName`, `roomCode`, `created_at`) VALUES  (NULL, '$hostId', '$gameId', '$roomName', '$roomCode', NULL);");

$stmt->execute();

//Get the gameRoomId that was just created
$stmt1 = $pdo->prepare("SELECT * FROM `gameRoom`
WHERE `hostId` = '$hostId' AND `roomCode` = '$roomCode'");

$stmt1->execute();

$row = $stmt1->fetch(PDO::FETCH_ASSOC);
//Store game roomId in gameRoom
$gameRoomId = $row["gameRoomId"];


//Get Host information to add as a player 
$stmt2 = $pdo->prepare("SELECT * FROM `hostUser`
WHERE `hostId` = '$hostId' ");

$stmt2->execute();
$userRow = $stmt2->fetch(PDO::FETCH_ASSOC);
$userName = $userRow["userName"];
$avatar = $userRow["avatarHost"];


//Add Host as a player to Game Players
$stmt3 = $pdo->prepare("INSERT INTO `gamePlayers`(`playerId`, `playerNum`, `userName`, `points`, `gameRoomId`, `avatar`) VALUES  (NULL, '1', '$userName', '0', '$gameRoomId', '$avatar');");

$stmt3->execute();




echo($gameRoomId);


?>



