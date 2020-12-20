<?php
//start session
session_start();


$gameRoomId = $_GET["gameRoomId"];//Store Received room id From GET
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
        <div class="navigation">
            <img id="logo" src="images/jeux-logo.png" alt="Jeux logo" >
            <a href="logout.php" class="navLink"> Log Out: <?php echo ($userNameHost); ?></a>
            <a href="roomManagment.php" class="navLink"> Manage Rooms</a>
        </div>
        <section class="gameRoomSection">


            <div id="gameInfo">
                <div class='gameThumbnail gameRoom' style="background-image: url('<?php echo('images/'.$gameRow["gameImage"]);?>') ; background-size: cover">
                </div>

                <div class='gameRoomDescription'>
                    <h1> <?php echo($gameRow["name"]);?></h1>
                    <p class="smaller"> PLAYER AMOUNT :<?php echo($gameRow["playerLimit"]);?> </p>
                    <p> <?php echo($gameRow["description"]);?></p>
                    
                </div>

            </div>

            <div id="waitingRoomView">
                <div>
                    <h2> <?php echo($row["roomName"]);?> Room </h2>

                    <div id="playersActiveSection">
                    
                        <p><span>JOIN GAMEROOM: </span> www.jeux.com/joinGame.php</p>
                    
                        <div id="playersActive">
                        <?php 

                            for ($i=0; $i < $gameRow["playerLimit"]; $i++){
                               ?> 
                               <div>
                                    <p>Player Name</p>
                                    <div class="dottedCircle">
                                        
                                    </div>
                                </div>
                            <?php
                                
                            }
                        ?>
                        </div>
                    </div>

                </div>

                <div>
                    <p class="roomCode">Room Code: <?php echo($row["roomCode"]);?></p>
                    <a id="startGameButton" href="games/<?php echo($gameRow["gameLink"]);?>"> Start Game <i class="fas fa-play"></i></a>

                </div>
                
            

                
            </div>
        
        </section>

        

        <script>

            var waitingRoomScreen = document.querySelectorAll('#waitingRoom')[0];

            var playerActiveCircle = document.querySelectorAll('.dottedCircle');

            var playerActiveName = document.querySelectorAll('#playersActive> div > p');

            console.log(playerActiveCircle);
            console.log(playerActiveName);

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
                        console.log(activePlayers);

                        let playersList= "";
                        let name="";

                        for(i = 0; i < activePlayers.length; i++){
                            console.log(activePlayers[i].userName);
                            name =  activePlayers[i].userName;

                            playerActiveName[i].innerHTML = name;
                            
                            playersList = "<img src='images/"+ activePlayers[i].avatar + ".png'>";

                            playerActiveCircle[i].innerHTML = playersList;

                        }
                        console.log(playersList);

                        //playerActiveList.innerHTML = playersList;

                    }

                }

                xhr.open("GET","getPlayersGame.php?gameRoomId="+ gameRoomId,true); 
                xhr.send();
            }
            



        </script>

    </body>
</html>