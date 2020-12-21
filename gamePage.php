<?php

//start session
session_start();

$gameId; //what game are we playing
$gameRoom; //which game room are we in, and what players and their points

echo($_SESSION["userNamePlayer"]);
echo($_SESSION["gameRoomId"]);


?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>GifChat!</title>
        <?php include('globalheader.php'); ?>

        <script src="https://zimjs.org/cdn/1.3.2/createjs.js"></script>
        <script src="https://zimjs.org/cdn/cat/01/zim.js"></script>
        
        <!-- echo php here to load the correct javascript file-->
        <script src="js/game1-rewrite.js"></script>

        <meta name="viewport" content="width=device-width, user-scalable=no" />



    </head>

    <body class="gameScreen">
        <section id="gameRoomStats">
            <div>
                <h1> Room: Room Name</h1>
                <p> Room Code</p>
            </div>

            <div>
                <div>
                    <img src="images/1.png" alt="player-icon">
                    <p> Player Name: 0 </p>
                </div>
                <div>
                    <img src="images/2.png" alt="player-icon">
                    <p> Player Name: 100 </p>
                </div>
                <div>
                    <img src="images/3.png" alt="player-icon">
                    <p> Player Name: 400 </p>
                </div>
                <div>
                    <img src="images/4.png" alt="player-icon">
                    <p> Player Name: 10 </p>
                </div>

 
            </div>
        </section>

        <section id="tagID">

        </section>

    <!-- canvas with id="myCanvas" is made by zim Frame -->
    </body>
</html>
