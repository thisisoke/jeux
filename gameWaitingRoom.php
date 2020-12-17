<?php
//start session
session_start();


$gameRoomId = 7;//$_GET["gameRoomId"];//Store Received room id From GET
$userName = $_SESSION["userNamePlayer"]; //use player username
$userNameHost = $_SESSION["userNameHost"]; //Store host if comming from host

$_SESSION["gameRoomId"] = $gameRoomId; //Store Room Id in session

//connect to db
include('includes/dbconfig.php');

//Get Room Details to populate the page for Host
$stmt = $pdo->prepare("SELECT * FROM `gameRoom` WHERE `gameRoomId` = '$gameRoomId'");

$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

//get game id of room created
$gameId = $row["gameId"];

//Get game being played from the game ID 
$stmt2 = $pdo->prepare("SELECT * FROM `games` WHERE `gameId` = '$gameId' ");

$stmt2->execute();

$gameRow = $stmt2->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>

<html>
    <head>

    <?php include('globalheader.php'); ?>
    
    </head>
    <body>
    
        <section class="gameRoomSection">

        <div id="waitingRoomView">
            <h1> <?php echo($gameRow["name"]);?></h>
            <p> <?php echo($gameRow["description"]);?></p>
            <img src='images/<?php echo($gameRow["gameImage"]);?>' alt='game image' width='400'>
            <h2> <?php echo($row["roomName"]);?> Room </h2>
            <p>This is the room Code: <?php echo($row["roomCode"]);?></p>
            <a href="games/<?php echo($gameRow["gameLink"]);?>"> Start Game Button</a>

            <p> Players Amount:<?php echo($gameRow["playerLimit"]);?> </p>
            <div id="playersActive">
                <p> Players here: <?php echo($userHostActive);?> </p>
            </div>
        </div>
        
        </section>

        <footer id="footer">
            <p>footer<p>
        </footer>

        <script>

            var waitingRoomScreen = document.querySelectorAll('#waitingRoomView')[0];

            var playerActiveList = document.querySelectorAll('#playersActive')[0];

            var gameRoomId = <?php echo($gameRoomId)?>;

            //Update the active list of players every 2seconds. Call update Active Players
            setInterval(updateActivePlayers, 2000);


            function updateActivePlayers(){
                console.log("Interval is called to get activePlayers");

                //Call database  GAME PLAYERS to get updated list of users 
                //Open up a asynchronous AJAX Connection
                var xhr = new XMLHttpRequest(); 
                xhr.onreadystatechange = function(e){     
                    //console.log(xhr.readyState); 
                    if(xhr.readyState === 4){ 

                        let activePlayers = JSON.parse(this.responseText);
                        //console.log(activePlayers);

                        let playersList= "";

                        for(i = 0; i < activePlayers.length; i++){
                            playersList += "<p> "+ activePlayers[i].userName + "</p>";

                        }
                        console.log(playersList);

                        playerActiveList.innerHTML = playersList;

                    }

                }

                xhr.open("GET","getPlayersGame.php?gameRoomId="+ gameRoomId,true); 
                xhr.send();
            }
            



        </script>

    </body>
</html>