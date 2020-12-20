<?php


$gameRoomId = $_POST["gameRoomId"];
//connect to db
include('includes/dbconfig.php');

//Remove GameRoom and references in gamePLayers and game Instance
$stmt1 = $pdo->prepare("DELETE FROM `gamePlayers` WHERE `gameRoomId` = '$gameRoomId'");

$stmt2 = $pdo->prepare("DELETE FROM `gameInstance` WHERE `gameRoomId` = '$gameRoomId'");

$stmt3 = $pdo->prepare("DELETE FROM `gameRoom` WHERE `gameRoomId` = '$gameRoomId'");

$stmt1->execute();
$stmt2->execute();
$stmt3->execute();


echo("Room Closed, Players Purged, GameInstance Closed");


?>
