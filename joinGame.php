<?php

//this page allows a non-host to join a game room

//start session
session_start();

?>

<!DOCTYPE html>

<html>
    <head>

    <?php include('globalheader.php'); ?>

    </head>
    <body>


        <div id='playerRegister'>
            <h2> Welcome to Jeux! </h2>
            <p> Enter a room created by the host</p>

            <form action='#' method='POST' id='player-register-form'>

                <input type='text' name='roomCode' placeholder='Enter Room Code' required/>

                <input type='text' name='userName' placeholder='Choose Your UserName' required/>

                <select name='avatar' id='avatarOptions'>
                <option value='1'>!</option>
                <option value='2'>J</option>
                <option value='3'>e</option>
                <option value='4'>x</option>
                <option value='5'>u</option>
                </select>   

                <button type='submit' value='player  register'  class='button'>Enter Room!</button>
            </form>


        </div>



<script type="text/javascript" src="js/playerJoin.js"></script>


</body>
</html>

