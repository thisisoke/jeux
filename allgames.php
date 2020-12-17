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
            var hostInSession = "<?php echo($hostInSession)?>";
            var hostId = "<?php echo($hostID)?>";
 
        </script>
        <script type="text/javascript" src="js/catalog.js"></script>

    </body>


</html>

