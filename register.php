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
	</head>
	<body>
        <div style='text-align: center;'>
        <img src="pic/LOGO.png"style="max-height:300;">
        </div>
		<div class="row" style="text-align: center;">
			<a style='margin-right:10px' href='login.php' class='waves-effect waves-light'>Вече имате акаунт?</a>
            <form  action="" method="POST" class="col s12">
              <div class="row">
					   <p>
						<label>
						  <input type="checkbox" name='check' id='check' />
						  <span style="color: black;" >Съгласни ли сте с условията за използване. Подробности <a href="info.html">ТУК</a></span>
						</label>
					  </p>
			<div class="row">  
                <div class="input-field col s6 " style="background-color: white;margin-left:25%" >
                  <input style="text-align: center;" placeholder="Първо име" name="name" id="name" type="text" class="validate">
                </div>
                
                <div class="input-field col s6" style="background-color: white;margin-left:25%"> 
                  <input style="text-align: center;" placeholder="Второ име" name="secName" id="secName" type="text" class="validate">
                </div>
                
                <div  class="input-field col s6" style="background-color: white;margin-left:25%">
                  <input style="text-align: center;" placeholder="Фамилия" name="lastName" id="lastName" type="text" class="validate">
                </div>
              
                <div class="input-field col s6" style="background-color: white;margin-left:25%">
                  <input style="text-align: center;" placeholder="Парола" name="password" id="password" type="password" class="validate">
                </div>
              
                <div class="input-field col s6" style="background-color: white;margin-left:25%">
                  <input style="text-align: center;" placeholder="Повтори паролата" name="password2" id="password2" type="password" class="validate">
                </div>
              
                <div class="input-field col s6" style="background-color: white;margin-left:25%">
				  <input style="text-align: center;" placeholder="Имейл" name="email" id="email" type="email" class="validate">
				</div>
			  
              <div class="input-field col s12" style="text-align: center;">
                <button style="text-align: center;" class="btn waves-effect waves-light" type="submit" name="action" id="action">Напред</button>
			  </div>
            </form>
          </div>
          <div style="text-align: center;margin-bottom:50;">
          <?php
        //свързвеаме се с базата данни
        include 'profileCon.php';
        $conn=OpenCon();

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
        $name=$_POST['name'];
        $secName=$_POST['secName'];
        $lastName=$_POST['lastName'];


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
            session_start();
			$_SESSION['ID'] = $id;
            $_SESSION['email']=$emailii;
            $_SESSION['password']=$passii;
            $_SESSION['name']=$name;
            $_SESSION['secName']=$secName;
            $_SESSION['lastName']=$lastName;

            //препращаме потребителя към току-що създаеният му профил
            header("Location: Profile.php");
            exit();
        }
        echo"<font style='text-align: center;' color='red'>Имейлът вече е зает</font>";
}
?>
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
		   if(check.checked == true){
		       alert("Моля, съгласете се с условията");
				return false;
		   }
      });  
 });  

</script>