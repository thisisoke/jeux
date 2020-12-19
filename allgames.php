<?php
//start session
session_start();

$hostInSession = $_SESSION["userNameHost"];
$hostID = $_SESSION["hostId"];


//connect to db
include('includes/dbconfig.php');

//Get all games
$stmt = $pdo->prepare("SELECT * FROM `games`");


//excute statement to get actual table data
$stmt->execute();


?>


<!DOCTYPE html>

<html>
    <head>

    <?php include('globalheader.php'); ?>


    </head>
    <body>

        <div class="navigation">
            <a href="logout.php" class="navLink"> Log Out: <?php echo ($hostInSession); ?></a>
            <a href="roomManagment.php" class="navLink"> Manage Rooms</a>
        </div>
            

        <section id="main-catalog">

            <div id="logo-container" style="margin-top: 5%;">
                    <img id="logo" src="images/jeux-logo.png" alt="Jeux logo" >
            </div>
        
            <section id="roulett" >

            <?php 
                while($result= $stmt->fetch(PDO::FETCH_NAMED)){

                    //cycles through
                    ?>
                    <div class='gameThumbnail catalog' style="background-image: url('<?php echo('images/'.$result["gameImage"]);?>') ; background-size: cover">
                        <p class='gameButton' data-gameId='<?php echo($result["gameId"]);?>' ><?php echo($result["name"].' ');?><i class='fas fa-play'></i></p>
                    </div>
                <?php

                } 
                ?>

            

            </section>
            <footer id="footer">
                <a href="https://twitter.com/thisisoke"> Made by @thisisoke</a>
            </footer>

        </section>

        
        <script>
            var hostId = <?php echo($hostID); ?> ;

        </script>

        
        <script type="text/javascript" src="js/catalog.js"></script>

    </body>


</html>

