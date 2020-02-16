<?php
function OpenCon()
{
    $host="localhost";
    $user="root";
    $password="";
    $db="website_for_antim";
    $conn=new mysqli($host,$user,$password,$db);
    return $conn;
}

function CloseCon($conn)
{
    $conn -> close();
}
?>