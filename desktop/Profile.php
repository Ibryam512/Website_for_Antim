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
					if(!empty($_SESSION['ID'])){
						echo"<li id='options'><a href='my_items.php'>Моите обяви</a></li>";
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
				<li id="options"><a href="index.php">Сергия</a></li>
				<li id="image"><img src="pic/LOGO.png" height="45" width="90"></li>
			</ul>
		</div>
		<?php
			if(!isset($_SESSION['email'])||!isset($_SESSION['password'])){
				echo"<div style='text-align: center;'>";
				echo"<a style='margin-right:1%' href='login.php' class='waves-effect waves-light btn-large'>Влез в акаунта си</a>";
				echo"<a style='margin-left:1%' href='register.php' class='waves-effect waves-light btn-large'>Регистрирай се</a>";
				echo"</div>";
				exit();
			}
		?>
		<div class="container row">
			<div class="col m12">
				<div class="card">
					<div class="row">
						<div class="col s4 offset-s4">
							<?php
								if(!empty($_SESSION['image'])){
									$i=$_SESSION['image'];
									$l="pic/PROF/".$i;
									echo"<img style='border-radius: 50%; width: 100%; height: auto;' src='$l'>";
								}
								else{
									echo"<img style='border-radius: 50%; width: 100%; height: auto;' src='pic/profilePic.png' >";
								}
							?>
						</div>
						<div class="col s1 offset-s3">
							<a href="CHprofile.php">
								<img class="hoverable" style="border-radius: 50%; width: 75%; height: auto; margin-top: 25%;" src="pic/Edit.png">
							</a>
						</div>
					</div>
					<div class="card-content">
						<div style="text-align: center;">
							<div class="input-field col s6">
								<?php
									$value = $_SESSION['name'];
									echo "<input id='name' disabled value='$value'>";
								?>
								<label class='active' for='name'>Име</label>
							</div>
						</div>
						<div style="text-align: center;">
							<div class="input-field col s6">
								<?php
									$pass=$_SESSION['password'];
									$new="";
									$int=0;
									while($int <= strlen($pass)){
										$new .= '*';
										$int++;
									}
									echo"<input id='name' disabled value='$new'>";
								?>
								<label class='active' for='name'>Парола</label>
							</div>
						</div>
						<div style="text-align: center;">
							<div class="input-field col s6">
								<?php
									$value = $_SESSION['secName'];
									echo "<input id='name' disabled value='$value'>";
								?>
								<label class='active' for='name'>Презиме</label>
							</div>
						</div>
						<div style="text-align: center;margin-bottom: 50;">
							<div class="input-field col s6">
								<?php
									$value = $_SESSION['lastName'];
									echo "<input id='name' disabled value='$value'>";
								?>
								<label class='active' for='name'>Имейл</label>
							</div>
						</div>
						<div style="text-align: center;">
							<div class="input-field col s6">
								<?php
									$value = $_SESSION['lastName'];
									echo "<input id='name' disabled value='$value'>";
								?>
								<label class='active' for='name'>Фамилия</label>
							</div>
						</div>
						<form method="POST" action="">
							<div style="text-align: center;margin-bottom: 50;">
								<button type="submit" id="logout" name="logout" class='waves-effect waves-light btn-large' >Излез от профила</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php
	if(isset($_POST['logout'])){
		unset($_SESSION['ID']);
		unset($_SESSION['email']);
		unset($_SESSION['password']);
		unset($_SESSION['name']);
		unset($_SESSION['secName']);
		unset($_SESSION['lastName']);
		unset($_SESSION['image']);
		header("Location:Profile.php");
		ob_enf_fluch();
	}
?>