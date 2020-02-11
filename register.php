<?php
$host="localhost";
$user="root";
$pas="";
$db="website_for_antim";
$conn=new mysqli($host,$user,$pas,$db);

$email=hash('sha256',$_POST['email']."Ibrqmov,Nenov");
$password=hash('sha256',$_POST['password']."Ibrqmov,Nenov");
$name=$_POST['name'];
$secName=$_POST['secName'];
$lastName=$_POST['lastName'];
if(isset($email)&&isset($password)&&isset($name)&&isset($secName)&&isset($lastName)){
    if($conn->connect_error){
        die('Conn failed !!!! '.$conn->connect_error);
    }
     $sql="INSERT INTO `profiles`(`email`, `password`, `name`, `surname`, `lastname`) VALUES ('$email','$password','$name','$secName','$lastName')";
     $result = $conn->query($sql);
}
?>