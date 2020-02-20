<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
		<title>Добавяне на обява</title>
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
				<?php
            	session_start();
            	if(!empty($_SESSION['image'])){
                	$i=$_SESSION['image'];
                	$l="pic/PROF/".$i;
                	echo"<il id='options'><a href='Profile.php'><button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'><img style='border-radius: 5000px;' src='$l'height='44' width='44'></button></a></il> ";
            	}
            	else{
                	echo"<img style='border-radius: 5000px;' src='pic/profilePic.png' height='400'width='400'>";
            	}
        		?>
				<li id="options"><a href="team.html">За нас</a></li>
				<li id="options"><a href="questions.html">Въпроси</a></li>
				<li id="options"><a href="messages.php">Съобщения</a></li>
				<li id="options"><a href="lost_things.php">Изгубени вещи</a></li>
				<li id="options"><a href="index.php">Сергия</a></li>
				<li id="image"><img src="pic/image.png" height="45" width="45"></li>
			</ul>
		</div>
		<div class="card-panel grey lighten-3" style="margin-left: 30%; transform: translate(-20%);">
			<div class="row">
				<form class="col s12" id="form" action="add.php" method="post" enctype='multipart/form-data'>
				<div class="row">
					<div class="input-field col s12">
						<input id="title" type="text" class="validate" name="title"id="title">
						<label for="title">Заглавие</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="details" type="text" class="validate" name="desc">
						<label for="details">Описание</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s3">
						<input id="price" type="number" step="0.01" class="validate" name="price">
						<label for="price">Цена (лева)</label>
					</div>
				</div>
				<div class="row">
					<div class="file-field input-field col s12">
						<div class="btn">
							<span>Избери снимкa</span>
							<input type="file" name="item_photo" id="photoBtn">
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text" placeholder="Снимка">
						</div>
					</div>
				</div>
				<div class="row">
					<p>
						<label>
							<input class="with-gap" name="group3" type="radio" value="Обява"/>
							<span>Обява</span>
						</label>
					</p>
					<p>
						<label>
							<input class="with-gap" name="group3" type="radio" value="Загубена вещ"/>
							<span>Загубена вещ</span>
						</label>
					</p>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="end_date" type="text" class="datepicker" name="date">
						<label for="end_date">До кога обявата да е активна?</label>
					</div>
				</div>
				 <button class="btn waves-effect waves-light" type="submit" name="action" id="action">Качи</button>
        
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
		   if(desc == '')
		   {
				alert("Моля, сложете описание");
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
		header("Location: login.html");
		return;
		}
		$image = $_FILES["item_photo"]["tmp_name"];
        $imgContent = addslashes(file_get_contents($image));

		$sql = "INSERT INTO images (image) VALUES ('$imgContent')";
		$conn->query($sql);
		$last_id = $conn->insert_id;
		$title = $title;
		$desc = $desc;
		if($type == "Обява")
		{
			$sql = "INSERT INTO items
					(title, description, price, date, imageID, userID)
					VALUES ('$title', '$desc', $price, '$date', $last_id, '$id')";
		}
		else
		{
			$sql = "INSERT INTO lthings
					(title, description, date, imageID, userID)
					VALUES ('$title', '$desc', '$date', $last_id, '$id')";
		}
		$conn->query($sql);
		CloseCon($conn);
		header("Location: index.php");
	}
	Add($_POST['title'], $_POST['desc'], $_POST['price'], $_POST['group3'], $_POST['date']);
?>
