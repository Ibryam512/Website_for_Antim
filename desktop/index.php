<?php
	session_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
		<title>Сергия</title>
		<link rel="icon" href="pic/LOGO.png">
		<link rel="stylesheet" href="css/style.css">
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
						echo "<div class='nav-wrapper'><il id='options'><a class='dropdown-trigger' href='Profile.php' data-target='dropdown1'><button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'><img style='border-radius: 5000px;' src='$l'height='44' width='44'></button></a></il></div>";
					}
					else{
						if(empty($_SESSION['ID'])){
							echo "<li id='options'><a class='waves-effect waves-light btn' href='register.php' style='width:220;margin-top:6;margin-left:6'><i class='material-icons'>Регистрирай се</i></a></li>";
							
						echo "<li id='options'><a class='waves-effect waves-light btn' href='login.php' style='margin-top:6;width:100;'><i class='material-icons'>Вход</i></a></li>";
						}
						else if(!empty($_SESSION['ID'])){
						echo "<div class='nav-wrapper'><il id='options'><a class='dropdown-trigger' href='Profile.php' data-target='dropdown1'><button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'><img style='border-radius: 5000px;' src='pic/profilePic.png'height='44' width='44'></button></a></il></div>";
						}
					}
				?>
				<li id="options"><a href="team.php">За нас</a></li>
				<li id="options"><a href="questions.php">Въпроси</a></li>
				<?php
					include 'connect.php';
					if(!empty($_SESSION['ID']))
					{
						$id = $_SESSION['ID'];
						$conn = OpenCon();
						$sql = "SELECT * FROM messages
								WHERE seen = FALSE AND to_id = $id";
						$result = $conn->query($sql);
						$messages = 0;
						while($row = $result->fetch_assoc())
						{
							$messages++;
						}
						if($messages > 0)
						{
							echo "<li id='options'><a href='messages.php' class='notification'><span>Съобщения</span><span class='badge'>$messages</span></a></li>";
						}
						else
						{
							echo "<li id='options'><a href='messages.php'>Съобщения</a></li>";
						}
					}
					else
					{
						echo "<li id='options'><a href='messages.php'>Съобщения</a></li>";
					}
				?>
				<li id="options"><a href="lost_things.php">Изгубени вещи</a></li>
				<li id="options"><a style="background-color: white;" href="index.php">Сергия</a></li>
				<li id="options" title="Добави"><a class="btn-floating btn-medium waves-effect waves-light blue pulse" href="add.php" style="margin-top: 10%;"><i class="material-icons">+</i></a></li>
				<li id="image"><img src="pic/image.png" height="45" width="45"></li>
			</ul>
		</div>
		<div id="search" class="container">
			<div class="card">
				<div class="card-content">
				<form method="post" action="index.php"> 
					<div class="row">
						<div class="input-field col s10" style="background-color: white;" >
							<input style="text-align: center;" placeholder="Търси" name="search" id="search" type="text" class="validate">
						</div>
						<div class="input-field col s2">
							<button class="btn waves-effect waves-light" type="submit" name="submit">Търси</button>
						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	<div class="row" width="100%" height="100%" style="border-collapse: unset;">
			
			<?php
				function DisCard($id,$image,$title,$price,$desc){
					
					echo "
					<div class='card-table col s4 m4 l4'>
						<div class='post card z-depth-5 hoverable' style='transform:translate(0%,0%)'>
							<div class='card-image waves-effect waves-block waves-light'>
								<a href='detail.php?item=$id' title='Пълен размер'><img style='max-height:600' src='data:image/jpeg;base64," . base64_encode($image) . "' class='img-thumnail' /></a>
							</div>
							<div class='card-content' style='background-color: white;'>
								<span title='Надникни' class='card-title activator grey-text text-darken-4'>$title</span>
							</div>
							<div class='card-reveal'>
								<span class='card-title grey-text text-darken-4'>$title</span>
								<p>$desc</p>
							</div>
						</div>
					</div>";
				}
				//включваме файлът за връзка с базата данни
				//include 'connect.php';
				//функция за търсене на постове
				function Search()
				{
					//отваряме връзка
					$conn = OpenCon();
					//прожеряваме дали трябва да покажем всичко или само част от обявите
					if(isset($_POST["search"])){
						//само някой ще се покажат
						$search = strtolower($_POST["search"]);
						$F="'%";
						$E="%'";
						$pos=strpos($search,$F);
						$pos2=strpos($search,$E);
						if($pos !== false || $pos2 !== false)
						{
							echo"Няма намерени резултати";
							return;
						}
					}
					else{
						//всички ще се покажат
						$search = "";
					}
					//изпълняваме заявка
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
							$price=$row['price'];
							$id = $row["IID"];
							if($smth % 2 == 0)
							{
								echo"<tr>";
								echo DisCard($id,$image,$title,$price,$desc);
								$smth++;		
							}
							else
							{
								echo DisCard($id,$image,$title,$price,$desc);
								echo"</tr>";
								$smth++;
							}
						}
					if($smth == 1){
						echo"<td width='50%'></td>";
					}
					else if($smth==0)
					{
						echo"Няма намерени резултати";
						return;
					}
				}
				Search();
			?>
		</div>
		<script>
			let i = 0;
			[...document.querySelectorAll(".post")]
			.forEach(post => setTimeout(() => post.className += " shown", 150 * i++));
		</script>
	</body>
</html>