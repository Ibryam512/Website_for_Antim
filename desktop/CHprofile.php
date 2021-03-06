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
					if(!empty($_SESSION['image'])) {
						$i = $_SESSION['image'];
						$l = "pic/PROF/" . $i;
						echo "<div class='nav-wrapper'><il id='options'><a class='dropdown-trigger' href='Profile.php' data-target='dropdown1'>
						<button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'>
						<img style='border-radius: 5000px;' src='$l'height='44' width='44'></button></a></il></div>";
					}
					else{
						if (empty($_SESSION['ID'])) {
							echo "<li id='options'>
							<a class='waves-effect waves-light btn' onclick='openFormR()' style='width:220;margin-top:6;margin-left:6'>
							<i class='material-icons'>Регистрирай се</i></a></li>";
							echo "<li id='options'>
							<a class='waves-effect waves-light btn' onclick='openForm()' style='margin-top:6;width:100;'>
							<i class='material-icons'>Вход</i></a></li>";
						}
						else if (!empty($_SESSION['ID'])) {
							echo "<div class='nav-wrapper'><il id='options'>
							<a class='dropdown-trigger' href='Profile.php' data-target='dropdown1'>
							<button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'>
							<img style='border-radius: 5000px;' src='pic/profilePic.png'height='44' width='44'>
							</button></a></il></div>";
						}
					}
				?>
				<li id="options"><a href="team.php">За нас</a></li>
				<li id="options"><a href="questions.php">Въпроси</a></li>
				<?php
					include 'connect.php';
					$conn = OpenCon();
					if(!empty($_SESSION['ID']))
					{
						$id = $_SESSION['ID'];
						$sql = "SELECT * FROM messages WHERE seen = FALSE AND to_id = $id";
						$result = $conn->query($sql);
						$messages = 0;
						while($row = $result->fetch_assoc())
							$messages++;
						if($messages > 0)
							echo "<li id='options'><a href='messages.php' class='notification'><span>Съобщения</span><span class='badge'>$messages</span></a></li>";
						else
							echo "<li id='options'><a href='messages.php'>Съобщения</a></li>";
					} else
						echo "<li id='options'><a href='messages.php'>Съобщения</a></li>";
				?>
				<li id="options"><a href="lost_things.php">Изгубени вещи</a></li>
				<li id="options"><a href="index.php">Сергия</a></li>
				<li id="options" title="Добави"><a class="btn-floating btn-medium waves-effect waves-light blue pulse" href="add.php" style="margin-top: 10%;"><i class="material-icons">+</i></a></li>
				<li id="image"><img src="pic/LOGO.png" height="45" width="90"></li>
			</ul>
		</div>
		<div class="container row">
			<div class="col m12">
				<div class="card">
					<div class="card-content">
						<form action="" method="POST" enctype="multipart/form-data">
							<div style="text-align: center;">
								<?php
									echo "<div>";
									echo '<div class="col s4 offset-s4">';
									if(!empty($_SESSION['image'])) {
										$i = $_SESSION['image'];
										$l = "pic/PROF/" . $i;
										echo "<img style='border-radius: 50%; width: 100%; height: auto;' src='$l'>";
									}
									else
										echo"<img style='border-radius: 50%; width: 100%; height: auto;' src='pic/profilePic.png'>";
									
									$name = $_SESSION['name'];
									$secName = $_SESSION['secName'];
									$lastName = $_SESSION['lastName'];
									$pass = $_SESSION['password'];
									$email = $_SESSION['email'];
									
									echo '</div></div>
									<div class="col s4 offset-s4">
										<input type="file" name="photo" id="photo">
									</div>
									<div class="row">
										<div class="input-field col s6">
											<input name="name" id="name" type="text" class="validate" value='.$name.'>
											<label class="active" for="name">Име</label>
										</div>
										<div class="input-field col s6">
											<input name="password" id="password" type="password" class="validate" value='.$pass.'>
											<label class="active" for="name">Парола</label>
										</div>
										<div class="input-field col s6"> 
											<input name="secName" id="secName" type="text" class="validate" value='.$secName.'>
											<label class="active" for="name">Презиме</label>
										</div>
										<div class="input-field col s6">
											<input name="email" id="email" type="email" class="validate" value='.$email.'>
											<label class="active" for="name">Имейл</label>
										</div>
										<div  class="input-field col s6">
											<input name="lastName" id="lastName" type="text" class="validate" value='.$lastName.'>
											<label class="active" for="name">Фамилия</label>
										</div>
										<div class="input-field col s6">	
											<button style="text-align: center;" class="waves-effect waves-light btn-large" type="submit" name="save" id="save">Запази</button>
										</div>
									</div>';
								?>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--Forms to slide-->
		<div class="form-popup" id="myForm">
			<form action="login.php" class="form-container">

				<button type="button" style="background-color: white; border: white;margin-left: 93%;" onclick="closeForm()">Х</button>

				<center>
				<h4 style="color: black;">Вход</h4>
				</center>

				<label for="email"><b>Имейл</b></label>
				<input type="email" placeholder="Въведете имейл" name="email" required>

				<label for="psw"><b>Парола</b></label>
				<input type="password" placeholder="Въведете парола" name="psw" required>

				<button type="submit" class="btn" id="log">Вход</button>
			</form>
		</div>
		<div class="form-popup" id="myFormR">
			<form action="register.php" class="form-containerR">

				<button type="button" style="background-color: white; border: white;margin-left: 93%;" onclick="closeFormR()">Х</button>

				<center>
				<h4 style="color: black;">Регистрирай се</h4>
				</center>
				
				<label for="name"><b>Име</b></label>
				<input type="text" placeholder="Име" name="name" id="name" required>
				
				<label for="secName"><b>Презиме</b></label>
				<input type="text" placeholder="Презиме" name="secName" id="secName" required>
				
				<label for="lastName"><b>Фамилия</b></label>
				<input type="text" placeholder="Фамилия" name="lastName" id="lastName" required>

				<label for="email"><b>Имейл</b></label>
				<input type="email" placeholder="Въведете имейл" name="email" id="email" required>

				<label for="psw"><b>Парола</b></label>
				<input type="password" placeholder="Въведете парола" name="psw" id="password" required>
				
				<label for="psw2"><b>Повтори паролата</b></label>
				<input type="password" placeholder="Повтори паролата" name="psw2" id="password2" required>
				
                 <label>
                <input type="checkbox" class="filled-in" name="check" id="check" />
                <span style="color: black;" ><a href="info.html" target="_blank">Условия за използване.</a></span>
              </label>

				<button type="submit" class="btn" id="reg">Регистрирай се</button>
			</form>
		</div>
	</body>
