<html>
	<head>
		<meta charset="utf-8">
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
		<title>Antimalnik</title>
		<link rel="icon" href="pic/LOGO.png" >
		<link rel="stylesheet" href="css\style.css">
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<script src="js/jquery.js"></script>
		<script src="js/materialize.js"></script>
		<script src="js/script.js"></script>
	</head>
	<body>
		<div id="menu">
			<div id="menu">
			<ul>
				<?php
            	session_start();
            	if(!empty($_SESSION['image'])){
                	$i=$_SESSION['image'];
                	$l="pic/PROF/".$i;
                	echo"<il id='options'><a href='Profile.php'><button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'><img style='border-radius: 5000px;' src='$l'height='44' width='44'></button></a></il> ";
            	}
            	else{
                	echo"<il id='options'><a href='Profile.php'><button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'><img style='border-radius: 5000px;' src='pic/profilePic.png'height='44' width='44'></button></a></il>";
            	}
        		?> 
				<li id="options"><a style="background-color: white;" href="team.php">За нас</a></li>
				<li id="options"><a href="questions.php">Въпроси</a></li>
				<li id="options"><a href="messages.php">Съобщения</a></li>
				<li id="options"><a href="lost_things.php">Изгубени вещи</a></li>
				<li id="options"><a href="index.php">Сергия</a></li>
				<li id="image"><img src="pic/LOGO.png" height="45" width="90"></li>
			</ul>
		</div>
		<div style="text-align: center;" >
		<img src="pic/LOGO.png"style="max-height:300;">
		</div>
		<div class="card-panel grey lighten-3" style="margin-left: 50%; transform: translate(-50%); margin-top: %">
			<h4 style="text-align: center;">За нас</h4>
			<p>Ние сме ученици, които желаят да подобрят както средата на обучение, така и самия начин на 
				учене. Ние създадохме тази платформа с цел улесняване на учениците при намиране на учебници 
				втора употреба и униформи. Благодарение на сайта, учениците могат по-лесно да комуникират 
				помежду си чрез нашия чат. Ако на учениците не им е ясно нещо, свързано с работата на сайта 
				или повече, в раздел "Въпроси" могат да разберат. Ако нужният отговор не е там, могат да ни
				питат чрез формата за въпроси в същата страница.
			</p>
			<span>За контакт: E-mail - e.venci@abv.bg или bamko2003@gmail.com
		</div>
	</body>
</html>