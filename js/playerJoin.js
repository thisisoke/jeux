
playerRegisterForm = document.querySelectorAll("#player-register-form")[0];

playerRegisterForm.addEventListener("submit", playerJoinGameRoom);

let playerRegisterDiv = document.querySelectorAll("#playerRegister")[0];


function playerJoinGameRoom(e){

    //prevent default behaviour
    e.preventDefault()
    //console.log(e);

    //creating the string that will be posted
    var postString = "roomCode="+ playerRegisterForm.elements[0].value +"&userNamePlayer="+ playerRegisterForm.elements[1].value + "&avatar="+ playerRegisterForm.elements[2].value;



    //Open up a asynchronous AJAX Connection
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(e){
        console.log(xhr.readyState);
        if(xhr.readyState === 4){
            console.log(this.responseText);
                //DOM Manipulation

                if (this.responseText === "ROOM FULL"){
                    
                    console.log("first conftion worked");
                    console.log(this.responseText);
                    playerRegisterDiv.insertAdjacentHTML('beforeend', "<p>"+ this.responseText+ "</p>" );
                    
                } else if (this.responseText === "Game Room Does Not Exist"){

                    playerRegisterDiv.insertAdjacentHTML('beforeend', "<p>"+ this.responseText+ "</p>" );

                } else {
                    var gameRommID = this.responseText ;
                    location.href = "gameWaitingRoom.php?gameRoomId="+gameRommID;
                    console.log("room is open");
                
                
                }
        }
    }

    //Make call to to php script to do the insert
    xhr.open("POST","playerJoinProcess.php",true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    //test post string
    console.log(postString);
    //send post string
    xhr.send(postString);


}


