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
				<il id="options"><a href="Profile.html"><button style="border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;"><img style="border-radius: 5000px;" src="pic/profilePic.png"height="44" width="44"></button></a></il> 
				<li id="options"><a href="team.html">За нас</a></li>
				<li id="options"><a href="questions.html">Въпроси</a></li>
				<li id="options"><a href="lost_things.php">Изгубени вещи</a></li>
				<li id="options"><a style="background-color: white;" href="index.php">Сергия</a></li>
				<li id="options"><a class="btn-floating btn-medium waves-effect waves-light blue pulse" href="add.html" style="margin-top: 10%;"><i class="material-icons">+</i></a></li>
				<li id="image"><img src="pic/image.png" height="45" width="45"></li>
			</ul>
		</div>
		<table style="width:100%">
			<?php
				include 'connect.php';
				
				function Show()
				{
					$conn = OpenCon();
					$sql = "SELECT * FROM items
							LEFT JOIN images
							ON items.imageID = images.ID
							ORDER BY items.ID DESC;";
							
					$result = $conn->query($sql);
					$smth = 0;
					while($row = $result->fetch_assoc())
					{
						$title = $row["title"];
						$desc = $row["description"];
						$image = $row["image"];
						$id = $row["ID"];

						if($smth % 2 == 0)
						{
							echo"<tr>
									<td><div id='post' class='card'>
									<div class='card-image waves-effect waves-block waves-light'>
										<img style='object-fit: contain;' src='data:image/jpeg;base64,'.base64_encode($image).' height='100'>
									</div>
									<div class='card-content'>
										<span class='card-title activator grey-text text-darken-4'>$title<i class='material-icons right'>...</i></span>
										<p><a href='detail.php?item=$id'>Пълен размер</a></p>
									</div>
									<div class='card-reveal'>
										<span class='card-title grey-text text-darken-4'>$title<i class='material-icons right'>затвори</i></span>
										<p>$desc</p>
									</div></td>";
							$smth++;		
						}
						else
						{
							echo"	<td><div id='post' class='card'>
									<div class='card-image waves-effect waves-block waves-light'>
										<img style='object-fit: contain;' src='$image' height='100'>
									</div>
									<div class='card-content'>
										<span class='card-title activator grey-text text-darken-4'>$title<i class='material-icons right'>...</i></span>
										<p><a href='detail.php?item=$id'>Пълен размер</a></p>
									</div>
									<div class='card-reveal'>
										<span class='card-title grey-text text-darken-4'>$title<i class='material-icons right'>затвори</i></span>
										<p>$desc</p>
									</div></td></tr>";
							$smth++;
						}
					}
				}
				Show();
			?>
		</table>
	</body>
</html>