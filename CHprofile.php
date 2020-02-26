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
			<div id="menu">
			<ul>
			<ul id="dropdown1" class="dropdown-content">
					<li><a href="Profile.php">Профил</a></li>
					<li class="divider"></li>
					<li><a href="#!">Мои обяви</a></li>
				</ul>
			<?php
            	session_start();
            	if(!empty($_SESSION['image'])){
                	$i=$_SESSION['image'];
                	$l="pic/PROF/".$i;
                	echo "<div class='nav-wrapper'><il id='options'><a class='dropdown-trigger' href='#!' data-target='dropdown1'><button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'><img style='border-radius: 5000px;' src='$l'height='44' width='44'></button></a></il></div>";
            	}
            	else{
                	echo "<div class='nav-wrapper'><il id='options'><a class='dropdown-trigger' href='#!' data-target='dropdown1'><button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'><img style='border-radius: 5000px;' src='pic/profilePic.png'height='44' width='44'></button></a></il></div>";
            	}
        		?> 
				<li id="options"><a href="team.html">За нас</a></li>
				<li id="options"><a href="questions.html">Въпроси</a></li>
				<li id="options"><a href="messages.php">Съобщения</a></li>
				<li id="options"><a href="lost_things.php">Изгубени вещи</a></li>
				<li id="options"><a href="index.php">Сергия</a></li>
				<li id="image"><img src="pic/LOGO.png" height="45" width="90"></li>
			</ul>
		</div>
	<form action="" method="POST" enctype="multipart/form-data">
		<div style="text-align: center;">
			<div>
			<?php
            if(!empty($_SESSION['image'])){
                $i=$_SESSION['image'];
                $l="pic/PROF/".$i;
                echo"<img style='border-radius: 5000px;' src='$l' height='400'width='400'>";
            }
            else{
                echo"<img style='border-radius: 5000px;' src='pic/profilePic.png' height='400'width='400'>";
            }
			?>
			</div>
			<input type="file" name="photo" id="photo">
			<div class="row">
			<div class="input-field col s12" style="background-color: white;">
			  <input placeholder="Първо име" name="name" id="name" type="text" class="validate">
			</div>
			<div class="input-field col s12" style="background-color: white;"> 
			  <input placeholder="Второ име" name="secName" id="secName" type="text" class="validate">
			</div>
			<div  class="input-field col s12" style="background-color: white;">
			  <input placeholder="Фамилия" name="lastName" id="lastName" type="text" class="validate">
			</div>
			<div class="input-field col s12" style="background-color: white;">
			  <input placeholder="Парола" name="password" id="password" type="password" class="validate">
			</div>
			<div class="input-field col s12" style="background-color: white;">
			  <input placeholder="Имейл" name="email" id="email" type="email" class="validate">
			</div>
		  	<div class="input-field col s12" style="text-align: center;margin-top: 10;">	
			<button style="text-align: center;" class="btn waves-effect waves-light" type="submit" name="save" id="save">Запази</button>
		  	</div>
		</div>
	</form>
	</html>
	<?php
	//свъзваме се с базата данни
	include 'profileCon.php';
	$conn=OpenCon();
	
		//ако са кликнали бутона за запазване
		if(isset($_POST['save'])){

			$email=hash('sha256',$_SESSION['email']."Ibrqm,Venci");
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
          		if($dbEmail === $email  &&  $dbPassword === $password){
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
							exit();
					}
					else{
						echo"???????";
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
						exit();
					}
					else{
						echo"<h1>Избрали сте грешен тип файл!!!</h1>";
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
						$sql="UPDATE `users` SET`pic`='$Fname' WHERE id=$dbID";
						$conn->query($sql);
						$_SESSION['image']=$Fname;
						header("Location: Profile.php");
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
	