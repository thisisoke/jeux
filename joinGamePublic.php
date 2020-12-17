<?php


//players wait here to enter their details then get redirected to gameWaitingRoom.php


//html 

// display input for roomcode and usernmae
// upon submit call db to see that room exits 
//
// store gameRoom Id in Sessio

//

?>



<div id="playerWaitingRoomView">
<p> Please Enter Your Room code, Username and choose and avatar</p>
<form action='#' method='POST' id='playerEnterForm'>
    <input type='text' name='roomCode' placeholder='Enter the Room Code from your host' required/>

    <input type='text' name='userNamePlayer' placeholder='Enter a username' required/>

    <select name='avatar' id='avatarOptions'>
        <option value='1' >smoothbrain</option>
        <option value='2'>brain</option>
        <option value='3'>galaxybrain</option>
     </select> 

    <button type='submit' value='addPlayer'class='button'>Join Room</button>
</form>

</div>


<script>
//If Host or you have waiting screen
var playerScreen = document.querySelectorAll('#playerWaitingRoomView')[0];

var playerEnterFrom = document.querySelectorAll('#playerEnterForm')[0];


// CALL insert GAME PLAYERS
// Redirect user to the gamewaitingRoom for the roomId
</script>