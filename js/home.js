
var gamesSection = document.querySelectorAll('#hero-roulett')[0];


var body = document.createElement("BODY");
//body.addEventListener("load", loadGames);

loadGames();

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

    //Make call to to php script to do the GET
    
    xhr.open("GET","listofgames.php",true); 
    xhr.send();
    //console.log(getString);

   



}
