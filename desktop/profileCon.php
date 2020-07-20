<?php
// отваряне на връзката
function OpenCon()
{
    $host="localhost";
    $user="root";
    $password="";
    $db="antimalnik";
    $conn=new mysqli($host,$user,$password,$db);
    return $conn;
}
// приключване на връзката
function CloseCon($conn)
{
    $conn -> close();
}
?>