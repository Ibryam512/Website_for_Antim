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
		<title>Добавяне на обява</title>
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
		<div class="card-panel grey lighten-3" style="margin-left: 30%; margin-top: 40%; transform: translate(-20%);">
			<div class="row">
				<form class="col s12" id="form" action="" method="post" enctype='multipart/form-data'>
				<div class="row">
					<div class="input-field col s12">
						<input style="font-size: 27px;" placeholder="До 100 символа" id="title" type="text" class="validate" name="title"id="title">
						<label style="font-size: 27px;" for="title">Заглавие</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input style="font-size: 27px; "placeholder="До 400 символа" id="details" type="text" class="validate" name="desc">
						<label style="font-size: 27px;" for="details">Описание</label>
					</div>
				</div>
				<div class="row"></div>
				<div class="row">
					<div class="input-field col s3">
						<input id="price" type="number" step="0.01" class="validate" name="price" style="font-size: 27px;">
						<label for="price" style="font-size: 27px;">Цена (лева)</label>
					</div>
				</div>
				
				<div class="row">
					<div class="file-field input-field col s12">
						<div class="btn">
							<span style="font-size: 27px;">Избери снимкa</span>
							<input type="file" name="item_photo" id="photoBtn" style="font-size: 24px;">
						</div>
						<div class="file-path-wrapper" style=>
							<input class="file-path validate" type="text" placeholder="Снимка" style="font-size: 27px;">
						</div>
					</div>
				</div>
				<div class="row">
					<p>
						<label>
							<input style="font-size: 27px;" class="with-gap" name="group3" type="radio" value="Обява"/>
							<span style="font-size: 27px;">Обява</span>
						</label>
					</p>
					<p>
						<label>
							<input style="font-size: 27px;" class="with-gap" name="group3" type="radio" value="Загубена вещ"/>
							<span style="font-size: 27px;">Загубена вещ</span>
						</label>
					</p>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input style="font-size: 27px;" id="end_date" type="text" class="datepicker" name="date">
						<label style="font-size: 27px;" for="end_date">До кога обявата да е активна?</label>
					</div>
				</div>
				 <button class="btn waves-effect waves-light" type="submit" name="action" id="action" style="font-size: 24px;">Качи</button>
        
				</form>
			</div>
		</div>
	</body>
</html>
<script>
$(document).ready(function(){  
      $('#action').click(function(){  
           var option = $('input[name=group3]:checked', '#form').val();
		   var price = $('#price').val();
		   var title = $('#title').val();
		   var desc = $('#details').val();
		   var image_name = $('#photoBtn').val();
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
		   if(image_name == '')  
           {  
                alert("Моля, изберете снимка");  
                return false;  
           }
		   if(option == "Обява")
           {
				if(price == '')
				{
					alert("Моля, сложете някаква цена");
					return false;
				}
		   }
		   else if(option == "Загубена вещ")
		   {
				if(price != '')
				{
					alert("Моля, махнете цената, все пак това е изгубена вещ, не предмет за продажба.");
					return false;
				}
		   }
		   else
		   {
				alert("Моля, изберете опция");
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
<?php
	include 'connect.php';

	function Add($title, $desc, $price, $type, $date)
	{
		$conn = OpenCon();
		if(isset($_SESSION['ID'])){
		$id = $_SESSION['ID'];
		}
		else{
		header("Location: login.php");
		ob_enf_fluch();
		return;
		}
		$image = $_FILES["item_photo"]["tmp_name"];
		$file = mime_content_type($image);
		//проверяваме типа на фаила, който ни е подаден
		if ($file == 'image/png' || $file == 'image/jpeg'){
			$imgContent = addslashes(file_get_contents($image));
			$sql = "INSERT INTO images (image) VALUES ('$imgContent')";
			$conn->query($sql);
			$last_id = $conn->insert_id;
			$title = mysqli_real_escape_string($conn,$title);
			$desc = mysqli_real_escape_string($conn,$desc);
			$date=mysqli_real_escape_string($conn,$date);
			if($type == "Обява")
			{
				$sql = "INSERT INTO items
						(title, description, price, date, imageID, userID)
						VALUES ('$title', '$desc', $price, '$date', $last_id, '$id')";
						$conn->query($sql);
						CloseCon($conn);
						header("Location: index.php");
						ob_enf_fluch();
			}
			else
			{
				$sql = "INSERT INTO lthings
						(title, description, date, imageID, userID)
						VALUES ('$title', '$desc', '$date', $last_id, '$id')";
						$conn->query($sql);
						CloseCon($conn);
						header("Location: lost_things.php");
						ob_enf_fluch();
			}
		}
	}
	if(isset($_POST['action'])){
	    $F="<";
    	$E=">";
	    $title = $_POST['title'];
    	$T=strpos($title,$F);
    	$T2=strpos($title,$E);
    	$desc = $_POST['desc'];
    	$D=strpos($desc,$F);
    	$D2=strpos($desc,$F);
    	if($T !== false && $T2 !== false || $D !== false && $D2 !== false){
    	   header("Location: index.php");
	       exit();
    	}
		Add($_POST['title'], $_POST['desc'], $_POST['price'], $_POST['group3'], $_POST['date']);
	}
	
?>
