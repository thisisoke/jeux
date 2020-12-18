<?php
//start session
session_start();

$hostInSession = $_SESSION["userNameHost"];
$hostID = $_SESSION["hostId"];

?>
<!DOCTYPE html>

<html>
    <head>

    <?php include('globalheader.php'); ?>

    </head>
    <body onload="loadGames()">

        <div class="navigation">
            <p id="loginRegisterButton" >Show Host Username</p>
        </div>
            

        <section id="main-catalog">

            <div id="logo-container" style="margin-top: 5%;">
                    <img id="logo" src="images/jeux-logo.png" alt="Jeux logo" >
            </div>
        
            <section id="roulett" >
                <div class="gameThumbnail catalog"> 
                    <p class="gameButton"> Games Loading <i class="fas fa-play"></i></p>
                </div>

                <div class="gameThumbnail catalog"> 
                    <p class="gameButton"> Games Loading <i class="fas fa-play"></i></p>
                </div>

            

            </section>
            <footer id="footer">
                <a href="https://twitter.com/thisisoke"> Made by @thisisoke</a>
            </footer>

        </section>

        


        <script type="text/javascript" src="js/catalog.js"></script>

    </body>


</html>

