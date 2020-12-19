<?php
//Get all rooms Host as sarted to be able to delete
//Javascript can delete the room
//start session
session_start();

$hostInSession = $_SESSION["userNameHost"];
$hostId = $_SESSION["hostId"];


//connect to db
include('includes/dbconfig.php');

//Get Room Details to populate the page for Host
$stmt = $pdo->prepare("SELECT * FROM `gameRoom` WHERE `hostId` = '$hostId'");

$stmt->execute();


?>

<!DOCTYPE html>

<html>
    <head>

    <?php include('globalheader.php'); ?>
    
    </head>
    <body>
        <div class="navigation">
            <img id="logo" src="images/jeux-logo.png" alt="Jeux logo" >
            <a href="logout.php" class="navLink"> Log Out: <?php echo ($hostInSession); ?></a>
            <a href="roomManagment.php" class="navLink"> Open Rooms</a>
        </div>

        <?php
        while($result= $stmt->fetch(PDO::FETCH_NAMED)){

            //STORE IN ARRAY FOR JAVA SCRIPT TO BE ABLE TO DELETE
            ?>

            <h1> <?php echo($result["roomName"])?> </h1>
            <h1> <?php echo($result["roomCode"])?> </h1>


             

        <?php

            $gameRoomId = $result["gameRoomId"];

            $stmt2 = $pdo->prepare("SELECT * FROM `gamePlayers` WHERE `gameRoomId` = '$gameRoomId'");

             $stmt2->execute();

            while($player= $stmt2->fetch(PDO::FETCH_NAMED)){

                ?>

                <h1> <?php echo($player["userName"])?> </h1>
                <h1> <?php echo($player["points"])?> </h1>
                <h1> <?php echo($player["avatar"])?> </h1>

            <?php

            }


        }

        ?>
        <section class="gameRoomSection">


            <div id="gameInfo">
                <div class='gameThumbnail gameRoom' style="background-image: url('<?php echo('images/'.$gameRow["gameImage"]);?>') ; background-size: cover">
                </div>

                <div class='gameDescription'>
                    <h1> <?php echo($gameRow["name"]);?></h1>
                    <p class="smaller"> PLAYER AMOUNT :<?php echo($gameRow["playerLimit"]);?> </p>
                    <p> <?php echo($gameRow["description"]);?></p>
                    
                </div>

            </div>

            <div id="waitingRoomView">
                <div>
                    <h2> <?php echo($row["roomName"]);?> Room </h2>

                    <div id="playersActiveSection">
                    
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