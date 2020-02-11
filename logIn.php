<?php
$host="localhost";
$user="root";
$password="";
$db="website_for_antim";
$conn=new mysqli($host,$user,$password,$db);
if(!empty($_POST['email'])&&!empty($_POST['password'])){
        if($conn->connect_error){
           die('Conn failed !!!! '.$conn->connect_error);
       }
        $email=hash('sha256',$_POST['email']."Ibrqmov,Nenov");
        $password=hash('sha256',$_POST['password']."Ibrqmov,Nenov");
        $sql="SELECT * FROM profiles";
        $result = $conn->query($sql);
        $int = 0;
        $mom = false;
        while($int < $row=$result->num_rows){
          $row = $result->fetch_assoc();
          $dbEmail = $row['email'];
          $dbPassword = $row['password'];
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