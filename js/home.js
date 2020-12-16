
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
var loginForm;
var registerForm;

console.log(loginButton);
loginButton.addEventListener("click",loginRegister)

function loginRegister(){
    console.log("loginRester Works");

    console.log(body[0]);

    var modalHTML= "<section id='modalBackground'><div id='modalRegister'><div id='login'><h2> Login<h2><form action='#' method='POST' id='Login-form'><input type='email' name='emailAddress' placeholder='Enter Your Email Address' required/><input type='password' name='password' placeholder='Enter Your Password' required/><button type='submit' value='LogIn'  class='button'>Login</button></form></div><div id='register'><h2> Sign Up to Host a Game! <h2><form action='#' method='POST' id='Register-form'><input type='text' name='userName' placeholder='Choose Your Username' required/><input type='email' name='emailAddress' placeholder='Enter Your Email Address' required/><select name='avatar' id='avatarOptions'><option value='avatar1' >smoothbrain</option><option value='avatar2'>brain</option><option value='avatar3'>galaxybrain</option></select><input type='password' name='password' placeholder='Enter Your Password' required/><button type='submit' value='Register'  class='button'>Register</button></form></div></div></section>"
    
    

    body[0].insertAdjacentHTML('beforeend', modalHTML);

    modalBack = document.querySelectorAll('#modalBackground')[0];
    modalBack.addEventListener("click",exitModal)

    //Get both login in form and register form elements
    loginForm = document.querySelectorAll("#Login-form")[0];
    registerForm = document.querySelectorAll("#Register-form")[0];

    loginForm.addEventListener("submit", loginHost);
    registerForm.addEventListener("submit", registerHost);

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

var formAnswersArray= [];

function loginHost(e){

    e.preventDefault()

    //both should give the same thing
    console.log(loginForm);
    console.log(loginForm.elements);
    console.log(loginForm.elements[0].value);

    var postString = "emailAddress="+ loginForm.elements[0].value + "&password="+ loginForm.elements[1].value;

    //Open up a asynchronous AJAX Connection
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(e){
        console.log(xhr.readyState);
        if(xhr.readyState === 4){
            console.log(xhr.responseText);// modify or populate html elements based on response.
                //DOM Manipulation

                if (this.responseText === "Succesful Login"){
                     console.log(this.responseText)
                    //link of to the games list page
                    location.href = "allgames.php";

                }
        }
    }

    //Make call to to php script to do the insert
    xhr.open("POST","loginProcess.php",true);
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    //test post string
    console.log(postString);
    //send post string
    xhr.send(postString);


    





}

function registerHost(e){



    //link of to the games list page
    //location.href = "allgameslist.php";


}
