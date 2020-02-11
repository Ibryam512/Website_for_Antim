<?php
$host="localhost";
$user="root";
$password="";
$db="login";
$conn=new mysqli($host,$user,$password,$db);
if(!empty($_POST['email'])&&!empty($_POST['password'])){
        if($conn->connect_error){
           die('Conn failed !!!! '.$conn->connect_error);
       }
        $email=hash('sha256',$_POST['email']);
        $password=hash('sha256',$_POST['password']);
        $sql="SELECT * FROM users";
        $result = $conn->query($sql);
        $int = 0;
        $mom = false;
        while($int < $row=$result->num_rows){
          $row = $result->fetch_assoc();
          $dbEmail = $row['e-mail'];
          $dbPassword = $row['pass'];
          // ima takuv
          if($dbEmail === $email  &&  $dbPassword === $password){
              header("Location: Profile.html");
              $mom = true;
          }
          $int++;
        }
        /// Nqma takuv
        if($mom == false){
          header("Location: login.html");
          echo "<script type='text/javascript'>alert('Wrong');</script>";
        }
}
else{
  header("Location: login.html");
}
?>