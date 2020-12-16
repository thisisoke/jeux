<?php
//start session
session_start();

$userInSession = $_SESSION["userName"];

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
 
        </script>
        <script type="text/javascript" src="js/catalog.js"></script>

    </body>


</html>

