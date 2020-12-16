
var gamesSection = document.querySelectorAll('#hero-roulett')[0];

var body = document.getElementsByTagName("BODY");

//loadGames();

let listOfGames;

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
                parseGames += "<p> <a href='#'>"+ listOfGames[i].name + "</a></p>";
            }
            console.log(parseGames);
            
            gamesSection.innerHTML = parseGames;

        }
    }

    //Make call to to php script to do the GET featured articles
    
    xhr.open("GET","listofgames.php?featured=1",true); 
    xhr.send();
    //console.log(getString);



}


var loginButton = document.querySelectorAll('#loginRegisterButton')[0];

var modalBack;

console.log(loginButton);
loginButton.addEventListener("click",loginRegister)

function loginRegister(){
    console.log("loginRester Works");

    console.log(body);

    var modalHTML= "<section id='modalBackground'><div id='modalRegister'><div id='login'><h2> Login<h2><form action='#' method='POST' id='Login-form'><input type='email' name='emailAddress' placeholder='Enter Your Email Address' required/><input type='password' name='password' placeholder='Enter Your Password' required/><button type='submit' value='LogIn'  class='button'>Login</button></form></div><div id='register'><h2> Sign Up to Play! <h2><form action='#' method='POST' id='Register-form'><input type='text' name='username' placeholder='Choose Your Username' required/><input type='email' name='emailAddress' placeholder='Enter Your Email Address' required/><select name='avatar' id='avatarOptions'><option value='avatar1' >smoothbrain</option><option value='avatar2'>brain</option><option value='avatar3'>galaxybrain</option></select><input type='password' name='password' placeholder='Enter Your Password' required/><button type='submit' value='Register'  class='button'>Register</button></form></div></div></section>"
    
    

    gamesSection.insertAdjacentHTML('beforeend', modalHTML);

    modalBack = document.querySelectorAll('#modalBackground')[0];
    modalBack.addEventListener("click",exitModal)

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
