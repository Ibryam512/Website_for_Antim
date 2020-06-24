<?php
session_start();
ob_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
		<title>Antimalnik</title>
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
		
		<?php
			//връзка с базата данни
			include 'connect.php';
			//отваряне на връзка
			$conn = OpenCon();
			$item = $_GET["item"];
			//изпълнение на заявка
			$sql = "SELECT * FROM lthings
			LEFT JOIN images
			ON lthings.imageID = images.ID
			LEFT JOIN users
			ON lthings.userID = users.ID
			ORDER BY lthings.IID DESC;";
			$result = $conn->query($sql);
			$ho=0;
			//извеждане на нужната информация
			while($row = $result->fetch_assoc())
			{
			    $ho=1;
				$title = $row["title"];
				$desc = $row["description"];
				$image = $row["image"];
				$date = $row["date"];
				$id = $row["IID"];
				$name = $row["name"];
				$secName = $row["secName"];
				$lastName = $row["lastName"];
				$userID = $row["userID"];
				if($item == $id)
				{
					echo "<div class='card-panel grey lighten-3' style='margin-left: 17%; transform: translate(-10%);'>
							<h3 style='text-align: center;'>$title</h3>
							<div style='text-align: center;' >
							<img style='object-fit:contain;max-height:500;max-width:100%' src='data:image/jpeg;base64,".base64_encode($image)."' height='500' width='980' class='img-thumnail' />
							</div>
						</div>
						<div class='card-panel grey lighten-3' style='margin-left: 17%; transform: translate(-10%);'>
							<h4 style='text-align: center;'>Описание</h4>
							<p>$desc</p>
						</div>
						<div class='card-panel grey lighten-3' style='margin-left: 17%; transform: translate(-10%);'>
							<h4 style='text-align: center;'>Връзка с потребител</h4>
							<p>На: $name $secName $lastName</p>
							<form  method='post' action='send.php?to=$userID'> 
								<p>Съобщение:</p>
								<input style='text-align: center; font-size: 27px;' placeholder='Съобщение' name='message' id='message' class='validate'>
								<button class='btn waves-effect waves-light' type='submit' name='send' id='send' style='font-size: 24px;'>Изпрати</button>
							</form>
						</div>
						<div class='card-panel grey lighten-3' style='margin-left: 17%; transform: translate(-10%);'>
							<h4 style='text-align: center;'>Дата</h4>
							<p>Обявата е валидна до $date</p>
						</div>";
						break;
				}
			}
			if($ho == 0){
			    echo"<p style='text-align: center;'>Възникна проблем</p>";
			}
		?>
	</body>
</html>
<script>
$(document).ready(function(){  
      $('#send').click(function(){  
		   var message = $('#message').val();
		   
		   var filter = ["gay", "gei", "basi", "geq", "ebasi", "eba", "pedal", "pederas", "pederast", "kurva", "kurwa", "pishka", "kur", "kor", "гей", "педал", "педерас", "педераст", "курва", "пишка", "кур", "кор", "еба", "бал", "ебаси""GEY", "GEI", "BASI", "GEQ", "EBASI", "EBA", "PEDAL", "PEDERAS", "PEDERAST", "KURVA", "KURWA", "PISHKA", "KUR", "KOR", "ГЕЙ", "ПЕДАЛ", "ПЕДЕРАС", "ПЕДЕРАСТ", "КУРВА", "ПИШКА", "КУР", "КОР", "ЕБА", "ЕБАСИ"];
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