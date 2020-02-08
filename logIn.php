<?php
$host="localhost";
$user="root";
$password="";
$db="login";
$som=mysqli_connect($host,$user,$password);
mysqli_select_db($som,$db);

if(isset($_POST['email'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $sql="select * from users where e-mail='".$email."' AND pass='".$password."'limit 1";

        $result=mysql_query($sql);
        if(mysql_num_rows($result) == 1){
          echo"Logged in !!!";
          exit();
        }
        else{
          echo"Incorrect";
          exit();
        }
}
?>
<html>
    <head>
		<meta charset="utf-8">
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
		<title>Въпроси</title>
		<link rel="stylesheet" href="css\style.css">
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<script src="js/jquery.js"></script>
		<script src="js/materialize.js"></script>
		<script src="js/script.js"></script>
	</head>
	<body>
        <h1 style="text-align:center">Моето училище</h1>
		<div class="row">
            <form action="#" method="POST" class="col s12" >
              <div class="row">
                <div class="input-field col s12" style="text-align: center; margin-top: 10;">
                  <input placeholder="Имейл" id="email" type="email" class="validate">
                </div>
              </div>
              <div class="row"style="text-align: center;">
                <div class="input-field col s12" style="text-align: center;margin-top: 10;">
                  <input placeholder="Парола" id="password" type="password" class="validate">
                </div>
              </div>
              <div class="row">
                  <div class="input-field col s12" style="text-align: center;margin-top: 10;">
                      <button style="text-align: center;">Напред</button>
                  </div>
              </div>
            </form>
          </div>
    </body>
</html>