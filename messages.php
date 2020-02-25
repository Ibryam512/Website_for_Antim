<html>
    <head>
		<meta charset="utf-8">
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
		<title>Съобщения</title>
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
				<li id="options"><a href="team.php">За нас</a></li>
				<li id="options"><a href="questions.php">Въпроси</a></li>
				<li id="options"><a style="background-color: white;"href="messages.php">Съобщения</a></li>
				<li id="options"><a href="lost_things.php">Изгубени вещи</a></li>
				<li id="options"><a href="index.php">Сергия</a></li>
				<li id="image"><img src="pic/LOGO.png" height="45" width="90"></li>
			</ul>
        </div>
        <?php
			//връзка с базата данни
			include 'connect.php';
			$conn = OpenCon();
			// session_start();
			//ако няма влезнал потребител го пренасочва към страницата за вход
			if(!isset($_SESSION["ID"]))
			{
				header("Location: login.html");
				return;
			}
			//заявка
			$from_id = $_SESSION["ID"];
			$mname = $_SESSION["name"];
			$sql = "SELECT * FROM messages
							LEFT JOIN users
							ON messages.from_ID = users.ID
							WHERE messages.to_ID = $from_id";
			$result = $conn->query($sql);
			//извеждане на нужната информация
			while($row = $result->fetch_assoc())
			{
				$id = $row["from_ID"];
				$name = $row["name"];
				$message = $row["message"];
				$mid = $row["MID"];
				echo "<div class='container'><p>$name</p><span>$message</span><a href></a>
					<form  method='post' action='send.php?to=$id'> 
				<input style='text-align: center;' placeholder='Отговор' name='message' id='message' class='validate'>
				<button class='btn waves-effect waves-light' type='submit' name='send' id='send'>Изпрати</button>
				</form> <form method='post' action='delete.php?id=$mid'>
				<button class='btn waves-effect waves-light red' type='submit' name='delete'>Изтрий</button></form> </div>";
			}
		
		?>

    </body>
</html>
<script>
$(document).ready(function(){  
      $('#send').click(function(){  
		   var message = $('#message').val();
		   var filter = ["gay", "gei", "basi", "geq", "ebasi", "eba", "pedal", "pederas", "pederast", "kurva", "kurwa", "pishka", "kur", "kor", "гей", "педал", "педерас", "педераст", "курва", "пишка", "кур", "кор", "еба", "бал", "ебаси"];
		   if(message == '')
		   {
				alert("Полето за съобщение е празно");
				return false;
		   }
		   for(var i = 0; i < filter.length; i++)
		   {
			   if(message.includes(filter[i]))
			   {
				   alert("Полето за съобщение съдържа обидни думи или фрази");
				   return false;
				   break;
			   }
		   }
      });  
 });  

</script>