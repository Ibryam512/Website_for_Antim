<?php
session_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
		<title>Сергия</title>
		<link rel="icon" href="pic/LOGO.png">
		<link rel="stylesheet" href="css\style.css">
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<!--долното е за иконката в горния ляв ъгъл -->
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
				      echo "<a href='messages.php' class='notification'>Съобщения<span class='badge'>$messages</span></a>";
				    }
				    else
				    {
				        echo "<a href='messages.php'>Съобщения</a>";
				    }
				}
				else
				{
				    echo "<a href='messages.php'>Съобщения</a>";
				}?>
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
		
		<div id="search">
			<form  method="post" action="index.php"> 
				<div class="input-field col s12 " style="background-color: white;height:auto;width:auto;">
                  <input style="text-align: center;font-size:50px;height:5%" placeholder="Търси" name="search" id="search" type="text" class="validate">
                </div>
				<button style="text-align: center;height:4%;width:17%;font-size:30px" class="btn waves-effect waves-light" type="submit" name="submit">Търси</button>
			</form> 
		</div>
		<table width="100%" height="100%">
			<?php
				//включваме файлът за връзка с базата данни
				//include 'connect.php';
				//функция за търсене на постове
				function Search()
				{
					//отваряме връзка
					$conn = OpenCon();
					//прожеряваме дали трябва да покажем всичко или само част от обявите
					if(isset($_POST["search"])){
					    //само някой ще се покажат
					    $search = strtolower($_POST["search"]);
					    $F="'%";
					    $E="%'";
					    $pos=strpos($search,$F);
					    $pos2=strpos($search,$E);
					    if($pos !== false || $pos2 !== false)
					    {
					        echo"Няма намерени резултати";
					        return;
					    }
					}
					else{
					    //всички ще се покажат
					    $search = "";
					}
					//изпълняваме заявка
					$sql = "SELECT * FROM items
							LEFT JOIN images
							ON items.imageID = images.ID
							WHERE LOWER(title) LIKE '%$search%'";
					$result = $conn->query($sql);
					$smth = 0;
    					//извеждаме нужната информация
    					while($row = $result->fetch_assoc())
    					{
    						$title = $row["title"];
    						$desc = $row["description"];
    						$image = $row["image"];
    						$price=$row['price'];
    						$id = $row["IID"];
    						//if($smth % 2 == 0)
    						//{
    							echo"<tr>
    									<td width='50%'><div id='post' class='card' style='max-width:700;' >
    									<div class='card-image waves-effect waves-block waves-light'>
    										<a href='detail.php?item=$id' title='Пълен размер'><img style='max-height:800;' src='data:image/jpeg;base64,".base64_encode($image)."' class='img-thumnail' /></a>
    									</div>
    									<div class='card-content'style='background-color: white;'>
    										<span class='card-title activator grey-text text-darken-4' style='font-size: 27px;'>$title<i class='material-icons right'>$price лв.</i></span>
    									</div>
    									<div class='card-reveal'>
    										<span class='card-title grey-text text-darken-4' style='font-size: 27px;'>$title<i class='material-icons right'>затвори</i></span>
    										<p>$desc</p>
    									</div></td></tr>";
    							$smth++;		
    						//}
    						//else
    						//{
    							//echo"<td width='50%'><div id='post' class='card' style='max-width:700;'>
    									//<div class='card-image waves-effect waves-block waves-light'>
    										//<a href='detail.php?item=$id' title='Пълен размер'><img style='max-height:500' src='data:image/jpeg;base64,".base64_encode($image)."' class='img-thumnail' /></a>
    									//</div>
    									//<div class='card-content'style='background-color: white;'>
    										//<span class='card-title activator grey-text text-darken-4'>$title<i class='material-icons right'>$price лв.</i></span>
    									//</div>
    									//<div class='card-reveal'>
    										//<span class='card-title grey-text text-darken-4'>$title<i class='material-icons right'>затвори</i></span>
    										//<p>$desc</p>
    									//</div></td></tr>";
    							//$smth++;
    						//}
    					}
					//if($smth == 1){
					   // echo"<td width='50%'></td>";
					//}
					if($smth==0)
					{
					   echo"Няма намерени резултати";
					   return;
				    }
				}
				Search();
			?>
		</table>
	</body>
</html>