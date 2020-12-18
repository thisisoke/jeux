
var gamesSection = document.querySelectorAll('#roulett')[0];

//console.log(userInSession);

//Select the entire body element for use for modal insertion
var main = document.getElementsByTagName("BODY");

let listOfGames;
let gameSelectList;

function loadGames(){

    console.log("Load list of games");

    //Open up a asynchronous AJAX Connection
    var xhr = new XMLHttpRequest(); 
    xhr.onreadystatechange = function(e){     
        console.log(xhr.readyState); 
        if(xhr.readyState === 4){ 

            listOfGames = JSON.parse(this.responseText);
            console.log(listOfGames);

            let parseGames = "";

            for(i = 0; i < listOfGames.length; i++){
                parseGames += "<div class='gameThumbnail catalog'><p class='gameButton' data-gameArrayId='"+ parseInt(i) + "' >"+ listOfGames[i].name + "<i class='fas fa-play'></i></p></div>";
            }
            console.log(parseGames);
            
            gamesSection.innerHTML = parseGames;

            gameSelectList = document.querySelectorAll('[data-gameArrayId]');

            console.log(gameSelectList);

            //Add event listener to each game loaded
            for(i = 0; i < gameSelectList.length; i++){

                gameSelectList[i].addEventListener("click", viewGame);


            }


        }
    }


    //Make call to to php script to do the GET featured articles
    
    xhr.open("GET","listofgames.php",true); 
    xhr.send();
    //console.log(getString);



}

var modalBack; //used to access the modal box at the back
var gameModalHTML; //used to store the game modal HTML

function viewGame(e){

        console.log(e);
        console.log("selected game: " + e.target.dataset.gamearrayid);

        

        let selectedGame = e.target.dataset.gamearrayid;

        console.log(listOfGames[selectedGame].description);
        console.log(listOfGames[selectedGame].name);

        // Insert Modal that shows selected game woth button to start

        gameModalHTML = "<section id='modalBackground'><div id='gamePreviewModal'><div><img src='images/"+ listOfGames[selectedGame].gameImage +"' alt='Game thumbnail picture for "+ listOfGames[selectedGame].name +"' width='100'><h2> "+ listOfGames[selectedGame].name +"</h2><p> "+ listOfGames[selectedGame].description +"</p><p> Amount of Players: "+ listOfGames[selectedGame].playerLimit +"</p></div><form action='#' method='POST' id='createGameRoomForm'><input type='text' name='gameRoomName' placeholder='Write a unique Room Name' required/><button type='submit' value='createRoom'  class='button'>Open New Game Room</button></form></div></section>"


        main[0].insertAdjacentHTML('beforeend', gameModalHTML);

        modalBack = document.querySelectorAll('#modalBackground')[0];
        modalBack.addEventListener("click",exitModal)

        //Get all form for entered Game room 
        var gameRoomForm = document.querySelectorAll('#createGameRoomForm')[0];
        gameRoomForm.addEventListener("submit",function(e){startGameRoom(listOfGames[selectedGame].gameId, e, hostId)})


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
    console.log("startGame Called");
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



    //link to a php page for gameWaiting Room that auto loggedin to room that was just opened
}



//Random Number Generator

function makeCode(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
       result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
 }
