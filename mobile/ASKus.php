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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="js/jquery.js"></script>
		<script src="js/materialize.js"></script>
		<script src="js/script.js"></script>
	</head>
	<body>
			    <!-- Top Navigation Menu -->
		<div class="topnav">
			<a href="#home" class="active">Меню</a>
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
		
		<div class="card-panel grey lighten-3" style="margin-left: 30%; margin-top: 40%; transform: translate(-20%);">
			<div class="row" height='100%'>
				<form class="col s12" id="form" action="" method="POST" enctype='multipart/form-data'>
				<div class="row"></div>
				<div class="row">
					<div class="input-field col s12">
						<input id="name" type="text" class="validate" name="name" style="font-size: 27px;">
						<label for="name" style="font-size: 27px;">Име</label>
					</div>
				</div>
				<div class="row"></div>
				<div class="row">
					<div class="input-field col s12">
						<input id="email" type="text" class="validate" name="email" style="font-size: 27px;">
						<label for="email" style="font-size: 27px;">Имейл</label>
					</div>
				</div>
				<div class="row"></div>
				<div class="row">
					<div class="input-field col s12">
						<input id="message" type="text" class="validate" name="message" placeholder="До 500 символа" style="font-size: 27px;">
						<label for="message" style="font-size: 27px;">Въпрос</label>
					</div>
				</div>
				 <button class="btn waves-effect waves-light" type="submit" name="action" id="action" style="font-size: 24px;">Изпрати</button>
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
