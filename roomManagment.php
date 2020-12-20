<?php
//Get all rooms Host as sarted to be able to delete
//Javascript can delete the room
//start session
session_start();

$hostInSession = "toro"; //$_SESSION["userNameHost"];
$hostId = 1; //$_SESSION["hostId"];


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

        
    <section id="settingsPage">


        <div id="hostProfile">
                

                <div class='gameDescription'>
                    <img src='images/2.png' style="width:187px; height:200px"> 
                    <div>
                        <h1> <?php echo($hostInSession);?></h1>
                        <p class="smaller"> host username <?php echo($host["email"]);?> </p>

                        <a id="startGameButton-small" href="#manageRoomsSection"> Manage Rooms <i class="fas fa-play"></i></a>
                    </div>
                    
                </div>

        </div>

        <div id="manageRoomsSection">

            <?php
            while($result= $stmt->fetch(PDO::FETCH_NAMED)){

                //STORE IN ARRAY FOR JAVA SCRIPT TO BE ABLE TO DELETE
                ?>
                <div class="roomManageDiv">
                    <div class="roomInfo">
                        <div >
                            <h2> <?php echo($result["roomName"])?> </h1>
                            <p> GAME START:<?php echo($result["created_at"])?> </p>
                            <p> GAME END: </p>
                        </div>
                        <div>
                            <p> Room Code #: <?php echo($result["roomCode"])?> </p>
                            <a id="startGameButton-mid" href="#" data-gameRoomId="<?php echo($result["gameRoomId"])?>"> Close Room </a>
                        </div>
                    </div>

                    <div class="roomPlayers">

                        <?php
                            $gameRoomId = $result["gameRoomId"];

                            $stmt2 = $pdo->prepare("SELECT * FROM `gamePlayers` WHERE `gameRoomId` = '$gameRoomId'");

                            $stmt2->execute();

                            while($player= $stmt2->fetch(PDO::FETCH_NAMED)){

                                ?>
                                <div>
                                    <p> <?php echo($player["userName"])?> </p>
                                    <p> <?php echo($player["points"])?> </p>
                                    <img src=<?php echo("'images/".$player["avatar"].".png'")?> style="width:90px">
                                </div>

                            <?php

                            }
                        ?>
                    </div>
                </div>
            <?php
            }?>
        </div>



            

        
    </section>
        <script>

 
            var roomToClose; 
            var roomIdToClose;
            var closeRoomButtons = document.querySelectorAll('[data-gameRoomId]');

            // console.log( closeRoomButtons);

            // console.log( closeRoomButtons[0].parentElement.parentElement.parentElement);

            //add an event listener to every button on the page
            for (i=0; i < closeRoomButtons.length; i++){

                closeRoomButtons[i].addEventListener("click", closeRoom);
                roomToClose = closeRoomButtons[i].parentElement.parentElement.parentElement;

                


            }

            function closeRoom(e){

                console.log(e);
                //e.preventDefault();
                roomIdToClose = e.target.dataset.gameroomid;
                console.log(roomIdToClose);
                console.log(roomToClose);
                roomToClose.remove();
                var xhr = new XMLHttpRequest(); 

                xhr.onreadystatechange = function(e){     
                console.log(xhr.readyState);  

                    if(xhr.readyState === 4){    
                        console.log(xhr.responseText);// modify or populate html elements based on response.

                        roomToClose.remove(); //remove the selected destination element 
                        
                    } 
                }

                xhr.open("POST","closeRoom.php",true); 
                xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                var postString = "gameRoomId=" + roomIdToClose ;  
                console.log(postString);    
                xhr.send(postString); 
                


            }



            // //Update the active list of players every 2seconds. Call update Active Players
            // setInterval(updateActivePlayers, 2000);


            // function updateActivePlayers(){
            //     console.log("Interval is called to get activePlayers");

            //     //Call database  GAME PLAYERS to get updated list of users 
            //     //Open up a asynchronous AJAX Connection
            //     var xhr = new XMLHttpRequest(); 
            //     xhr.onreadystatechange = function(e){     
            //         //console.log(xhr.readyState); 
            //         if(xhr.readyState === 4){ 

            //             let activePlayers = JSON.parse(this.responseText);
            //             console.log(activePlayers);

            //             let playersList= "";
            //             let name="";

            //             for(i = 0; i < activePlayers.length; i++){
            //                 console.log(activePlayers[i].userName);
            //                 name =  activePlayers[i].userName;

            //                 playerActiveName[i].innerHTML = name;
                            
            //                 playersList = "<img src='images/"+ activePlayers[i].avatar + ".png'>";

            //                 playerActiveCircle[i].innerHTML = playersList;

            //             }
            //             console.log(playersList);

            //             //playerActiveList.innerHTML = playersList;

            //         }

            //     }

            //     xhr.open("GET","getPlayersGame.php?gameRoomId="+ gameRoomId,true); 
            //     xhr.send();
            // }
            



        </script>

    </body>
</html>