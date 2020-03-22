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
			include 'connect.php';
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

</script>

