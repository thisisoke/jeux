<?php
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
            <a href="allgames.php" class="navLink"> Start a Game</a>
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


        </script>

    </body>
</html>