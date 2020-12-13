
//Game 1 JS GifChat

//track game state
var gameState = ["gameLobby", "gameStart", "questionPrompt", "voting", "voteResults"];

//track how many game rounds that there are in the game
var gameRounds = 4;

var playerType = "host";
// can be "host" or "player";

//user variable to set as host or player
var user;


//Points ledgen
var rating = [1,2,3,4,5,6,7,8,9,10];



function gamelobby(){


    //here we wait until all the players are here and host presses start game


}

function gameScore(){

    //get score from Database with AJAX
    //GET all answers votes and tally up with ranking algorithm 
    //LOOP through results per user
    for (i=0; i> 0; i++){ 
        //go through answer DB results.length 
        function rankingAlgorithm(questionId, rating){


            // add all the ratings for one question ID
        }
    } 
    //POST tally up

    //update html scrore components at the top with DOM manipulation


    //
}

function checkGameState() {

    //this function will be called to check the game state in the DB. will return the current state
}

function setGameState(gameState){

    if(user === "host"){
    //ajax call to set game state to the new things. 
    //set Game state will
    } 
}

