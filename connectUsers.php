<?php
$email = $POST['email'];
$password = $POST['password'];

$email = stripcslashes($email);
$password = stripcslashes($password);
$email = mysql_real_escape_string($email);
$password = mysql_real_escape_string($password);
?>