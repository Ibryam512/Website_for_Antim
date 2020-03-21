<?php
session_start();
ob_start();
?>
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
			    <!-- Top Navigation Menu -->
		<div class="topnav">
			<a href="#home" class="active">Мену</a>
		<!-- Navigation links (hidden by default) -->
			<div id="myLinks">
				<a href="index.php">Сергия</a>
				<a href="lost_things.php">Изгубени вещи</a>
				<a href="add.php">Добави</a>
				<a href="messages.php">Съобщения</a>
				<a href="questions.php">Въпроси</a>
				<a href="Profile.php">Профил</a>
				<a href="my_items.php">Мои обяви</a>
				<a href="team.php">За нас</a>
			</div>
		<!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
			<a href="javascript:void(0);" class="icon" onclick="myFunction()">
				<i class="fa fa-bars"></i>
			</a>
		</div>
		<!-- <div id="menu"> -->
			<!-- <ul> -->
			<!-- <ul id="dropdown1" class="dropdown-content"> -->
					<!-- <li><a href="Profile.php">Профил</a></li> -->
					<!-- <li class="divider"></li> -->
					<!-- <li><a href="my_items.php">Мои обяви</a></li> -->
			<!-- </ul> -->
			<?php
            	
            	// if(!empty($_SESSION['image'])){
                	// $i=$_SESSION['image'];
                	// $l="pic/PROF/".$i;
                	// echo "<div class='nav-wrapper'><il id='options'><a class='dropdown-trigger' href='Profile.php' data-target='dropdown1'><button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'><img style='border-radius: 5000px;' src='$l'height='44' width='44'></button></a></il></div>";
            	// }
            	// else{
                	// echo "<div class='nav-wrapper'><il id='options'><a class='dropdown-trigger' href='Profile.php' data-target='dropdown1'><button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'><img style='border-radius: 5000px;' src='pic/profilePic.png'height='44' width='44'></button></a></il></div>";
            	// }
        		// ?> 
				
				
				<!-- <li id="options"><a href="team.php">За нас</a></li> -->
				<!-- <li id="options"><a href="questions.php">Въпроси</a></li> -->
				<!-- <li id="options"><a href="messages.php">Съобщения</a></li> -->
				<!-- <li id="options"><a href="lost_things.php">Изгубени вещи</a></li> -->
				<!-- <li id="options"><a style="background-color: white;" href="index.php">Сергия</a></li> -->
				<!-- <li id="options" title="Добави"><a class="btn-floating btn-medium waves-effect waves-light blue pulse" href="add.php" style="margin-top: 10%;"><i class="material-icons">+</i></a></li> -->
				<!-- <li id="image"><img src="pic/image.png" height="45" width="45"></li> -->
			<!-- </ul> -->
		<!-- </div> -->
		<div class="card-panel grey lighten-3" style="margin-left: 30%; transform: translate(-20%);">
			<div class="row">
				<form class="col s12" id="form" action="" method="POST" enctype='multipart/form-data'>
				<div class="row">
					<div class="input-field col s12">
						<input id="name" type="text" class="validate" name="name">
						<label for="name">Име</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="email" type="text" class="validate" name="email">
						<label for="email">Имейл</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="message" type="text" class="validate" name="message" placeholder="До 500 символа">
						<label for="message">Въпрос</label>
					</div>
				</div>
				 <button class="btn waves-effect waves-light" type="submit" name="action" id="action">Изпрати</button>
				</form>
			</div>
		</div>
	</body>
</html>
<script>
$(document).ready(function(){  
      $('#action').click(function(){  
    var name=$('#name').val();
    var email = $('#email').val();
    var mess=$('#message').val();
   
   if(name == '')
   {
        alert("Моля, напишете името си");
        return false;
   }
   if(email == '')
   {
        alert("Моля, напишете вашия имейл");
        return false;
   }
   if(mess == '')
   {
       alert("Моля, напишете съобщение");
        return false;
   }
   else if (mess.length > 500)
   {
       alert("Моля, напишете по-кратко съобщение");
        return false;
   }
  }); 
 });  
   
</script>
<?php
if(isset($_POST['name'])&&isset($_POST['email'])&&isset($_POST['message'])){
    if(isset($_POST['action'])){
	//изпрашане на имейл
	$to_email = "bamko2003@gmail.com";
	$subject = 'Testing PHP Mail';
	$message = 'email by: '. $_POST["name"]. 'email: '. $_POST["email"]. 'message: '. $_POST["message"];
	$headers = 'Въпрос';
	mail($to_email, $subject, $message, $headers);
	header("Location: questions.php");
	ob_enf_fluch();
}
}
?>
