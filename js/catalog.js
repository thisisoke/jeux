
console.log(hostId);

//Select the entire body element for use for modal insertion
var main = document.getElementsByTagName("BODY")[0];

// let listOfGames;
let gameSelectList;


gameSelectList = document.querySelectorAll('[data-gameId]');

console.log(gameSelectList);

//Add event listener to each game loaded
for(i = 0; i < gameSelectList.length; i++){

    gameSelectList[i].addEventListener("click", viewGame);

}


var modalBack; //used to access the modal box at the back
var gameModalHTML; //used to store the game modal HTML

function viewGame(e){

        console.log(e);
        console.log("selected game: " + e.target.dataset.gameid);

        
        let selectedGame = e.target.dataset.gameid;
        var gameJson;

        //Open up a asynchronous AJAX Connection
        var xhr = new XMLHttpRequest(); 
        xhr.onreadystatechange = function(e){     
            console.log(xhr.readyState); 
            if(xhr.readyState === 4){ 



                gameJson = JSON.parse(this.responseText);
                console.log(gameJson);

                // Insert Modal that shows selected game with button to start
                // var singleQuote = "'";style='background-image: url('images/"+ gameJson[0].gameImage +"')'
                
                // .style.backgroundImage = "url('asset/" + gameJson[0].gameImage +"')";

                // style='background-image: url(\"images/"+ gameJson[0].gameImage +"'\") ; background-size: cover \"
                gameModalHTML = "<section id='modalBackground'><div id='gamePreviewModal'><div class='gameThumbnail' ><h2> "+ gameJson[0].name +"</h2><p> "+ gameJson[0].description +"</p><p> Amount of Players: "+ gameJson[0].playerLimit +"</p></div><form action='#' method='POST' id='createGameRoomForm'><input type='text' name='gameRoomName' placeholder='Write a unique Room Name' required/><button type='submit' value='createRoom'  class='button'>Open New Game Room</button></form></div></section>"

                main.insertAdjacentHTML('beforeend', gameModalHTML);

                modalBack = document.querySelectorAll('#modalBackground')[0];
                modalBack.addEventListener("click",exitModal)

                //Get all form for entered Game room 
                var gameRoomForm = document.querySelectorAll("#createGameRoomForm")[0];

                console.log(gameRoomForm);
                gameRoomForm.addEventListener("submit", startGameRoomTemp);

                function  startGameRoomTemp (e){
                    console.log("startGameRoomTemp Called");
                    //prevent default behaviour
                    e.preventDefault();

                    startGameRoom(gameJson[0].gameId, e, hostId);
                
                }



                // gameRoomForm.addEventListener("submit",function(){startGameRoom(gameJson[0].gameId, event, hostId)},false)

            }
        }

        xhr.open("GET","listofgames.php?gameId="+ selectedGame,true); 
        xhr.send();



}

function exitModal(e){
    // console.log(e.target.tagName);
    // console.log(e);
    //check if event targeted element was the grey modal background
    if (e.target.id == "modalBackground"){
        console.log("exit modal Works");

        var sectionToRemove = e.target
        
        sectionToRemove.remove();
        //REMOVE the modal
        //modalBackground
    }

}






function startGameRoom(gameId, roomFrom, hostId){
    console.log("startGameRoom Called");
     //prevent default behaviour
     roomFrom.preventDefault()

     //console.log(roomFrom.target.elements[0].value);

     let roomName = roomFrom.target.elements[0].value;

     //generarate 4 digital room code
     let genRoomCode = makeCode(5);

     let postString = "hostId="+ hostId +"&roomName="+roomName+ "&roomCode="+genRoomCode+ "&gameId="+gameId; 

    //Open up a asynchronous AJAX Connection
    //To Create new game room in Database
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(e){
        console.log(xhr.readyState);
        if(xhr.readyState === 4){
            console.log(xhr.responseText);
                //DOM Manipulation

                let roomId = this.responseText;

                //go to room page!
                    //link to a php page for gameWaiting Room that auto loggedin to room that was just opened
                location.href = "gameWaitingRoom.php?gameRoomId="+ roomId;

        }
    }

    //Make call to to php script to do the insert
    xhr.open("POST","createNewRoom.php",true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    //test post string
    console.log(postString);
    //send post string
    xhr.send(postString);




}



//Random Number Generator

function makeCode(length) {
    var result = '';
    var characters= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
       result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
 }

