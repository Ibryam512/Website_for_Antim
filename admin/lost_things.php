<?php
	session_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
		<title>Изгубени вещи</title>
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
				<?php
					if(!empty($_SESSION['image'])){
						$i=$_SESSION['image'];
						$l="pic/PROF/".$i;
						echo "<div class='nav-wrapper'><il id='options'>
						<a class='dropdown-trigger' href='Profile.php' data-target='dropdown1' onclick='openProfile()'>
						<button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'>
						<img style='border-radius: 5000px;' src='$l'height='44' width='44'>
						</button></a></il></div>";
					}
					else{
						if(empty($_SESSION['ID'])){
							echo "<li id='options'>
							<a class='waves-effect waves-light btn' onclick='openForm()' style='margin-top:6;width:100;'>
							<i class='material-icons'>Вход</i></a></li>";
						}
						else if(!empty($_SESSION['ID'])){
						echo "<div class='nav-wrapper'>
						<il id='options'>
						<a class='dropdown-trigger' href='Profile.php' data-target='dropdown1'>
						<button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'>
                        <img style='border-radius: 5000px;' src='pic/profilePic.png'height='44' width='44'></button></a></il></div>";
                        
                        if ($_SESSION['ID'] == 6)
                        {
							echo "<li id='options'>
							<a class='waves-effect waves-light btn' onclick='openFormR()' style='width:220;margin-top:6;margin-left:6'>
							<i class='material-icons'>Регистрирай админ</i></a></li>
							<li id='options'><a href='admins.php'>Админи</a></li>";
                        }

						}
					}
				?>
				<li id="options"><a href="users.php">Потребители</a></li>
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
				<li id="options"><a href="lost_things.php" style="background-color: white;">Изгубени вещи</a></li>
				<li id="options"><a href="index.php">Сергия</a></li>
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
				function DisCard($id,$image,$title,$desc,$imageid){
					echo "
					<div class='card-table col s4 m4 l4'>
						<div class='post card z-depth-5 hoverable' style='transform:translate(0%,0%)'>
							<div class='card-image waves-effect waves-block waves-light'>
								<a href='detail_lt.php?item=$id' title='Пълен размер'><img style='max-height:600' src='data:image/jpeg;base64," . base64_encode($image) . "' class='img-thumnail' /></a>
							</div>
							<div class='card-content' style='background-color: white;'>
								<span title='Надникни' class='card-title activator grey-text text-darken-4'>$title</span>
								<a href='detail_lt.php?item=$id#select'><button class='btn waves-effect waves-light red' type='submit' name='delete'>Изтрий</button></a>
							</div>
							<div class='card-reveal'>
								<span class='card-title grey-text text-darken-4'>$title</span>
								<p>$desc</p>
							</div>
						</div>
					</div>";
				}
				//връзка с базата данни
				//include 'connect.php';
				function Search() {
					//отваряне на връзка
					$conn = OpenCon();
					if (isset($_POST["search"])) {
					    //само някой ще се покажат
						$search = strtolower($_POST["search"]);
						$F = "'%";
						$E = "%'";
						$pos = strpos($search,$F);
						$pos2 = strpos($search,$E);
						if($pos !== false || $pos2 !== false) {
							echo"Няма намерени резултати";
							return;
						}
					} else
					    //всички ще се покажат
						$search = "";
					//изпълнение на заявка
					$sql = "SELECT * FROM lthings
							LEFT JOIN images
							ON lthings.imageID = images.ID
							WHERE LOWER(title) LIKE '%$search%'";
					$result = $conn->query($sql);
					$smth = 0;
					//извеждане на нужната информация
					while ($row = $result->fetch_assoc()) {
						$title = $row["title"];
						$desc = $row["description"];
						$imageid = $row["ID"];
						$image = $row["image"];
						$id = $row["IID"];
						if ($smth % 2 == 0) {
							echo"<tr>";
							echo DisCard($id,$image,$title,$desc,$imageid);
							$smth++;		
						} else {
							echo DisCard($id,$image,$title,$desc,$imageid);
							echo"</tr>";
							$smth++;
						}
					}
					if ($smth == 1)
						echo"<td width='50%'></td>";
					else if ($smth==0)
						echo"Няма намерени резултати";
                }
                if(isset($_SESSION["admin"]))
                {
                    Search();
                }
                else
                {
                    echo "Трябва да влезете в административен профил, за да имате достъп до тези функции";
                }
			?>
		</div>
		<!--Forms to slide-->
		<div class="form-popup" id="myForm">
			<form action="login.php" class="form-container">

				<button type="button" style="background-color: white; border: white;margin-left: 93%;" onclick="closeForm()">Х</button>

				<center>
				<h4 style="color: black;">Вход</h4>
				</center>

				<label for="email"><b>Имейл</b></label>
				<input type="email" placeholder="Въведете имейл" name="email" id="email" required>

				<label for="psw"><b>Парола</b></label>
				<input type="password" placeholder="Въведете парола" name="psw" id="password" required>

				<button type="submit" class="btn" id="log">Вход</button>
			</form>
		</div>
	
		<div class="form-popup" id="myFormR">
			<form action="register.php" class="form-containerR">

				<button type="button" style="background-color: white; border: white;margin-left: 93%;" onclick="closeFormR()">Х</button>

				<center>
				<h4 style="color: black;">Регистрирай админ</h4>
				</center>
				
				<label for="name"><b>Име</b></label>
				<input type="text" placeholder="Име" name="name" id="name" required>
				
				<label for="secName"><b>Презиме</b></label>
				<input type="text" placeholder="Презиме" name="secName" id="secName" required>
				
				<label for="lastName"><b>Фамилия</b></label>
				<input type="text" placeholder="Фамилия" name="lastName" id="lastName" required>

				<label for="email"><b>Имейл</b></label>
				<input type="email" placeholder="Въведете имейл" name="email" id="emailr" required>

				<label for="psw"><b>Парола</b></label>
				<input type="password" placeholder="Въведете парола" name="psw" id="passwordr" required>
				
				<label for="psw2"><b>Повтори паролата</b></label>
				<input type="password" placeholder="Повтори паролата" name="psw2" id="password2" required>
				

				<button type="submit" class="btn" id="reg">Регистрирай админ</button>
			</form>
		</div>
		<script>
			let i = 0;
			[...document.querySelectorAll(".post")]
			.forEach(post => setTimeout(() => post.className += " shown", 150 * i++));

			//code to open forms
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
      var pass = $('#passwordr').val();
      var pass2 = $('#password2').val(); 
      var email = $('#emailr').val();
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
	</body>
</html>
