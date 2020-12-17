<?php
//start session
session_start();

//players wait here to enter their details then get redirected to gameWaitingRoom.php

//store the players username in the session variable
$_SESSION["userNamePlayer"];


//connect to db
include('includes/dbconfig.php');


//Insert player into Game Players Table
$stmt3 = $pdo->prepare("INSERT INTO `gamePlayers`(`playerId`, `playerNum`, `userName`, `points`, `gameRoomId`, `avatar`) VALUES  (NULL, '1', '$userName', '0', '$gameRoomId', '$avatar');");

$stmt3->execute();


echo("Player Inserted");



?>
<div id="playerWaitingRoomView">
<p> Please Enter Your Room code and Username</p>
<form action='#' method='POST' id='playerEnterForm'>
    <input type='text' name='roomCode' placeholder='Enter the Room Code from your host' required/>

    <input type='text' name='username' placeholder='Enter a username' required/>

    <select name='avatar' id='avatarOptions'>
        <option value='1' >smoothbrain</option>
        <option value='2'>brain</option>
        <option value='3'>galaxybrain</option>
     </select> 

    <button type='submit' value='enterRoom'  class='button'>Login</button>
</form>

</div>


<script>
//If Host or you have waiting screen
var playerScreen = document.querySelectorAll('#playerWaitingRoomView')[0];

var playerEnterFrom = document.querySelectorAll('#playerEnterForm')[0];


// CALL insert GAME PLAYERS
// Redirect user to the gamewaitingRoom for the roomId
</script>


