<?php

//receive inputs
$hostId = $_POST["hostId"];
$roomName= $_POST["roomName"];
$roomCode= $_POST["roomCode"];
$gameId = $_POST["gameId"];

//connect to db
include('includes/dbconfig.php');

$stmt = $pdo->prepare("INSERT INTO `gameRoom`(`gameRoomId`, `hostId`, `gameId`, `roomName`, `roomCode`, `created_at`) VALUES  (NULL, '$hostId', '$gameId', '$roomName', '$roomCode', NULL);");

$stmt->execute();


//Get the DB Created Room Id
$stmt1 = $pdo->prepare("SELECT * FROM `gameRoom`
WHERE `hostId` = '$hostId' AND `roomCode` = '$roomCode'");

$stmt1->execute();

$row = $stmt1->fetch(PDO::FETCH_ASSOC);


echo($row["gameRoomId"]);


?>



