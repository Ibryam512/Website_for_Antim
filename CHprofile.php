<html>
    <head>
		<meta charset="utf-8">
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
		<title>Антималник</title>
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
				<il id="options"><a href="Profile.php"><button style="border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;"><img style="border-radius: 5000px;" src="pic/profilePic.png"height="44" width="44"></button></a></il> 
				<li id="options"><a href="team.html">За нас</a></li>
				<li id="options"><a href="questions.html">Въпроси</a></li>
				<li id="options"><a href="messages.php">Съобщения</a></li>
				<li id="options"><a href="lost_things.php">Изгубени вещи</a></li>
				<li id="options"><a href="index.php">Сергия</a></li>
				<li id="image"><img src="pic/image.png" height="45" width="45"></li>
			</ul>
		</div>
	<form action="" method="POST" enctype="multipart/form-data">
        <div style="text-align: center;">
			<?php
            session_start();
            if(!empty($_SESSION['image'])){
                $i=$_SESSION['image'];
                echo"<img style='border-radius: 5000px;' src='$i' height='400'width='400'>";
            }
            else{
                echo"<img style='border-radius: 5000px;' src='pic/profilePic.png' height='400'width='400'>";
            }
        	?>
			<div>
				<input id="photo" name="photo" type="file">
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
			  <input placeholder="Първо име" name="name" id="name" type="text" class="validate">
			</div>
			<div class="input-field col s12"> 
			  <input placeholder="Второ име" name="secName" id="secName" type="text" class="validate">
			</div>
			<div  class="input-field col s12">
			  <input placeholder="Фамилия" name="lastName" id="lastName" type="text" class="validate">
			</div>
			<div class="input-field col s12">
			  <input placeholder="Парола" name="password" id="password" type="password" class="validate">
			</div>
			<div class="input-field col s12">
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
			$dbID;
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
			}
			else{
				//дали са попълнени полетата->ние рябва да сменим и снимката и данните към профила му
				if(!empty($_POST['name'])&&!empty($_POST['secName'])&&!empty($_POST['lastName'])&&!empty($_POST['password'])&&!empty($_POST['email'])){
					echo"в това за всички сме";
				}
				// трябва да сменим само снимката на профила
				else{
					// Read image path, convert to base64 encoding
					$imageData = base64_encode(file_get_contents($image));

					// Format the image SRC:  data:{mime};base64,{data};
					$img = 'data: '.mime_content_type($image).';base64,'.$imageData;
					
					$sql="UPDATE 'users' SET 'pic'='$imageData' WHERE id=$dbID";
					$result=$conn->query($sql);
					
					$_SESSION['image']=$img;

					header("Location: Profile.php");
					exit();
				}
			}	
		}
		
	?>
	