<?php
$host="localhost";
$user="root";
$password="";
$db="login";
$som=mysqli_connect($host,$user,$password);
mysqli_select_db($som,$db);
echo"text";
if(isset($_GET['email'])&& isset($_GET['password'])){
  echo"maika ti";
        $email=$_GET['email'];
        $password=$_GET['password'];
        $sql="SELECT * FROM users WHERE e-mail='".$email."' AND pass='".$password."'LIMIT 1";

        $result=mysqli_query($som,$sql);
        
        if($result ->num_rows > 0){
          echo"IN";
        }
        else{
         echo"NOT IN";
        }
}
?>