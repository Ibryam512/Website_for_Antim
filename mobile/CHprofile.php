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
		
	<form action="" method="POST" enctype="multipart/form-data">
		<div style="text-align: center">
		    
			<div>
			<?php
            if(!empty($_SESSION['image'])){
                $i=$_SESSION['image'];
                $l="/desktop/pic/PROF/".$i;
                echo"<img style='border-radius: 5000px;' src='$l' height='400'width='400'>";
            }
            else{
                echo"<img style='border-radius: 5000px;' src='pic/profilePic.png' height='400'width='400'>";
            }
            
            $name = $_SESSION['name'];
            $secName = $_SESSION['secName'];
            $lastName=$_SESSION['lastName'];
            $pass=$_SESSION['password'];
            $email=$_SESSION['email'];
            
            echo'</div>
			<input style="font-size:30px;height:auto;width:auto;margin-left:20%;margin-top:5%" type="file" name="photo" id="photo">
			<div class="row">
			<div class="input-field col s12" style="background-color: white;">
			  <input style="text-align: center;font-size:50px;height:90;background-color: white;" placeholder="Първо име" name="name" id="name" type="text" class="validate" value='.$name.'>
			</div>
			<div class="input-field col s12" style="background-color: white;"> 
			  <input style="text-align: center;font-size:50px;height:90;background-color: white;" placeholder="Второ име" name="secName" id="secName" type="text" class="validate" value='.$secName.'>
			</div>
			<div  class="input-field col s12" style="background-color: white;">
			  <input style="text-align: center;font-size:50px;height:90;background-color: white;;" placeholder="Фамилия" name="lastName" id="lastName" type="text" class="validate" value='.$lastName.'>
			</div>
			<div class="input-field col s12" style="background-color: white;">
			  <input style="text-align: center;font-size:50px;height:90;background-color: white;" placeholder="Парола" name="password" id="password" type="password" class="validate" value='.$pass.'>
			</div>
			<div class="input-field col s12" style="background-color: white;">
			  <input style="text-align: center;font-size:50px;height:90;background-color: white;" placeholder="Имейл" name="email" id="email" type="email" class="validate" value='.$email.'>
			</div>
		  	<div class="input-field col s12" style="text-align: center;">	
			<button style="text-align: center;height:7%;width:50%;font-size:30px" class="btn waves-effect waves-light" type="submit" name="save" id="save">Запази</button>
		  	</div>';
		  	
			?>
		</div>
	</form>
	</html>
	<?php
	//свъзваме се с базата данни
	include 'profileCon.php';
	$conn=OpenCon();
	
		//ако са кликнали бутона за запазване
		if(isset($_POST['save'])){

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
			$email=hash('sha256',$_POST['email']."Ibrqm,Venci");
			$password=hash('sha256',$_POST['password']."Ibrqmov,Nenov");
			//ако сме намерили такъв портебител
			if($dbID != -1){
			
					$emailii=$_POST['email'];
					$passii=$_POST['password'];
					$name=$_POST['name'];
					$secName=$_POST['secName'];
					$lastName=$_POST['lastName'];
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
						echo"Не сте попълнили правилно полетата";
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
						echo"<h1 color='red'>Избрали сте грешен тип файл!!!</h1>";
						exit();
					}
				}
				// трябва да сменим само снимката на профила
				else{
					$type = mime_content_type($image);
					//проверка типа на файл
					if ($type == 'image/png' || $type == 'image/jpeg'){
						move_uploaded_file($image,'pic/PROF/'.$_FILES['photo']['name']);
						$Fname=basename('/desktop/pic/PROF/'.$_FILES['photo']['name']);
						//ако не е същата търкаме старата
						$sql="UPDATE `users` SET`pic`='$Fname' WHERE id=$dbID";
						$conn->query($sql);
						$_SESSION['image']=$Fname;
						header("Location: Profile.php");
						ob_enf_fluch();
						exit();
					}
					else{
						echo"<h1>Избрали сте грешен тип файл!!!</h1>";
						exit();
					}
				}
			}
		}	
	
		
	?>
	