<?php
//connect to db
include('includes/dbconfig.php');

//Get articles that are featured
$stmt = $pdo->prepare("SELECT * FROM `games` WHERE `featuredGameFlag` = 1 ");

$quote ='"';
$stmt->execute();
$featuredGames = array(); 

for ($i = 0; $i < 2; $i++){
    //print_r($i);
    $test = $stmt->fetch(PDO::FETCH_NAMED);

    // $test2 = $stmt->fetch(PDO::FETCH_ASSOC);

    array_push($featuredGames, $test);
}


// while($result = $stmt->fetch(PDO::FETCH_ASSOC)){

//     //print_r($i);
//     $test = $stmt->fetch(PDO::FETCH_NAMED);
//     array_push($featuredGames, $test);


// }

$featuredGamesJSON = json_encode($featuredGames);


// print_r($featuredGames);
// print_r($test);
//print_r($test2[0]);
echo $featuredGamesJSON;
//echo($quote);



?>
