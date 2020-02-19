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
			//връзка с базата данни
			include 'connect.php';
			//отватяме връзка
			$conn = OpenCon();
			$item = $_GET["item"];
			//изпълнение на заявка
			$sql = "SELECT * FROM items
			LEFT JOIN images
			ON items.imageID = images.ID
			LEFT JOIN users
			ON items.userID = users.name
			ORDER BY items.ID DESC;";
			$result = $conn->query($sql);
			//извеждане на нужната информация
			while($row = $result->fetch_assoc())
			{
				$title = $row["title"];
				$desc = $row["description"];
				$price = $row["price"];
				$image = $row["image"];
				$date = $row["date"];
				$id = $row["IID"];
				$name = $row["name"];
				$secName = $row["secName"];
				$lastName = $row["lastName"];
				$userID = $row["userID"];
				if($item == $id)
				{
					echo "<div class='card-panel grey lighten-3' style='margin-left: 17%; transform: translate(-10%);'>
							<h3 style='text-align: center;'>$title</h3>
							<img src='data:image/jpeg;base64,".base64_encode($image)."' height='500' width='980' class='img-thumnail' />
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
							<p>$name $secName $lastName</p>
							<a href='Chat.php?userID=$userID'>Пиши на потребител</a>
							<p>Клас</p>
						</div>
						<div class='card-panel grey lighten-3' style='margin-left: 17%; transform: translate(-10%);'>
							<h4 style='text-align: center;'>Дата</h4>
							<p>Обявата е валидна до $date</p>
						</div>";
						break;
				}
			}
			
		?>
	</body>
</html>