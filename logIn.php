<?php
include 'profileCon.php';
$conn = OpenCon();
if(!empty($_POST['email'])&&!empty($_POST['password'])){
        if($conn->connect_error){
           die('Conn failed !!!! '.$conn->connect_error);
       }
        $email=$_POST['email'];
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
          // ima takuv
          if($dbEmail === $email  &&  $dbPassword === $password){
            $dbID=$row['id'];
            session_start();
            $_SESSION['id']=$dbID;
            $_SESSION['email']=$email;
            $_SESSION['password']=$passii;
            $_SESSION['name']=$name;
            $_SESSION['secName']=$secName;
            $_SESSION['lastName']=$lastName;
            header("Location: Profile.php");
            $mom = true;
          }
          $int++;
        }
        /// Nqma takuv
        if($mom == false){
          header("Location: login.html");
        }
}
else{
  header("Location: login.html");
}
?>