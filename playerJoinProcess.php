<?php
//start session
session_start();


//store the players username in the session variable
$roomCode = $_POST["roomCode"];
$userNamePlayer = $_POST["userNamePlayer"];
$avatar = $_POST["avatar"];


//connect to db
include('includes/dbconfig.php');


//Find The GameRoom
$stmt = $pdo->prepare("SELECT * FROM `gameRoom` WHERE `roomCode` = '$roomCode'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
//Store The gameRoom Id from the game room that was found 
$gameRoomId = $row["gameRoomId"];
//store gameId to identify which game is being played
$gameId = $row["gameId"];
// echo("gameRoomId:".$gameRoomId);
// echo("gameid:".$gameId);


//Find How many players allowed in Game
$stmt2 = $pdo->prepare("SELECT * FROM `games` WHERE `gameId` = '$gameId'");
$stmt2->execute();
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
//Store the player Limit for the game in the game room
$gamePlayerLimit = $row2["playerLimit"];
//echo("gamePlayers:".$gamePlayerLimit);





//Count how many players are already in the room. 
$stmt3 = $pdo->prepare("SELECT COUNT(playerId) FROM `gamePlayers` WHERE `gameRoomId` = '$gameRoomId' ");
//excecute statement to count
$stmt3->execute();
$count = $stmt3->fetch(PDO::FETCH_ASSOC);
$activePlayers = $count["COUNT(playerId)"];
//echo("activePlayers:".$activePlayers);



//if Game room exists and theres room to be a player
//COMPARE how many players allowed for game VERSUS how many gamePlayers are in room
if (isset($gameRoomId) && ($activePlayers < $gamePlayerLimit)) {

    //Insert player into Game Players Table
    $stmt4 = $pdo->prepare("INSERT INTO `gamePlayers`(`playerId`, `userName`, `points`, `gameRoomId`, `avatar`) VALUES  (NULL,'$userNamePlayer', '0', '$gameRoomId', '$avatar');");

    $stmt4->execute();

    //store the players username in the session
    $_SESSION["userNamePlayer"] = $userNamePlayer;

    echo($gameRoomId);
    //echo("Welcome");

    //if game Room Exits && room is full
} else if (isset($gameRoomId) && ($activePlayers >= $gamePlayerLimit)) {
    echo ("ROOM FULL");

    //game Room Does not Exits
} else if ($gameRoomId == NULL){

    echo("Game Room Does Not Exist");

}

?>






