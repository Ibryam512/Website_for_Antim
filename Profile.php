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
				<li id="image"><img src="pic/image.png" height="45" width="45"></li>
			</ul>
        </div>
        <div style="text-align: center;">
            <img style="border-radius: 5000px;" src="Pic/profilePic.png" height="400"width="400">
            <div>
                <button style="border-radius: 5000px;cursor: pointer;background-color: initial;border: initial;" ><img style="border-radius: 5000000px;" src="pic/Edit.png" height="40"></button>
            </div>
        </div>
        <div style="text-align: center;">
            <h5>Име<h5>
            <?php 
            session_start();
            $name = $_SESSION['name'];
            echo "<h4>$name<h4>";
            ?>
        </div>
        <div style="text-align: center;">
            <h5>Презиме<h5l>
            <?php
            $secName = $_SESSION['secName'];
            echo"<h4>$secName<h4>";
            ?>
        </div>
        <div style="text-align: center;">
            <h5>Фамилия<h5>
            <?php
            $lastName=$_SESSION['lastName'];
            echo"<h4>$lastName<h4>";
            ?>
        </div>
        <div style="text-align: center;">
            <h5>Парола<h5>
            <?php
            $passii=$_SESSION['password'];
            $new="";
            $int=0;
            while($int <= strlen($passii)){
                $new .= '*';
                $int++;
            }
            echo"<h4>$new<h4>";
            ?>
        </div>
        <div style="text-align: center;margin-bottom: 50;">
            <h5>Имейл<h5>
            <?php
            $email=$_SESSION['email'];
            echo"<h4>$email<h4>";
            ?>
        </div>
    </body>
</html>