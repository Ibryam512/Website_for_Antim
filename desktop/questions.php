<?php
session_start();
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
	<body style="overflow:hidden">
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
						<a class='waves-effect waves-light btn' onclick='openFormR()' style='width:220;margin-top:6;margin-left:6'>
						<i class='material-icons'>Регистрирай се</i></a></li>";
            	        
						echo "<li id='options'>
						<a class='waves-effect waves-light btn' onclick='openForm()' style='margin-top:6;width:100;'>
						<i class='material-icons'>Вход</i></a></li>";
            	    }
            	    else if(!empty($_SESSION['ID'])){
						echo "<div class='nav-wrapper'>
						<il id='options'><a class='dropdown-trigger' href='Profile.php' data-target='dropdown1'>
						<button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'>
						<img style='border-radius: 5000px;' src='pic/profilePic.png'height='44' width='44'>
						</button></a></il></div>";
            	    }
            	}
			?>
				<li id="options"><a href="team.php">За нас</a></li>
				<li id="options"><a style="background-color: white;" href="questions.php">Въпроси</a></li>
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
		<table  style="width:100%;border-collapse: unset;margin-left:1.5%;margin-top:7%"> 
		
			<div style="text-align: right; margin-top: 20px;margin-right: 20px;">
				<a href="ASKus.php"><button style="background-color: steelblue;" type="submit" id="logout" name="logout" class='waves-effect waves-light btn-large' >Попитай ни</button></a>
			</div>
			<tr>
				<td style="width:33%"><div class="post card">
					<div class="card-image waves-effect waves-block waves-light">
						<img style="object-fit:contain;"  src="pic/vupros.png" height="100">
					</div>
					<div class="card-content">
						<span style="text-align: center;" class="card-title activator grey-text text-darken-4">Какво е "Сергия"?</span>
					</div>
					<div class="card-reveal">
						<span style="text-align: center;" class="card-title grey-text text-darken-4">
							"Сергия" представлява място, на което всеки един от нашите потребители може да публикува собствена обява, за да може например да продаде старата си униформа или учебник.
						</span>
					</div></td>
				<td style="width:33.3333333333%"><div class="post card">
					<div class="card-image waves-effect waves-block waves-light">
						<img style="object-fit:contain;"  src="pic/vupros.png" height="100">
					</div>
					<div class="card-content">
						<span style="text-align: center;" class="card-title activator grey-text text-darken-4">Какво е "Изгубени вещи"?</span>
					</div>
					<div class="card-reveal">
						<span style="text-align: center;" class="card-title grey-text text-darken-4">
							"Изгубени вещи" е място, където всеки един човек може да публикува обява за намерена вещ.
						</span>
					</div></td>
				<td style="width:33%"><div class="post card">
					<div class="card-image waves-effect waves-block waves-light">
						<img style="object-fit:contain;"  src="pic/vupros.png" height="100">
					</div>
					<div class="card-content">
						<span style="text-align: center;" class="card-title activator grey-text text-darken-4">Защо да използваме сайта?</span>
					</div>
					<div class="card-reveal">
						<span style="text-align: center;" class="card-title grey-text text-darken-4">Тук може да продадете на по-малките от вас ученици вашите учебници, които вече не използвате.Също така да продадете униформата, която вече не носите, понеже ви е станала малка.</span>
					</div></td>
			</tr>
			<tr>
				<td style="width:33%"><div class="post card">
					<div class="card-image waves-effect waves-block waves-light">
						<img style="object-fit:contain;"  src="pic/vupros.png" height="100">
					</div>
					<div class="card-content">
						<span style="text-align: center;" class="card-title activator grey-text text-darken-4">Как да сменя данните към профила си?</span>
					</div>
					<div class="card-reveal">
						<span style="text-align: center;" class="card-title grey-text text-darken-4">Цъкнете върху профилната си снимка. Тя ще ви препрати към вашия профил, след това трябва да цъкнете върху бутона с молива и ще ви бъде позволено да смените данните.</span>
					</div></td>
				<td style="width:33%"><div class="post card centered">
						<div class="card-image waves-effect waves-block waves-light">
							<img style="object-fit:contain;"  src="pic/vupros.png" height="100">
						</div>
						<div class="card-content">
							<span style="text-align: center;" class="card-title activator grey-text text-darken-4">За кого е предназначен сайтът?</span>
						</div>
						<div class="card-reveal">
							<span style="text-align: center;" class="card-title grey-text text-darken-4">Сайтът е предназначен за ученици, които искат да използват някоя от услугите("Сергия" или "Изгубени вещи").
								Той също така може да служи за нови запознанства и приятелства в училище.
							</span>
						</div></td>
				<td style="width:33%"><div class="post card">
					<div class="card-image waves-effect waves-block waves-light">
						<img style="object-fit:contain;"  src="pic/vupros.png" height="100">
					</div>
					<div class="card-content">
						<span style="text-align: center;" class="card-title activator grey-text text-darken-4">Как да задам мой въпрос?</span>
						
					</div>
					<div class="card-reveal">
						<span style="text-align: center;" class="card-title grey-text text-darken-4">Горе в дясно има бутон, на който пише "Попитай ни". Той ще ви препрати към страница, чрез която ще можете да ни изпратите имейл.</span>
						
					</div></td>
			</tr>
		</table>
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
	</body>
</html>
