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
    <style>
      .input-field {
        margin: 0;
      }
      h1 {
        margin-top: 0;
      }
      input::placeholder {
        color: #333;
      }
    </style>
	</head>
	<body>
    <div class="center-align">
      <img src="pic/LOGO.png"style="max-height:100%;max-width:100%;">
    </div>
    <div class="row center-align">  
      <div class="card col m4 offset-m4">
        <div class="card-content">
          <form  action="" method="POST" class="col s12">
            <h1>Вход</h1>
            <div class="row">
              <div class="center-align">
                <?php
                  // връзка с бата данни
                  include 'profileCon.php';
                  $conn = OpenCon();
                  if(isset($_POST['email']))
                  {
                      $_GET['email'] = $_POST['email'];
                      $_GET['psw'] = $_POST['password'];
                  }
                   if(isset($_GET['email']) && isset($_GET['psw']))
                   {
                        $_POST['email'] = $_GET['email'];
                        $_POST['password'] = $_GET['psw'];
                        unset($_GET['email']);
                        unset($_GET['psw']);
                   }
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
                    echo "<div><font style='text-align: center;' color='red'>Грешен имейл или парола</font></div>";
                  }
                ?>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input name="email" id="email" type="text" class="validate">
                <label for="email">Имейл</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input name="password" id="password" type="password" class="validate">
                <label for="password">Парола</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <button class="btn waves-effect waves-light" type="submit" name="action" id="action">Напред</button>
              </div>
            </div>
            <div class="row">
              <a href="register.php" class="waves-effect waves-light">Нямате акаунт?</a>
            </div>
          </form>
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