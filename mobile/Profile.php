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
		
        <div style="text-align: center;">
        <?php
            if(!empty($_SESSION['image'])){
                $i=$_SESSION['image'];
                $l="/desktop/pic/PROF/".$i;
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
                       echo"<a style='margin-right:1%;height:4%;width:40%;font-size:30px' href='login.php' class='waves-effect waves-light btn-large'>Влез в акаунта си</a>";
                       echo"<a style='margin-left:1%;height:4%;width:40%;font-size:30px' href='register.php' class='waves-effect waves-light btn-large'>Регистрирай се</a>";
                       echo"</div>";
                       exit();
                   }
            ?>
                <a  href="CHprofile.php"><button style="border-radius: 5000px;cursor: pointer;background-color: initial;border: initial;" ><img style="border-radius: 5000000px;" src="pic/Edit.png" height="110"></button></a>
            </div>
        </div>
        <div style="text-align: center;">
            <h2>Име</h2>
            <?php 
            $name = $_SESSION['name'];
            echo "<h1>$name<h1>";
            ?>
        </div>
        <div style="text-align: center;">
            <h2>Презиме</h2>
            <?php
            $secName = $_SESSION['secName'];
            echo"<h1>$secName<h1>";
            ?>
        </div>
        <div style="text-align: center;">
            <h2>Фамилия</h2>
            <?php
            $lastName=$_SESSION['lastName'];
            echo"<h1>$lastName<h1>";
            ?>
        </div>
        <div style="text-align: center;">
            <h2>Парола</h2>
            <?php
            $pass=$_SESSION['password'];
            $new="";
            $int=0;
            while($int <= strlen($pass)){
                $new .= '*';
                $int++;
            }
            echo"<h1>$new<h1>";
            ?>
        </div>
        <div style="text-align: center;margin-bottom: 50;">
            <h2>Имейл</h2>
            <?php
            $email=$_SESSION['email'];
            echo"<h1>$email<h1>";
            ?>
        </div>
        
        <form method="POST" action="">
        <div style="text-align: center;margin-bottom: 50;">
            <button style="height:5%;width:40%;font-size:30px" type="submit" id="logout" name="logout" class='waves-effect waves-light btn-large' >Излез от профила</button>
        </div>
        
        </form>
    </body>
</html>
<?php
if(isset($_POST['logout'])){
    unset($_SESSION['ID']);
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