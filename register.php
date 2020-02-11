<?php
$host="localhost";
$user="root";
$pas="";
$db="login";
$conn=new mysqli($host,$user,$pas,$db);

$email=hash('sha256',$_POST['email']);
$password=hash('sha256',$_POST['password']);
$name=$_POST['name'];
$secName=$_POST['secName'];
$lastName=$_POST['lastName'];
if(isset($email)&&isset($password)&&isset($name)&&isset($secName)&&isset($lastName)){
    if($conn->connect_error){
        die('Conn failed !!!! '.$conn->connect_error);
    }
     $sql="INSERT INTO `users`(`id`, `e-mail`, `pass`, `name`, `secName`, `lastName`) VALUES (NULL,'$email','$password','$name','$secName','$lastName')";
     $result = $conn->query($sql);
}
?>