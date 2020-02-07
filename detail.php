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
				<li id="options"><a href="index.php">Сергия</a></li>
				<li id="options"><a class="btn-floating btn-medium waves-effect waves-light blue pulse" href="add.html" style="margin-top: 10%;"><i class="material-icons">+</i></a></li>
				<li id="image"><img src="pic/image.png" height="45" width="45"></li>
			</ul>
		</div>
		<?php
			include 'connect.php';
			$conn = OpenCon();
			$item = $_GET["item"];
			$sql = "SELECT * FROM items
			LEFT JOIN images
			ON items.imageID = images.ID
			ORDER BY items.ID DESC;";
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc())
			{
				$title = $row["title"];
				$desc = $row["description"];
				$price = $row["price"];
				$image = $row["image"];
				$id = $row["ID"];
				if($item == $id)
				{
					echo "<div class='card-panel grey lighten-3' style='margin-left: 17%; transform: translate(-10%);'>
							<h3 style='text-align: center;'>$title</h3>
							<img src='$image' width='1050' height='500'>
						</div>
						<div class='card-panel grey lighten-3' style='margin-left: 17%; transform: translate(-10%);'>
							<h4 style='text-align: center;'>Описание</h4>
							<p>$desc</p>
						</div>
						<div class='card-panel grey lighten-3' style='margin-left: 17%; transform: translate(-10%);'>
							<h4 style='text-align: center;'>Цена</h4>
							<p>Цена: $price лева</p>
						</div>
						<div class='card-panel grey lighten-3' style='margin-left: 17%; transform: translate(-10%);'>
							<h4 style='text-align: center;'>Потребител</h4>
							<p>Име презиме фамилия</p>
							<p>Клас</p>
						</div>";
						break;
				}
			}
			
		?>
	</body>
</html>