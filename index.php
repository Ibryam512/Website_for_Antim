<html>
	<head>
		<meta charset="utf-8">
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
		<title>Сергия</title>
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
					<li><a href="my_items.php">Мои обяви</a></li>
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
				<li id="options"><a style="background-color: white;" href="index.php">Сергия</a></li>
				<li id="options" title="Добави"><a class="btn-floating btn-medium waves-effect waves-light blue pulse" href="add.php" style="margin-top: 10%;"><i class="material-icons">+</i></a></li>
				<li id="image"><img src="pic/image.png" height="45" width="45"></li>
			</ul>
		</div>
		<div id="search">
			<form  method="post" action="index.php"> 
				<div class="input-field col s12 " style="background-color: white;" >
                  <input style="text-align: center;" placeholder="Търси" name="search" id="search" type="text" class="validate">
                </div>
				<button class="btn waves-effect waves-light" type="submit" name="submit">Търси</button>
			</form> 
		</div>
		<table width="100%" height="100%">
			<?php
				//включваме файлът за връзка с базата данни
				include 'connect.php';
				//функция за търсене на постове
				function Search()
				{
					//отваряме връзка
					$conn = OpenCon();
					//изпълняваме заявка
					$search = strtolower($_POST["search"]);
					$sql = "SELECT * FROM items
							LEFT JOIN images
							ON items.imageID = images.ID
							WHERE LOWER(title) LIKE '%$search%'";
					$result = $conn->query($sql);
					$smth = 0;
					//извеждаме нужната информация
					while($row = $result->fetch_assoc())
					{
						$title = $row["title"];
						$desc = $row["description"];
						$image = $row["image"];
						$id = $row["IID"];
						if($smth % 2 == 0)
						{
							echo"<tr >
									<td width="50%"><div id='post' class='card'>
									<div class='card-image waves-effect waves-block waves-light'>
										<a href='detail.php?item=$id' title='Пълен размер'><img style='max-height:500' src='data:image/jpeg;base64,".base64_encode($image)."' class='img-thumnail' /></a>
									</div>
									<div class='card-content'>
										<span  class='card-title activator grey-text text-darken-4'>$title<i class='material-icons right'>...</i></span>
									</div>
									<div class='card-reveal'>
										<span class='card-title grey-text text-darken-4'>$title<i class='material-icons right'>затвори</i></span>
										<p>$desc</p>
									</div></td>";
							$smth++;		
						}
						else
						{
							echo"	<td width="50%"><div id='post' class='card'>
									<div class='card-image waves-effect waves-block waves-light'>
										<a href='detail.php?item=$id' title='Пълен размер'><img style='max-height:500' src='data:image/jpeg;base64,".base64_encode($image)."' class='img-thumnail' /></a>
									</div>
									<div class='card-content'>
										<span class='card-title activator grey-text text-darken-4'>$title<i class='material-icons right'>...</i></span>
									</div>
									<div class='card-reveal'>
										<span class='card-title grey-text text-darken-4'>$title<i class='material-icons right'>затвори</i></span>
										<p>$desc</p>
									</div></td></tr>";
							$smth++;
						}
					}
					
				}
				//функция за извеждане на всички постове
				function Show()
				{
					//отваряме връзка
					$conn = OpenCon();
					//изпълняваме заявка
					$sql = "SELECT * FROM items
							LEFT JOIN images
							ON items.imageID = images.ID
							ORDER BY items.IID DESC;";
					$result = $conn->query($sql);
					$smth = 0;
					//извеждаме нужната информация
					while($row = $result->fetch_assoc())
					{
						$title = $row["title"];
						$desc = $row["description"];
						$image = $row["image"];
						$id = $row["IID"];
						if($smth % 2 == 0)
						{
							echo"<tr>
									<td width="50%"><div id='post' class='card' >
									<div class='card-image waves-effect waves-block waves-light'>
										<a href='detail.php?item=$id' title='Пълен размер'><img style='max-height:500' src='data:image/jpeg;base64,".base64_encode($image)."' class='img-thumnail' /></a>
									</div>
									<div class='card-content'style='background-color: white;'>
										<span class='card-title activator grey-text text-darken-4'>$title<i class='material-icons right'>...</i></span>
									</div>
									<div class='card-reveal'>
										<span class='card-title grey-text text-darken-4'>$title<i class='material-icons right'>затвори</i></span>
										<p>$desc</p>
									</div></td>";
							$smth++;		
						}
						else
						{
							echo"	<td width="50%"><div id='post' class='card'>
									<div class='card-image waves-effect waves-block waves-light'>
										<a href='detail.php?item=$id' title='Пълен размер'><img style='max-height:500' src='data:image/jpeg;base64,".base64_encode($image)."' class='img-thumnail' /></a>
									</div>
									<div class='card-content'style='background-color: white;'>
										<span class='card-title activator grey-text text-darken-4'>$title<i class='material-icons right'>...</i></span>
									</div>
									<div class='card-reveal'>
										<span class='card-title grey-text text-darken-4'>$title<i class='material-icons right'>затвори</i></span>
										<p>$desc</p>
									</div></td></tr>";
							$smth++;
						}
					}
				}
				//проверка дали потребителя търси пост
				if(isset($_POST["submit"]))
				{
					Search();
				}
				else
				{
					Show();
				}
			?>
		</table>
	</body>
</html>