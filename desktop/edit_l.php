<?php
session_start();
ob_start();
if(isset($_SESSION['ID'])){
		$id = $_SESSION['ID'];
		}
		else{
		header("Location: login.php");
		ob_enf_fluch();
		return;
		}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
		<title>Редактиране на обява</title>
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
                	echo "<div class='nav-wrapper'><il id='options'><a class='dropdown-trigger' href='Profile.php' data-target='dropdown1'><button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'><img style='border-radius: 5000px;' src='$l'height='44' width='44'></button></a></il></div>";
            	}
            	else{
            	    if(empty($_SESSION['ID'])){
            	        echo "<li id='options' ><a class='waves-effect waves-light btn' href='register.php' style='width:220;margin-top:6;margin-left:6'><i class='material-icons'>Регистрирай се</i></a></li>";
            	        
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
				<li id="options"><a href="index.php">Сергия</a></li>
				<li id="options" title="Добави"><a class="btn-floating btn-medium waves-effect waves-light blue pulse" href="add.php" style="margin-top: 10%;"><i class="material-icons">+</i></a></li>
				<li id="image"><img src="pic/lost.png" height="45" width="45"></li>
			</ul>
		</div>
		<!--Forms to slide-->
		<div class="form-popup" id="myForm">
			<form action="php/login.php" class="form-container">

				<button type="button" style="background-color: white; border: white;margin-left: 93%;" onclick="closeForm()"><img src="pic/close.png" width="20"></button>

				<center>
				<h4 style="color: black;">Вход</h4>
				</center>

				<label for="email"><b>Имейл</b></label>
				<input type="text" placeholder="Въведете имейл" name="email" required>

				<label for="psw"><b>Парола</b></label>
				<input type="password" placeholder="Въведете парола" name="psw" required>

				<button type="submit" class="btn">Вход</button>
			</form>
		</div>
		<div class="form-popup" id="myFormR">
			<form action="php/register.php" class="form-containerR">

				<button type="button" style="background-color: white; border: white;margin-left: 93%;" onclick="closeFormR()"><img src="pic/close.png" width="20"></button>

				<center>
				<h4 style="color: black;">Регистрирай се</h4>
				</center>

				<label for="email"><b>Имейл</b></label>
				<input type="text" placeholder="Въведете имейл" name="email" required>

				<label for="psw"><b>Парола</b></label>
				<input type="password" placeholder="Въведете парола" name="psw" required>
				
				<label for="psw"><b>Повтори паролата</b></label>
				<input type="password" placeholder="Повтори паролата" name="psw" required>
				
				<label for="email"><b>Име и фамилия</b></label>
				<input type="text" placeholder="Име и фамилия" name="email" required>

				<button type="submit" class="btn">Регистрирай се</button>
			</form>
		</div>
		<?php
		//	include 'connect.php';
			$conn = OpenCon();
			$id = $_GET["id"];
			$sql = "SELECT * FROM lthings WHERE IID=$id";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			$title = $row['title'];
			$desc = $row['description'];
			$date = $row['date'];
			CloseCon($conn);
		
		 echo "<div class='card-panel grey lighten-3' style='margin-left: 30%; transform: translate(-20%);'>
			<div class='row'>
				<form class='col s12' id='form' action='edit_lthings.php?id=$id' method='post' enctype='multipart/form-data'>
				<div class='row'>
					<div class='input-field col s12'>
						<input placeholder='До 100 символа' id='title' type='text' class='validate' name='title'id='title' value='$title'>
						<label for='title'>Заглавие</label>
					</div>
				</div>
				<div class='row'>
					<div class='input-field col s12'>
						<input placeholder='До 400 символа' id='details' type='text' class='validate' name='desc' value='$desc'>
						<label for='details'>Описание</label>
					</div>
				</div>
				<div class='row'>
					<div class='input-field col s12'>
						<input id='end_date' type='text' class='datepicker' name='date' value='$date'>
						<label for='end_date'>До кога обявата да е активна?</label>
					</div>
				</div>
				 <button class='btn waves-effect waves-light' type='submit' name='action' id='action'>Редактирай</button>
        
				</form>
			</div>
		</div>"
		?>
	</body>
</html>
<script>
$(document).ready(function(){  
      $('#action').click(function(){  
		   var price = $('#price').val();
		   var title = $('#title').val();
		   var desc = $('#details').val();
		   var date = $('#end_date').val();
		   
		   if(title == '')
		   {
				alert("Моля, сложете заглавие");
				return false;
				
		   }
		   else if(title.length > 100){
		       alert("Моля, изберете по-кратко заглавие");
				return false;
		   }
		   if(desc == '')
		   {
				alert("Моля, сложете описание");
				return false;
		   }
		   else if(desc.length > 400){
		       alert("Моля, напишете по=кратко описание");
				return false;
		   }
		   if(date == '')
		   {
				alert("Моля, изберете крайна дата");
				return false;
		   }
		   
      });  

	
 });  


 

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

