const frame = new Frame("fit", 800, 600, "#EEE", "#555", "man.jpg", "https://s3-us-west-2.amazonaws.com/s.cdpn.io/1604712/");
frame.on("ready", ()=>{ // ES6 Arrow Function - similar to function(){}
    zog("ready from ZIM Frame"); // logs in console (F12 - choose console)

    // often need below - so consider it part of the template
    let stage = frame.stage;
    let stageW = frame.width;
    let stageH = frame.height;

    // REFERENCES for ZIM at http://zimjs.com
    // see http://zimjs.com/learn.html for video and code tutorials
    // see http://zimjs.com/docs.html for documentation
    // see https://www.youtube.com/watch?v=pUjHFptXspM for INTRO to ZIM
    // see https://www.youtube.com/watch?v=v7OT0YrDWiY for INTRO to CODE

    // CODE HERE
	
		new Rectangle(stageW, 365, white).center().mov(0,-35).animate({
				props:{alpha:0},
				wait:500,
				from:true
			});
	
		var pic;
		var radioButtons;
		new Tile({
			obj:series(
				new Label("How many times have you seen this man?").alp(.7).sca(.6),
				pic = frame.asset("man.jpg"),
				radioButtons = new RadioButtons({
					buttons:[0,1,10,100,1000],
					vertical:false
				}).sca(.4),
				new Button({
					label:"SUBMIT",
					corner:0,
					backgroundColor:blue,
					rollBackgroundColor:green
				}).sca(.6).tap(e=>{
					if (radioButtons.selectedIndex < 0) return;
					e.target.removeFrom();
					stage.update();
					// see php page below
					async("https://zimjs.com/codepen/man.php?answer="+radioButtons.text, getTotals);
				})
			), 
			rows:4,
			spacingV:20,
			align:"center",
			clone:false // otherwise button event won't be on displayed button
		}).center();	
		radioButtons.mov(-10); // just a little shift
	
		const w = pic.width/5;
		const answers = [0,1,10,100,1000];
		const colors = [pink,green,blue,yellow,orange];
	
		function getTotals(data) { // called by async
			// get bottom left corner of pic in Tile
			const point = pic.localToGlobal(0,pic.height); 
			const max = data.max;
			loop(answers, (answer, i)=>{
				let h = data[answer]*pic.height/max;
				let r = new Rectangle(w, h, colors[i])
					.reg(0,h) // place at bottom
					.alp(.7)
					.loc(point.x+i*w, point.y)
					.animate({
						props:{scaleY:0},
						from:true,
						wait:i*200,
						time:500,
						call:()=>{
							new Label({
								color:white,
								text:data[answer]
							})
								.sca(.5).center(r).pos(null,5)
								.animate({props:{alpha:0}, time:500,from:true});			
						}
					});					
			});
			radioButtons.selectedIndex = -1;
			loop(radioButtons.buttons, button=>{
				button.removeChildAt(0);
			});
			createGreet(); 
			stage.update();
		}
   

    stage.update(); // this is needed to show any changes
  
    // DOCS FOR ITEMS USED
		// https://zimjs.com/docs.html?item=Frame
		// https://zimjs.com/docs.html?item=Rectangle
		// https://zimjs.com/docs.html?item=Label
		// https://zimjs.com/docs.html?item=Button
		// https://zimjs.com/docs.html?item=RadioButtons
		// https://zimjs.com/docs.html?item=Tile
		// https://zimjs.com/docs.html?item=tap
		// https://zimjs.com/docs.html?item=loop
		// https://zimjs.com/docs.html?item=pos
		// https://zimjs.com/docs.html?item=loc
		// https://zimjs.com/docs.html?item=mov
		// https://zimjs.com/docs.html?item=alp
		// https://zimjs.com/docs.html?item=reg
		// https://zimjs.com/docs.html?item=sca
		// https://zimjs.com/docs.html?item=removeFrom
		// https://zimjs.com/docs.html?item=center
		// https://zimjs.com/docs.html?item=async
		// https://zimjs.com/docs.html?item=zog
  
    // FOOTER
    // call remote script to make ZIM Foundation for Creative Coding icon
    createIcon();     
	
	// <?php
	// header('Content-type: text/javascript');
	// $answer = $_GET["answer"];
	// file_put_contents("man.txt", $answer."\n", FILE_APPEND);
	// $totals = file("man.txt", FILE_IGNORE_NEW_LINES);
	// $data = array_count_values($totals);
	// $data["max"] = max($data); // also pass max total
	// $result = json_encode($data);
	// echo "async.getTotals($result)";
	// ?>

}); // end of ready