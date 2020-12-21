var scaling = "tagID"; // this will resize to fit inside the screen dimensions
var width = 1024;
var height = 720;
var color = black;
var outerColor = "#0B0B24";


//preload the assets so that when you reference them later they are not just loading
const assets = ["laughHard-emoji.png", "angry-emoji.png", "love-emoji.png", "cool-emoji.png", "suprised-emoji.png", "yikes-emoji.png"];
const path = "assets/"


var frame = new Frame(scaling, width, height, color, outerColor, assets, path);
frame.on("ready", function() {
    zog("ready from ZIM Frame");



    const stage = frame.stage;
    const stageW = frame.width;
    const stageH = frame.height;


    loadingScreen();

    function loadingScreen(){


        var speechBubble1 = new Rectangle(200, 60, "white").center().mov({x:-50, y:-60}).alp(1).animate({
            from:true,
            props:{y:370, alpha: 0},
            time:.4,
            ease:"sineInOut"
        });

        var speechBubble2 = new Rectangle(200, 60, "white").center().mov({x:50,y:20}).alp(1).animate({
            from:true,
            props:{y:460, alpha: 0},
            wait: .2,
            time:.7,
            ease:"sineInOut"
 
        });

        //temp Emojis
        var emojiRect = [];
        //Emojis Poping around
        var emojiRain =[];

        for (i=0; i< 50 ;i++){

            emojiRain.push(frame.asset("laughHard-emoji.png").sca(.05));

            var randomX = Math.floor(Math.random() * 1024);
            var randomY = Math.floor(Math.random() * 720);



            var randomStartY = Math.floor(Math.random() * 720)+30;
            
            // Add Emojis floating up 
             emojiRect.push (new Rectangle(30, 30, "yellow").pos(randomX,randomY).animate({
                from:true,
                props:{y:randomStartY, alpha: 0},
                wait: .7,
                time:.7,
                ease:"sineInOut"
     
            }));
        //     //zog(emojiRain);

        //     emojiRain[i].pos(randomX,randomY);

        //     zog(emojiRain[i].x, emojiRain[i].y);
            
            // .animate({
            //         from:true,
            //         props:{y:randomStartY, alpha: 0},
            //         time:.7,
            //         wait: .7,
            //         ease:"sineInOut"
            //     });

            stage.update();

        }


        

        timeout(3, animateOut);

        function animateOut() {
            //animate all things out then call howToPlay
            // zog("time-OutwORKS");
            
            speechBubble1.animate({
                //animating  out slowly
                props:{alpha: 0},
                time: .9,
                ease:"sineInOut"
             });

            speechBubble2.animate({
                //animating  out slowly
                props:{alpha: 0},
                time: .9,
                ease:"sineInOut"
             });

            for (i=0; i< 50 ;i++){
                emojiRect[i].animate({
                    //animating out slowly
                    props:{alpha: 0},
                    time: .9,
                    ease:"sineInOut"
                });
            }

            timeout(2, removeFromStage)

            function removeFromStage(){
                for (i=0; i< 50 ;i++){
                    emojiRect[i].removeFrom(stage);
                }
                speechBubble1.removeFrom(stage)
                zog("time-OutwORKS");

            }

            howToPlay();

        }

    }


    

    function emojiDisplay(positionX, positionY, emojiAsset, startY, time, wait){
        zog("asset function was called");
        new asset(emojiAsset).addTo(stage).pos(positionX,positionY).sca(.05).animate({
                from:true,
                props:{y:startY, alpha: 0},
                time:time,
                wait: wait,
                ease:"sineInOut"
            });


    }


    function howToPlay(){

        zog("how to play called");


        
        var gifGalleryRow = new Tile({
            obj:new Rectangle(300, 200, "grey"), 
            cols:10,
            rows: 1, 
            spacingH:30, 
            width:stageW})
            .center().animate({
                from:true,
                props:{alpha: 0},
                time:.4,
                ease:"sineInOut"
            });

            gifGalleryRow.animate({
                from:true,
                props:{x:-(stageW/2)},
                time:20,
                ease:"sineInOut"
            });

        
        var gifGalleryRow2 = new Tile({
            obj:new Rectangle(300, 200, "grey"), 
            cols:10,
            rows: 1, 
            spacingH:30, 
            width:stageW})
            .center().mov({y:-220, x:+250}).animate({
                from:true,
                props:{alpha: 0},
                time:.4,
                ease:"sineInOut"
            });

            gifGalleryRow2.animate({
                from:true,
                props:{x:-(stageW/2)},
                time:25,
                ease:"sineInOut"
            });
            
            var gifGallery = new Container();
            gifGallery.addChild(gifGalleryRow); 
            gifGallery.addChild(gifGalleryRow2);
            
            gifGallery.center().mov({y:200});

        //Animated GIF gallery behind instructions
        var gifWidth = 300;
        var gifHeight = 300;
        var gifColumspace = 300;

        // for (i=0; i< 10 ;i++){
        //     gifGalleryAnimated.push(new Rectangle(300, 200, "white").pos);
        // }


        var instructionsModal = new Rectangle(350, 400, "white").center().alp(1).animate({
            from:true,
            props:{y:370, alpha: 0},
            time:.4,
            ease:"sineInOut"
        });
        //You get 8 prompts to respond with the best GIF. Everyone gets to vote on each GIF and the person with the best responses wins at the end!
        




        instructionsModal.animate({
            //animating  out slowly
            props:{alpha: 0},
            time: .9,
            wait: 11,
            ease:"sineInOut"
         });

         gifGallery.animate({
            //animating  out slowly
            props:{alpha: 0},
            time: .9,
            wait: 10,
            ease:"sineInOut"
         });

        timeout(20, gameStart);
    }

    //gameStart()
    function gameStart(){

        zog("gamesStart called")
        //show
        //gameScore()

        var prompt = new Label ({
            text: "This is the first Prompt",
            color: black,
            size:40,
            variant: true,
            backgroundColor: "white"
        }).center().mov({y:-250}).alp(1).animate({
            from:true,
            props:{y:370, alpha: 0},
            time:.4,
            ease:"sineInOut"
        });

        var gifSelect = new Tile({
            obj:new Rectangle(300, 200, "grey"), 
            cols:7,
            rows: 2, 
            spacingH:30,
            spacingV:30, 
            width:stageW}).pos(0, 270);

        
        zog(gifSelect);
        zog(gifSelect._bounds.width);

        var prevPage = new Circle(50, "red").pos(30, 450);
        var nextPage = new Circle(50, "blue").pos((stageW -130), 450);

        //get onlick events for the circles

        nextPage.on("click", (e) =>{

            zog("clicked");
            zog(e);
            gifSelect.animate({
                //from:true,
                props:{x:-stageW},
                time:.4,
                ease:"sineInOut"
            });

        });

        prevPage.on("click", (e) =>{
            

                zog("clicked");
                zog(e);
                zog(gifSelect.x);
            if (gifSelect.x > 0){
                gifSelect.animate({
                //from:true,
                props:{x:stageW},
                time:.4,
                ease:"sineInOut"
            });
            }

            

        });






    }
});




