<?php
function OpenCon()
{
    $host="localhost";
    $user="root";
    $password="";
    $db="login";
    $conn=new mysqli($host,$user,$password,$db);
    return $conn;
}

function CloseCon($conn)
{
    $conn -> close();
}
?>