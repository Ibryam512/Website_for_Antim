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
					echo "<div class='nav-wrapper'><il id='options'>
					<a class='dropdown-trigger' href='Profile.php' data-target='dropdown1'>
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
						<img style='border-radius: 5000px;' src='pic/profilePic.png'height='44' width='44'></button></a></il></div>";
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
				<li id="options"><a href="index.php">Сергия</a></li>
				<li id="image"><img src="pic/LOGO.png" height="45" width="90"></li>
			</ul>
		</div>
			<?php
			    function DisCard($id,$image,$title,$price,$desc){
			        echo"<td width='50%' id='card-table'>
			        <center>
			                <div class='post card' style='max-width:600;'>
									<div class='card-image waves-effect waves-block waves-light'>
										<a href='detail.php?item=$id' title='Пълен размер'><img style='max-height:600' src='data:image/jpeg;base64,".base64_encode($image)."' class='img-thumnail' /></a>
									</div>
									<div class='card-content'style='background-color: white;text-align:left;'>
										<span class='card-title activator grey-text text-darken-4'>$title<i class='material-icons right'>$price лв.</i></span>
										<p><b>За продажба</b></p>
										<a href='edit_i.php?id=$id'><button class='btn waves-effect waves-light blue' type='submit' name='edit'>Редактирай</button></a>
										<a href='delete_item.php?id=$id'><button class='btn waves-effect waves-light red' type='submit' name='delete'>Изтрий</button></a>
									</div>
									<div class='card-reveal'>
										<span class='card-title grey-text text-darken-4'>$title<i class='material-icons right'>затвори</i></span>
										<p>$desc</p>
									</div>
							</div>		
						</center>
						</td>";
			    }
			    function DisCardLost($id,$image,$title,$desc){
			        echo"<td width='50%' id='card-table'>
			        <center>
			                <div class='post card' style='max-width:600;'>
									<div class='card-image waves-effect waves-block waves-light'>
										<a href='detail_lt.php?item=$id' title='Пълен размер'><img style='max-height:600' src='data:image/jpeg;base64,".base64_encode($image)."' class='img-thumnail' /></a>
									</div>
									<div class='card-content'style='background-color: white;text-align:left;'>
										<span class='card-title activator grey-text text-darken-4'>$title<i class='material-icons right'>...</i></span>
										<p><b>Изгубена вещ</b></p>
										<a href='edit_l.php?id=$id'><button class='btn waves-effect waves-light blue' type='submit' name='edit'>Редактирай</button></a>
										<a href='delete_lthing.php?id=$id'><button class='btn waves-effect waves-light red' type='submit' name='delete'>Изтрий</button></a>
									</div>
									<div class='card-reveal'>
										<span class='card-title grey-text text-darken-4'>$title<i class='material-icons right'>затвори</i></span>
										<p>$desc</p>
									</div>
							</div>
						</center>
						</td>";
			    }
				//включваме файлът за връзка с базата данни
			//	include 'connect.php';
								
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
					echo"<table height='100%' style='border-collapse: unset;'>";
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
						if($smth % 2 == 0)
						{
							echo"<tr>";
							echo DisCardLost($id,$image,$title,$desc);
							$smth++;		
						}
						else
						{
						    echo DisCardLost($id,$image,$title,$desc);
							echo"</tr>";
							$smth++;
						}
					}
					if($ho == 0){
					    echo"<p style='text-align: center;'>Нямате обяви</p>";
					}
				}
				Show();
			?>
		</table>
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