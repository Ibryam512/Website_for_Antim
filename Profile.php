<?php
ob_start();
?>
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
				<li id="options"><a href="team.php">За нас</a></li>
				<li id="options"><a href="questions.php">Въпроси</a></li>
				<li id="options"><a href="messages.php">Съобщения</a></li>
				<li id="options"><a href="lost_things.php">Изгубени вещи</a></li>
				<li id="options"><a href="index.php">Сергия</a></li>
				<li id="image"><img src="pic/image.png" height="45" width="45"></li>
			</ul>
        </div>
        <div style="text-align: center;">
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
        <div>
            <?php
                  
                  if(!isset($_SESSION['email'])||!isset($_SESSION['password'])){
                       echo"<div style='text-align: center;'>";
                       echo"<a style='margin-right:1%' href='login.html' class='waves-effect waves-light btn-large'>Влез в акаунта си</a>";
                       echo"<a style='margin-left:1%' href='register.html' class='waves-effect waves-light btn-large'>Регистрирай се</a>";
                       echo"</div>";
                       exit();
                   }
            ?>
                <a href="CHprofile.php"><button style="border-radius: 5000px;cursor: pointer;background-color: initial;border: initial;" ><img style="border-radius: 5000000px;" src="pic/Edit.png" height="40"></button></a>
            </div>
        </div>
        <div style="text-align: center;">
            <h5>Име<h5>
            <?php 
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
            $pass=$_SESSION['password'];
            $new="";
            $int=0;
            while($int <= strlen($pass)){
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
        <form method="POST" action="">
        <div style="text-align: center;margin-bottom: 50;">
            <button type="submit" id="logout" name="logout" class='waves-effect waves-light btn-large' >Излез от профила</button>
        </div>
        </form>
    </body>
</html>
<?php
if(isset($_POST['logout'])){
    unset($_SESSION['email']);
    unset($_SESSION['password']);
    unset($_SESSION['name']);
    unset($_SESSION['secName']);
    unset($_SESSION['lastName']);
    unset($_SESSION['image']);
   header("Location:Profile.php");
    ob_enf_fluch();
}
?>