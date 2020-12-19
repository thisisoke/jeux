<?php

//This php script gets all game players for a particular 
//connect to db
include('includes/dbconfig.php');

$gameRoomId = $_GET["gameRoomId"]; //gameroomId 


    //Get players in a game room
    $stmt = $pdo->prepare("SELECT * FROM `gamePlayers` WHERE `gameRoomId` = $gameRoomId ");

    //Count how many featured
    $stmt2 = $pdo->prepare("SELECT COUNT(gameRoomId) FROM `gamePlayers` WHERE `gameRoomId` = $gameRoomId = 1 ");


//excute statement to get actual table data
$stmt->execute();
$featuredGames = array(); 

//excecute statement to count
$stmt2->execute();
$count = $stmt2->fetch(PDO::FETCH_ASSOC);
$countNum = $count["COUNT(gameRoomId)"];


//Cycle through the game players and create an array fo the results
for ($i = 0; $i < $countNum; $i++){
   
    $test = $stmt->fetch(PDO::FETCH_NAMED);
    array_push($featuredGames, $test);
}


$featuredGamesJSON = json_encode($featuredGames);

//echo the JSON array object of a list of games and details for front end use
echo $featuredGamesJSON;


?>