</html>
<script>
				document.addEventListener('DOMContentLoaded', function() {
				var elems = document.querySelectorAll('.sidenav');
				var instances = M.Sidenav.init(elems, options);
			});
				$(document).ready(function(){
				$('.sidenav').sidenav();
			});
			function openForm() {
				document.getElementById("myFormR").style.display = "none";
			document.getElementById("myForm").style.display = "block";
			}
			
			function closeForm() {
			document.getElementById("myForm").style.display = "none";
			}


			function openFormR() {
				document.getElementById("myForm").style.display = "none";
			document.getElementById("myFormR").style.display = "block";
			}
			
			function closeFormR() {
			document.getElementById("myFormR").style.display = "none";
			}
			
			 $(document).ready(function(){  
    $('#reg').click(function(){  
      var name = $('#name').val();
      var secname = $('#secName').val();
      var lastname = $('#lastName').val();
      var pass = $('#password').val();
      var pass2 = $('#password2').val(); 
      var email = $('#email').val();
      var check = $('#check').val();
		   
      if(name == ''||secname == ''||lastname == '')
      {
				alert("Моля, напишете имената си");
				return false;
      }
      if(pass == '')
      {
				alert("Моля, напишете паролата си");
				return false;
      }
      if(pass2 == ''){
        alert("Моля, повторете паролата си");
        return false;
      }
      else if(pass.length < 6 )
      {
				alert("Паролата трябва да е с минимум 6 знака");
				return false;
      }
      else if(pass != pass2){
        alert("Паролата e грешна");
				return false;
      }
      if(email == '')
      {
				alert("Моля, напишете вашия имейл");
				return false;
      }
      if(!document.getElementById('check').checked){
        alert("Моля, съгласете се с условията");
				return false;
      }
    });  
  });  
  $(document).ready(function(){  
    $('#log').click(function(){ 
      var password = $('#password').val();
      var email = $('#email').val();
      if(email == '')
      {
        alert("Моля, напишете вашия имейл");
        return false;
      }
      if(password == '')
      {
        alert("Моля, напишете паролата си");
        return false;
      }
    });  
  });  
