<?php
//connect to db
include('includes/dbconfig.php');

$getCondition = $_GET["featured"]; //can be 1 or 0. Featured is for 1 all is O


if ($getCondition == 1){

    //Get games that are featured
    $stmt = $pdo->prepare("SELECT * FROM `games` WHERE `featuredGameFlag` = 1 ");

    //Count how many featured
    $stmt2 = $pdo->prepare("SELECT COUNT(gameId) FROM `games` WHERE `featuredGameFlag` = 1 ");


} else {

    //Get all games
    $stmt = $pdo->prepare("SELECT * FROM `games`");

    //Count how many games exit
    $stmt2 = $pdo->prepare("SELECT COUNT(gameId) FROM `games`");

}

//excute statement to get actual table data
$stmt->execute();
$featuredGames = array(); 

//excecute statement to count
$stmt2->execute();
$count = $stmt2->fetch(PDO::FETCH_ASSOC);
$countNum = $count["COUNT(gameId)"];


for ($i = 0; $i < $countNum; $i++){
   
    $test = $stmt->fetch(PDO::FETCH_NAMED);
    array_push($featuredGames, $test);
}


$featuredGamesJSON = json_encode($featuredGames);

//echo the JSON array object of a list of games and details for front end use
echo $featuredGamesJSON;




?>
