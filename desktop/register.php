<?php
  session_start();
  ob_start();
?>
<html>
  <head>
		<meta charset="utf-8">
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
		<title>Регистрирай се</title>
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
            <h1>Регистрация</h1>
            <div class="row">
              <?php
                //свързвеаме се с базата данни
                include 'profileCon.php';
                $conn=OpenCon();
                if(isset($_POST['email']))
                  {
                      $_GET['email'] = $_POST['email'];
                      $_GET['psw'] = $_POST['password'];
                      $_GET['name'] = $_POST['name'];
                      $_GET['secName'] = $_POST['secName'];
                      $_GET['lastName'] = $_POST['lastName'];
                  }
                if(isset($_GET['email']))
                {
                    $_POST['email'] = $_GET['email'];
                    $_POST['name'] = $_GET['name'];
                    $_POST['secName'] = $_GET['secName'];
                    $_POST['lastName'] = $_GET['lastName'];
                    $_POST['password'] = $_GET['psw'];
                }
                //проверяваме дали са попълнени полетата
                if(isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['name'])&&isset($_POST['secName'])&&isset($_POST['lastName']))
                {
                  //при евентуална грешка при връзката с базата данни
                  if($conn->connect_error){
                      die('Conn failed !!!! '.$conn->connect_error);
                  }
                  //взимаме хешираните данни напортебителя
                  $email=hash('sha256',$_POST['email']."Ibrqm,Venci");
                  $password=hash('sha256',$_POST['password']."Ibrqmov,Nenov");

                  //взимаме именат на потребителя
                  $name= mysqli_real_escape_string($conn,$_POST['name']);
                  $secName=mysqli_real_escape_string($conn,$_POST['secName']);
                  $lastName=mysqli_real_escape_string($conn,$_POST['lastName']);


                  //подсигуряваме се дали вече няма създаден профил с този имейл
                  $sql1="SELECT * FROM users";
                  $result = $conn->query($sql1);
                  $id = 0;
                  $mom = false;
                  while($id < $row=$result->num_rows){
                    $row = $result->fetch_assoc();
                    $bdEmail=$row['e-mail'];
                    if($email==$bdEmail){
                        $mom=true;
                    }
                    $id++;
                  }

                  // ако не е бил използван този профил
                  if($mom == false){

                    //добавяме портребитеял в базата данни
                    $sql="INSERT INTO `users`(`e-mail`, `pass`, `name`, `secName`, `lastName`) VALUES ('$email','$password','$name','$secName','$lastName')";
                    $result = $conn->query($sql);
                    $id = $conn->insert_id;
                    $emailii=$_POST['email'];
                    $passii=$_POST['password'];
                    
                    $_SESSION['ID'] = $id;
                    $_SESSION['email']=$emailii;
                    $_SESSION['password']=$passii;
                    $_SESSION['name']=mysqli_real_escape_string($conn,$name);
                    $_SESSION['secName']=mysqli_real_escape_string($conn,$secName);
                    $_SESSION['lastName']=mysqli_real_escape_string($conn,$lastName);

                    //препращаме потребителя към току-що създаеният му профил
                    header("Location: Profile.php");
                    ob_enf_fluch();
                    exit();
                  }
                  echo "<font style='text-align: center;' color='red'>Имейлът вече е зает</font>";
                }
              ?>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input name="name" id="name" type="text" class="validate">
                <label for="name">Име</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12"> 
                <input name="secName" id="secName" type="text" class="validate">
                <label for="secName">Презиме</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input name="lastName" id="lastName" type="text" class="validate">
                <label for="lastName">Фамилия</label>
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
                <input name="password2" id="password2" type="password" class="validate">
                <label for="password2">Потвърди паролата</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input name="email" id="email" type="email" class="validate">
                <label for="email">Имейл</label>
              </div>
            </div>
            <div class="row">
              <label>
                <input type="checkbox" class="filled-in" name="check" id="check" />
                <span style="color: black;" >Съгласни ли сте с условията за използване. Подробности <a href="info.html">ТУК</a></span>
              </label>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <button class="btn waves-effect waves-light" type="submit" name="action" id="action">Напред</button>
              </div>
            </div>
            <div class="row">
              <a style="margin-right: 10px" href="login.php" class="waves-effect waves-light">Вече имате акаунт?</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
  $(document).ready(function(){  
    $('#action').click(function(){  
      var name = $('#name').val();
      var secname = $('#secName').val();
      var lastname = $('#lastName').val();
      var pass = $('#password').val();
      var pass2 = $('#password2').val(); 
      var email = $('#email').val();
      var check = $('#check').val();
		   
      if(name == ''||secname == ''||lastname == '')
      {
				alert("Моля, напишете имената си");
				return false;
      }
      if(pass == '')
      {
				alert("Моля, напишете паролата си");
				return false;
      }
      if(pass2 == ''){
        alert("Моля, повторете паролата си");
        return false;
      }
      else if(pass.length < 6 )
      {
				alert("Паролата трябва да е с минимум 6 знака");
				return false;
      }
      else if(pass != pass2){
        alert("Паролата e грешна");
				return false;
      }
      if(email == '')
      {
				alert("Моля, напишете вашия имейл");
				return false;
      }
      if(!document.getElementById('check').checked){
        alert("Моля, съгласете се с условията");
				return false;
      }
      }
    });  
  });  
</script>

