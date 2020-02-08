<?php
$host="localhost";
$user="root";
$password="";
$db="login";
$som=mysqli_connect($host,$user,$password);
mysqli_select_db($som,$db);
echo"text"
if(isset($_POST['email'])){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $sql="SELECT * FROM users WHERE e-mail='".$email."' AND pass='".$password."'LIMIT 1";

        $result=mysql_query($sql);
        
        if(mysql_num_rows($result) == 1){
          echo"maikoooo";
          
        }
        else{
         echo"miau";
         
        }
}
?>