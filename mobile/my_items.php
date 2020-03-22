<?php
session_start();
ob_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
		<title>Мои обяви</title>
		<link rel="icon" href="pic/LOGO.png">
		<link rel="stylesheet" href="css\style.css">
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="js/jquery.js"></script>
		<script src="js/materialize.js"></script>
		<script src="js/script.js"></script>
	</head>
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
				//включваме файлът за връзка с базата данни
				include 'connect.php';
								
				//функция за извеждане на всички постове на потребителя
				function Show()
				{
					//отваряме връзка
					$conn = OpenCon();
					
					if(!isset($_SESSION["ID"]))
					{
						header("Location: login.php");
						ob_enf_fluch();
						return;
					}
					$idd = $_SESSION["ID"];
					//изпълняваме заявка
					$sql = "SELECT * FROM items
							LEFT JOIN images
							ON items.imageID = images.ID
							LEFT JOIN users
							ON items.userID = users.ID
							WHERE items.userID = $idd
							ORDER BY items.IID DESC;";
					$result = $conn->query($sql);
					$smth = 0;
					$ho=0;
					echo"<table height='100%'>";
					//извеждаме нужната информация
					while($row = $result->fetch_assoc())
					{
					    $ho++;
					    $ho++;
						$title = $row["title"];
						$desc = $row["description"];
						$image = $row["image"];
						$price=$row['price'];
						$id = $row["IID"];
						
							echo"<tr width='50%'>
									<td width='50%'><div id='post' class='card' style='max-width:700;'>
									<div class='card-image waves-effect waves-block waves-light'>
										<a href='detail.php?item=$id' title='Пълен размер'><img style='max-height:800' src='data:image/jpeg;base64,".base64_encode($image)."' class='img-thumnail' /></a>
									</div>
									<div class='card-content'style='background-color: white;'>
										<span class='card-title activator grey-text text-darken-4'>$title<i class='material-icons right'>$price лв.</i></span>
										<p><b>За продажба</b></p>
										<a href='edit_i.php?id=$id'><button class='btn waves-effect waves-light blue' type='submit' name='edit'>Редактирай</button></a>
										<a href='delete_item.php?id=$id'><button class='btn waves-effect waves-light red' type='submit' name='delete'>Изтрий</button></a>
									</div>
									<div class='card-reveal'>
										<span class='card-title grey-text text-darken-4'>$title<i class='material-icons right'>затвори</i></span>
										<p>$desc</p>
									</div></td>";
							$smth++;		
						
					}
					
					
					$idd = $_SESSION["ID"];
					$sql = "SELECT * FROM lthings
							LEFT JOIN images
							ON lthings.imageID = images.ID
							LEFT JOIN users
							ON lthings.userID = users.ID
							WHERE lthings.userID = $idd
							ORDER BY lthings.IID DESC;";
					$result = $conn->query($sql);
					//извеждаме нужната информация
					while($row = $result->fetch_assoc())
					{
					    $ho++;
						$title = $row["title"];
						$desc = $row["description"];
						$image = $row["image"];
						$id = $row["IID"];
							echo"<tr>
									<td width='50%'><div id='post' class='card'style='max-width:700;' >
									<div class='card-image waves-effect waves-block waves-light'>
										<a href='detail_lt.php?item=$id' title='Пълен размер'><img style='max-height:800' src='data:image/jpeg;base64,".base64_encode($image)."' class='img-thumnail' /></a>
									</div>
									<div class='card-content'style='background-color: white;'>
										<span class='card-title activator grey-text text-darken-4'>$title<i class='material-icons right'>...</i></span>
										<p><b>Изгубена вещ</b></p>
										<a href='edit_l.php?id=$id'><button class='btn waves-effect waves-light blue' type='submit' name='edit'>Редактирай</button></a>
										<a href='delete_lthing.php?id=$id'><button class='btn waves-effect waves-light red' type='submit' name='delete'>Изтрий</button></a>
									</div>
									<div class='card-reveal'>
										<span class='card-title grey-text text-darken-4'>$title<i class='material-icons right'>затвори</i></span>
										<p>$desc</p>
									</div></td>";
							$smth++;		
						
					}
					if($ho == 0){
					    echo"<p style='text-align: center;'>Нямате обяви</p>";
					}
				}
				Show();
			?>
		</table>
	</body>
</html>