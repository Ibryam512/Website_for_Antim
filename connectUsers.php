<?php
$email = $POST['email'];
$password = $POST['password'];

$email = stripcslashes($email);
$password = stripcslashes($password);
$email = mysql_real_escape_string($email);
$password = mysql_real_escape_string($password);

mysql_connect("localhost","root","");
mysql_select_db("login");

$result = mysql_query("select * from users where email = '$email' and  password = '$password'")
or die("Failed to query database");
$row = mysql_fetch_array($result);
if($row['email'] == $email && $row['password'] == $password){
        echo "loged in".$row['email'];
}
else{
    echo "Failed";
}
?>