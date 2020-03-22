<?php
session_start();
ob_start();
?>

<html>
    <head>
		<meta charset="utf-8">
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
    <title>Вход</title>
    <link rel="icon" href="pic/LOGO.png">
		<link rel="stylesheet" href="css\style.css">
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<script src="js/jquery.js"></script>
		<script src="js/materialize.js"></script>
		<script src="js/script.js"></script>
	</head>
	<body>
	    <div style='text-align: center;'>
        <img src="pic/LOGO.png"style="max-height:100%;max-width:100%;margin-top:30%">
        </div>
    <div id='log'>  
        <div style='text-align: center;'>
      <a href='register.php' class='waves-effect waves-light' style="font-size:40px">Нямате акаунт?</a>
      </div>
      <form style='text-align: center;' action="" method="POST">
        <div class="row">
          <div class="input-field col s6" style="text-align: center;background-color: white;margin-left: 15%;height:auto;width:auto;">
            <input style="text-align: center;font-size:50px;height:auto;width:auto;background-color: white;" placeholder="Имейл" name="email" id="email" class="validate">
          </div>
        </div>
        <div class="row" style="text-align: center;">
          <div class="input-field col s6" style="text-align: center;background-color: white;margin-left: 15%;height:auto;width:auto;">
            <input style="text-align: center;font-size:50px;height:auto;width:auto;background-color: white;" placeholder="Парола" name="password" id="password" type="password"  class="validate">
          </div>
        </div>
        <div class="row">
          <div   style="text-align: center;">
            <button style="text-align: center;height:5%;width:20%;font-size:40px" class="btn waves-effect waves-light" type="submit" name="action" id="action">Напред</button>
          </div>
        </div>
      </form>
    </div>  
      <div style="text-align: center;">
      <?php
        // връзка с бата данни
    include 'profileCon.php';
    $conn = OpenCon();
    //проверяваме да ли са попълнени полетата за email и password
    if(!empty($_POST['email'])&&!empty($_POST['password'])){
        if($conn->connect_error){
          //прожеряваме дали е възникнал проблем при връзката с базата данни
           die('Conn failed !!!! '.$conn->connect_error);
       }
       //взимаме данните от емейл полето
        $emailii=$_POST['email'];
      //взимаме данните от полето за имейла, само че хеширани(с цел сигурност) за да може дори и ние да не знаем какви са данните на нашия портебител
        $email=hash('sha256',$_POST['email']."Ibrqm,Venci");
        $passii=$_POST['password'];
        $password=hash('sha256',$_POST['password']."Ibrqmov,Nenov");
        $sql="SELECT * FROM users";
        $result = $conn->query($sql);
        $int = 0;
        $mom = false;
        while($int < $row=$result->num_rows){
          $row = $result->fetch_assoc();
          $dbEmail = $row['e-mail'];
          $dbPassword = $row['pass'];
          $name = $row['name'];
          $secName=$row['secName'];
          $lastName=$row['lastName'];
		      $id = $row['id'];
          // има създаден профил и иска да велзе в него
          if($dbEmail === $email  &&  $dbPassword === $password){
			$_SESSION['ID'] = $id;
            $_SESSION['image']=$row['pic'];
            $_SESSION['email']=$emailii;
            $_SESSION['password']=$passii;
            $_SESSION['name']=$name;
            $_SESSION['secName']=$secName;
            $_SESSION['lastName']=$lastName;
            header("Location: Profile.php");
            ob_enf_fluch();
            exit();
          }
          $int++;
        }
        echo"<div><font style='text-align: center;' color='red'>Грешен имейл или парола</font></div>";
    }
?>
</div>
    </div>
  </body>
</html>
<script>
$(document).ready(function(){  
  $('#action').click(function(){ 
      var password = $('#password').val();
      var email = $('#email').val();
   
      if(email == '')
   {
    alert("Моля, напишете вашия имейл");
    return false;
   }
   if(password == '')
       {
    alert("Моля, напишете паролата си");
    return false;
   }
  });  
});  
</script>
