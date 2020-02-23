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
		      $id = $row['ID'];
          // има създаден профил и иска да велзе в него
          if($dbEmail === $email  &&  $dbPassword === $password){
            session_start();
			$_SESSION['ID'] = $id;
            $_SESSION['image']=$row['pic'];
            $_SESSION['email']=$emailii;
            $_SESSION['password']=$passii;
            $_SESSION['name']=$name;
            $_SESSION['secName']=$secName;
            $_SESSION['lastName']=$lastName;
            header("Location: Profile.php");
            exit();
          }
          $int++;
        }
}
?>
<script>
  alert("Грешен имейл или парола!!!");
  location.replace("login.html");
</script>
