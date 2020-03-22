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
        <?php
			//връзка с базата данни
			include 'connect.php';
			$conn = OpenCon();
			// session_start();
			//ако няма влезнал потребител го пренасочва към страницата за вход
			if(!isset($_SESSION["ID"]))
			{
				header("Location: login.php");
				ob_enf_fluch();
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
				echo "<div class='container'><b>$name</b><p><span>$message</span></p><a href></a>
					<form  method='post' action='send.php?to=$id'> 
				<input style='text-align: center;' placeholder='Отговор' name='message' id='message' class='validate'>
				<button class='btn waves-effect waves-light' type='submit' name='send' id='send'>Изпрати</button>
				</form> <form method='post' action='delete.php?id=$mid'>
				<button class='btn waves-effect waves-light red' type='submit' name='delete'>Изтрий</button></form>
				<p style='text-align:right'>Изпратено на: $date</p></div>";
			}
		    if($ho === 0){
			        echo"<p style='text-align: center;'>Няма съобщения</p>";
			}
		?>

    </body>
</html>
<script>
//създаване на филтър със забранени думи
$(document).ready(function(){  
      $('#send').click(function(){  
	  //взимаме съобщението
		   var message = $('#message').val();
		   
		   //забранените думи
		   var filter = ["gay", "gei", "basi", "geq", "ebasi", "eba", "pedal", "pederas", "pederast", "kurva", "kurwa", "pishka", "kur", "kor", "гей", "педал", "педерас", "педераст", "курва", "пишка", "кур", "кор", "еба", "ебаси",
		   "GEY", "GEI", "BASI", "GEQ", "EBASI", "EBA", "PEDAL", "PEDERAS", "PEDERAST", "KURVA", "KURWA", "PISHKA", "KUR", "KOR", "ГЕЙ", "ПЕДАЛ", "ПЕДЕРАС", "ПЕДЕРАСТ", "КУРВА", "ПИШКА", "КУР", "КОР", "ЕБА", "ЕБАСИ"];
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