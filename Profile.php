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
            <label for="disabled">Име</label>
            <?php 
            session_start();
            $name = $_SESSION['name'];
            echo "<p>$name<p>";
            ?>
        </div>
        <div style="text-align: center;">
            <label for="disabled">Презиме</label>
            <?php
            $secName = $_SESSION['secName'];
            echo"<p>$secName<p>";
            ?>
        </div>
        <div style="text-align: center;">
            <label for="disabled">Фамилия</label>
            <?php
            $lastName=$_SESSION['lastName'];
            echo"<p>$lastName<p>";
            ?>
        </div>
        <div style="text-align: center;">
            <label for="disabled">Парола</label>
            <?php
            $passii=$_SESSION['password'];
            $new="";
            $int=0;
            while($int <= strlen($passii)){
                $new .= '*';
                $int++;
            }
            echo"<p>$new<p>";
            ?>
        </div>
        <div style="text-align: center;margin-bottom: 50;">
            <label for="disabled">Имейл</label>
            <?php
            $email=$_SESSION['email'];
            echo"<p>$email<p>";
            ?>
        </div>
    </body>
</html>