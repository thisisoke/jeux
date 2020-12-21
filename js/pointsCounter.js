

setInterval(20, getVotes);


function getVotes(){


    //Open up a asynchronous AJAX Connection
    var xhr = new XMLHttpRequest(); 
    xhr.onreadystatechange = function(e){     
        console.log(xhr.readyState); 
        if(xhr.readyState === 4){ 

            listOfGames = JSON.parse(this.responseText);
            console.log(listOfGames);

            addPoints();


        }
    }


    //Make call to to php script to do the GET featured articles
    
    xhr.open("GET","getGame1Votes.php",true); 
    xhr.send();
    //console.log(getString);

        
    

}


function addPoints(){

    updateUserPointsDB()


}


function updateUserPointsDB(){

    updateScreen()

} 

function updateScreen(){

    

} 