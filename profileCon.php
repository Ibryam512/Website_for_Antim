<?php
// отваряне на връзката
function OpenCon()
{
    $host="localhost";
    $user="id12716257_website_for_antim";
    $password="123123";
    $db="id12716257_website_for_antim";
    $conn=new mysqli($host,$user,$password,$db);
    return $conn;
}
// приключване на връзката
function CloseCon($conn)
{
    $conn -> close();
}
?>