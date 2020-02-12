<?php
$host="localhost";
$user="root";
$pas="";
$db="login";
$conn=new mysqli($host,$user,$pas,$db);

$email=$_POST['email'];
$password=hash('sha256',$_POST['password']."Ibrqmov,Nenov");
$name=$_POST['name'];
$secName=$_POST['secName'];
$lastName=$_POST['lastName'];
if(isset($email)&&isset($password)&&isset($name)&&isset($secName)&&isset($lastName)){
    if($conn->connect_error){
        die('Conn failed !!!! '.$conn->connect_error);
    }
    $sql1="SELECT * FROM users";
        $result = $conn->query($sql1);
        $int = 0;
        $mom = false;
        while($int < $row=$result->num_rows){
          $row = $result->fetch_assoc();
          $bdEmail=$row['e-mail'];
          if($email==$bdEmail){
              $mom=true;
          }
          $int++;
        }
        if($mom == false){
            $sql="INSERT INTO `users`(`e-mail`, `pass`, `name`, `secName`, `lastName`) VALUES ('$email','$password','$name','$secName','$lastName')";
            $result = $conn->query($sql);
            session_start();
            $_SESSION['email']=$email;
            $_SESSION['name']=$name;
            $_SESSION['secName']=$secName;
            $_SESSION['lastName']=$lastName;
            header("Location: Profile.php");
        }
     else{
        header("Location: register.html");
     }
}
?>