<?php
//start session
session_start();

$userInSession = $_SESSION["userName"];
$hostID = $_SESSION["hostId"];

?>
<!DOCTYPE html>

<html>
    <head>

    <?php include('globalheader.php'); ?>

    </head>
    <body onload="loadGames()">
    
        <section class="navigation">
            <img id="logo" src="images/SVG/jeux-logo-colour.svg" alt="jeux logo"/>
            

        </section>

        <section id="main">
        
            <section id="roulett" >

            

            </section>

            <section id="content">

            </section>

        </section>

        <footer id="footer">

        </footer>


        <script> 
            //pass username to java script for pop or to edit text
            var userInSession = "<?php echo($userInSession)?>";
            var hostId = "<?php echo($hostID)?>";
 
        </script>
        <script type="text/javascript" src="js/catalog.js"></script>

    </body>


</html>

