<?php
session_start();
ob_start()
?>
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
			<ul>
			<ul id="dropdown1" class="dropdown-content">
					<li><a href="Profile.php">Профил</a></li>
					<li class="divider"></li>
					<li><a href="my_items.php">Мои обяви</a></li>
			</ul>
            <?php
            	if(!empty($_SESSION['image'])){
                	$i=$_SESSION['image'];
                	$l="pic/PROF/".$i;
					echo "<div class='nav-wrapper'>
					<il id='options'><a class='dropdown-trigger' href='Profile.php' data-target='dropdown1'>
					<button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'>
					<img style='border-radius: 5000px;' src='$l'height='44' width='44'></button></a></il></div>";
            	}
            	else{
            	    if(empty($_SESSION['ID'])){
						echo "<li id='options' >
						<a class='waves-effect waves-light btn' href='register.php' style='width:220;margin-top:6;margin-left:6'>
						<i class='material-icons'>Регистрирай се</i></a></li>";
            	        
					echo "<li id='options'>
					<a class='waves-effect waves-light btn' href='logIn.php' style='margin-top:6;width:100;'>
					<i class='material-icons'>Вход</i></a></li>";
            	    }
            	    else if(!empty($_SESSION['ID'])){
					echo "<div class='nav-wrapper'><il id='options'><a class='dropdown-trigger' href='Profile.php' data-target='dropdown1'><button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'><img style='border-radius: 5000px;' src='pic/profilePic.png'height='44' width='44'></button></a></il></div>";
            	    }
            	}
			?>
				<li id="options"><a href="team.php">За нас</a></li>
				<li id="options"><a href="questions.php">Въпроси</a></li>
				<li id="options"><a style="background-color: white;"  href="messages.php">Съобщения</a></li>
				<li id="options"><a href="lost_things.php">Изгубени вещи</a></li>
				<li id="options"><a href="index.php">Сергия</a></li>
				
				<li id="image"><img src="pic/pngfuel.com.png" height="45" width="45"></li>
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
				echo"<p style='text-align: center;'>Моля, влезте в профила си, за да използвате тази услуга</p>";
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
			$ho=0;
			//извеждане на нужната информация
			while($row = $result->fetch_assoc())
			{
			    $ho++;
				$id = $row["from_ID"];
				$name = $row["name"];
				$message = $row["message"];
				$date = $row["date"];
				$mid = $row["MID"];
				echo "<div class='post container' style='margin-top:50; border: 2px solid #dedede;
	background-color: #f1f1f1;
	border-radius: 5px;
	padding: 10px;'><b>$name</b><p><span>$message</span></p><a href></a>
					<form  method='post' action='send.php?to=$id'> 
				<input style='text-align: center;' placeholder='Отговор' name='message' id='message' class='validate'>
				<button class='btn waves-effect waves-light' type='submit' name='send' id='send'>Изпрати</button>
				</form> <form method='post' action='delete.php?id=$mid'>
				<button class='btn waves-effect waves-light red' type='submit' name='delete'>Изтрий</button></form>
				<p style='text-align:right'>Изпратено на: $date</p></div>";
			}
			$sql = "UPDATE messages SET seen = true WHERE to_ID = $from_id";
			$conn->query($sql);
		    if($ho === 0){
			        echo"<p style='text-align: center;'>Няма съобщения</p>";
			}
			
		?>
        <div style="text-align: center; margin-top: 10px; margin-bottom: 10px;"><a href="sent.php" class='waves-effect waves-light btn' >Виж изпратени</a></div>
			
	</body>
</html>
<script>
$(document).ready(function(){  
      $('#send').click(function(){  
		   var message = $('#message').val();
		   
		   var filter = ["gay", "gei", "basi", "geq", "ebasi", "eba", "pedal", "pederas", "pederast", "kurva", "kurwa", "pishka", "kur", "kor", "гей", "педал", "педерас", "педераст", "курва", "пишка", "кур", "кор", "еба", "бал", "ебаси", "GEY", "GEI", "BASI", "GEQ", "EBASI", "EBA", "PEDAL", "PEDERAS", "PEDERAST", "KURVA", "KURWA", "PISHKA", "KUR", "KOR", "ГЕЙ", "ПЕДАЛ", "ПЕДЕРАС", "ПЕДЕРАСТ", "КУРВА", "ПИШКА", "КУР", "КОР", "ЕБА", "ЕБАСИ"];
		   if(message == '')
		   {
				alert("Полето за съобщение е празно");
				return false;
		   }
		  else
		   {
    		   for(var i = 0; i < filter.length; i++)
    		   {
    			   if(message.includes(filter[i]))
    			   {
    				   alert("Полето за съобщение съдържа обидни думи или фрази");
    				   return false;
    				   break;
    			   }
    		   }
		   }
      });  
 }); 
 
</script>