</script>
<?php
	//свъзваме се с базата данни
	//ако са кликнали бутона за запазване
	if(isset($_POST['save'])){
		$conn=OpenCon();
		$email1=hash('sha256',$_SESSION['email']."Ibrqm,Venci");
		$password=hash('sha256',$_SESSION['password']."Ibrqmov,Nenov");
		
		//взимаме id-то на вече влезналия в профила си портребител
		$sql="SELECT * FROM users";
		$result = $conn->query($sql);
		$int = 0;
		$dbID = -1;
		while($int < $row=$result->num_rows){
			$row = $result->fetch_assoc();
			$dbEmail = $row['e-mail'];
			$dbPassword = $row['pass'];
			if($dbEmail === $email1  &&  $dbPassword === $password){
				$dbID=$row['id'];
				break;
			}
			$int++;
		}	
		$email = hash('sha256', $_POST['email']."Ibrqm,Venci");
		$password = hash('sha256', $_POST['password']."Ibrqmov,Nenov");
		//ако сме намерили такъв портебител
		if($dbID != -1){
		
				$emailii = $_POST['email'];
				$passii = $_POST['password'];
				$name = $_POST['name'];
				$secName = $_POST['secName'];
				$lastName = $_POST['lastName'];
				// взимаме данните от профилната му снимка
				$image = $_FILES["photo"]["tmp_name"];

			// ако е избрал снимка 
			if(empty($image)){
				//дали са попълнени полетата
				if(!empty($_POST['name'])&&!empty($_POST['secName'])&&!empty($_POST['lastName'])&&!empty($_POST['password'])&&!empty($_POST['email'])){
						
						$sql="UPDATE `users` SET `e-mail`='$email',`pass`='$password',`name`='$name',`secName`='$secName',`lastName`='$lastName' WHERE id=$dbID";
						$result = $conn->query($sql);
						$_SESSION['email']=$emailii;
						$_SESSION['password']=$passii;
						$_SESSION['name']=$name;
						$_SESSION['secName']=$secName;
						$_SESSION['lastName']=$lastName;
						header("Location: Profile.php");
						ob_enf_fluch();
						exit();
				}
				else{
					echo "Не сте попълнили правилно полетата";
				}
			}
			//дали са попълнени полетата->ние рябва да сменим и снимката и данните към профила му
			//сменяме цялата информация за профила
			else if(!empty($_POST['name'])&&!empty($_POST['secName'])&&!empty($_POST['lastName'])&&!empty($_POST['password'])&&!empty($_POST['email'])){
				$sql="UPDATE `users` SET `e-mail`='$email',`pass`='$password',`name`='$name',`secName`='$secName',`lastName`='$lastName' WHERE id=$dbID";
				$result = $conn->query($sql);
				$_SESSION['email']=$emailii;
				$_SESSION['password']=$passii;
				$_SESSION['name']=$name;
				$_SESSION['secName']=$secName;
				$_SESSION['lastName']=$lastName;
				$type = mime_content_type($image);
				//проверка типа на файл
				if ($type == 'image/png' || $type == 'image/jpeg'){
					move_uploaded_file($image,'pic/PROF/'.$_FILES['photo']['name']);
					$Fname=basename('pic/PROF/'.$_FILES['photo']['name']);
					$sql="UPDATE `users` SET`pic`='$Fname' WHERE id=$dbID";
					$conn->query($sql);
					$_SESSION['image']=$Fname;
					header("Location: Profile.php");
					ob_enf_fluch();
					exit();
				}
				else{
					echo "<h1 color='red'>Избрали сте грешен тип файл!!!</h1>";
					exit();
				}
			}
			// трябва да сменим само снимката на профила
			else{
				$type = mime_content_type($image);
				//проверка типа на файл
				if ($type == 'image/png' || $type == 'image/jpeg'){
					move_uploaded_file($image,'pic/PROF/'.$_FILES['photo']['name']);
					$Fname=basename('pic/PROF/'.$_FILES['photo']['name']);
					//ако не е същата търкаме старата
					$sql="UPDATE `users` SET`pic`='$Fname' WHERE id=$dbID";
					$conn->query($sql);
					$_SESSION['image']=$Fname;
					header("Location: Profile.php");
					ob_enf_fluch();
					exit();
				}
				else {
					echo "<h1>Избрали сте грешен тип файл!!!</h1>";
					exit();
				}
			}
		}
	}
?>