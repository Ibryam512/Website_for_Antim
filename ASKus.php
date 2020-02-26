<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
		<title>Попитай ни</title>
		<link rel="icon" href="pic/LOGO.png">
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
				<ul id="dropdown1" class="dropdown-content">
					<li><a href="Profile.php">Профил</a></li>
					<li class="divider"></li>
					<li><a href="#!">Мои обяви</a></li>
				</ul>
			<?php
            	session_start();
            	if(!empty($_SESSION['image'])){
                	$i=$_SESSION['image'];
                	$l="pic/PROF/".$i;
                	echo "<div class='nav-wrapper'><il id='options'><a class='dropdown-trigger' href='#!' data-target='dropdown1'><button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'><img style='border-radius: 5000px;' src='$l'height='44' width='44'></button></a></il></div>";
            	}
            	else{
                	echo "<div class='nav-wrapper'><il id='options'><a class='dropdown-trigger' href='#!' data-target='dropdown1'><button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'><img style='border-radius: 5000px;' src='pic/profilePic.png'height='44' width='44'></button></a></il></div>";
            	}
        		?> 
				<li id="options"><a href="team.php">За нас</a></li>
				<li id="options"><a href="questions.php">Въпроси</a></li>
				<li id="options"><a href="messages.php">Съобщения</a></li>
				<li id="options"><a href="lost_things.php">Изгубени вещи</a></li>
				<li id="options"><a href="index.php">Сергия</a></li>
				<li id="image"><img src="pic/LOGO.png" height="45" width="90"></li>
			</ul>
		</div>
		<div class="card-panel grey lighten-3" style="margin-left: 30%; transform: translate(-20%);">
			<div class="row">
				<form class="col s12" id="form" action="ASKus.php" method="post" enctype='multipart/form-data'>
				<div class="row">
					<div class="input-field col s12">
						<input id="name" type="text" class="validate" name="name"id="title">
						<label for="name">Име</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="email" type="text" class="validate" name="email"id="title">
						<label for="email">Имейл</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="message" type="text" class="validate" name="message">
						<label for="message">Въпрос</label>
					</div>
				</div>
				 <button class="btn waves-effect waves-light" type="submit" name="action" id="action">Изпрати</button>
        
				</form>
			</div>
		</div>
	</body>
</html>
<?php
if(isset($_POST['action'])){
	//изпрашане на имейл
	$to_email = "bamko2003@gmail.com";
	$subject = 'Testing PHP Mail';
	$message = 'email by: '. $_POST["name"]. 'email: '. $_POST["email"]. 'message: '. $_POST["message"];
	$headers = 'Въпрос';
	mail($to_email, $subject, $message, $headers);
	header("Location: questions.php");
}

?>
