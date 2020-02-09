<?php
$host="localhost";
$user="root";
$password="";
$db="login";
$com=mysqli_connect($host,$user,$password);
mysqli_select_db($som,$db);
if(isset($_GET['email'])&&isset($_GET['password'])){
        $email=$_GET['email'];
        $password=$_GET['password'];
        $sql="SELECT * FROM users WHERE e-mail='".$email."' AND pass='".$password."'LIMIT 1";
        $result=mysqli_query($con,$sql);
        if(mysqli_num_rows($result) == 1){
          echo"Logged in !!!";
          exit();
        }
        else{
          echo"Incorrect";
          exit();
        }
}
?>