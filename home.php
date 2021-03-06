<?php
session_start();
if(!isset($_SESSION['user']))
header('location:login.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		}
		.hide{
			display: none;
		}
    .carGame{
      width: 100%;
      height: 100vh;
      background-size: cover;
      background-image: url('bg6.jpg');
      background-repeat: no-repeat;
    }

		 .car,.enemy{
			width: 50px;
			height: 70px;
			background: red;
			position: absolute;
			bottom: 120px;
      border-radius: 10px;
      background-image: url('car2.png');
      background-repeat: no-repeat;
      background-size: 100% 100%;
		}
    .gameArea{
      width: 400px;
      height: 100vh;
      background: #2d3436;
      margin: auto;
      position: relative;
      overflow: hidden;
      border-right: 7px dashed #c8d6e5;
      border-left: 7px dashed #c8d6e5;
    }
    .lines{
      width: 10px;
      height: 100px;
      background: white;
      position: absolute;
      margin-left: 195px;
    }
    .score{
      position: absolute;
      top: 15px;
      left: 40px;
      background: brown;
      width: 300px;
      line-height: 70px;
      text-align: center;
      color: white;
      font-size: 1.5em;
      font-family: fantasy;
      box-shadow: 0 5px 5px #777;
    }
    .startScreen{
      position: absolute;
      background-color: red;
      left: 50%;
      top: 50%;
      transform: translate(-50%,-50%);
      color: white;
      z-index: 1;
      text-align: center;
      border: 1px solid #fffb6b;
      padding: 15px;
      margin: auto;
      width: 50%;
      cursor: pointer;
      font-family: carfont;
      letter-spacing: 5;
      font-size: 20px;
      word-spacing: 3;
      line-height: 30px;
      text-transform: uppercase;
      box-shadow: 0 5px 5px #777;
    }
	</style>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
<body>
	<div class="carGame">
		<div class="score"></div>
		<div class="startScreen">
			<h2> Welcome <?php echo $_SESSION['user']; ?> </h2>
			<p>Press here to start <br>
        Arrow keys To play🚕<br>
        Right➡Left⬅Up⬆Down⬇<br>
				If you hit another car you will loose <br>
			</p>
            <a href="logout.php">LOGOUT</a>
		</div>
		<div class="gameArea hide">  </div>
	</div>
      <script type="text/javascript">
      	const score = document.querySelector('.score');
      	const startScreen = document.querySelector('.startScreen');
      	const gameArea = document.querySelector('.gameArea');
      //	console.log(startScreen);

      	startScreen.addEventListener('click' , start);

      	let keys = {ArrowUp: false, ArrowDown: false, ArrowLeft: false, ArrowRight: false}
      	let player = {speed: 5,score:0};
        document.addEventListener('keydown', keyDown);
        document.addEventListener('keyup' , keyUp);
        function keyDown(e){
        	e.preventDefault();
        	keys[e.key] = true;
        //	console.log(e.key);
        //	console.log(keys);
        }

        function keyUp(e){
        	e.preventDefault();
        	keys[e.key] = false;
        //	console.log(e.key);
        //	console.log(keys);
        }
        function isCollide(a,b){
           aRect = a.getBoundingClientRect();
           bRect = b.getBoundingClientRect();
           return !((aRect.bottom < bRect.top) || (aRect.top > bRect.bottom) || (aRect.right < bRect.left) || (aRect.left > bRect.right))
        }
        function moveLines(){
           let lines =document.querySelectorAll('.lines');
           lines.forEach(function(item){
            if(item.y >=700){
              item.y-=750;
            }
            item.y+=player.speed;
            item.style.top = item.y +"px";
           })
        }
        function endGame(){
          player.start = false;
          startScreen.classList.remove('hide');
          startScreen.innerHTML = "GAME OVER!!! <br> Your final score is " + player.score + " <br>Press here to Restart";
        }
         function moveEnemy(car){
           let enemy =document.querySelectorAll('.enemy');
           enemy.forEach(function(item){
            if(isCollide(car,item)){
                console.log("Car Hit");
                endGame();
            }
            if(item.y >=750){
              item.y=-300;
              item.style.left=Math.floor(Math.random()*350) + "px";
            }
            item.y+=player.speed;
            item.style.top = item.y +"px";
           })
        }
        
        function gamePlay(){
        //	console.log("Hey Game Started");
          let car = document.querySelector('.car');
          let road = gameArea.getBoundingClientRect();
         // console.log(road);
        	if(player.start){
             moveLines();
             moveEnemy(car);
            if(keys.ArrowUp && player.y > (road.top+70)){
              player.y -=player.speed;
            }
            if(keys.ArrowDown && player.y < (road.bottom-70)){
              player.y +=player.speed;
            }
             if(keys.ArrowLeft && player.x>0){
              player.x -=player.speed;
            }
            if(keys.ArrowRight && player.x < (road.width-50)){
              player.x +=player.speed;
            }
            car.style.top =player.y +"px";
            car.style.left =player.x +"px";
        	window.requestAnimationFrame(gamePlay);
          //console.log(player.score++);
          player.score++;
          let ps = player.score-1;
          score.innerText = "Score:"+ ps;
        }
        }
        function start(){
        	gameArea.classList.remove('hide');
        	startScreen.classList.add('hide');
          gameArea.innerHTML = "";
        	player.start = true;
          player.score = 0;
        	window.requestAnimationFrame(gamePlay);
          for (x=0;x<5;x++) {
          let roadLine = document.createElement('div');
          roadLine.setAttribute('class','lines');
          roadLine.y = (x*150);
          roadLine.style.top = roadLine.y +"px";
          gameArea.appendChild(roadLine);

          }
        	let car = document.createElement('div');
        	car.setAttribute('class','car');
        	//car.innerText = "Hey I am your car";
        	gameArea.appendChild(car);
          player.x = car.offsetLeft;
          player.y = car.offsetTop;
          // console.log("top position "+car.offsetTop);
          // console.log("left position "+car.offsetLeft); 
           for (x=0;x<3;x++) {
          let enemyCar = document.createElement('div');
          enemyCar.setAttribute('class','enemy');
          enemyCar.y = ((x+1)*350) * (-1);
          enemyCar.style.top = enemyCar.y +"px";
          enemyCar.style.backgroundColor = randomColor();
          enemyCar.style.left=Math.floor(Math.random()*350) + "px";
          gameArea.appendChild(enemyCar);

          }
                 }
          function randomColor(){
            function c(){
              let hex = Math.floor(Math.random()*256).toString(16);
              return("0" + String(hex)).substr(-2);
            }
            return "#" +c()+c()+c();
          }       
        </script>
  </div>
</body>
</html>