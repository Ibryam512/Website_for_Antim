<?php
$host="localhost";
$user="root";
$password="";
$db="login";
$som=mysqli_connect($host,$user,$password);
mysqli_select_db($som,$db);

if(isset($_POST['email'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $sql="select * from users where e-mail='".$email."' AND pass='".$password."'limit 1";

        $result=mysql_query($sql);
        if(mysql_num_rows($result) == 1){
          echo"Logged in !!!";
          exit();
        }
        else{
          echo"Incorrect";
          exit();
        }
}
?>