<?php
    session_start();
    include 'connect.php';

    if(!isset($_SESSION["admin"]))
    {
        echo "Трябва да влезете в административен профил, за да имате достъп до тези функции";
        return;
    }

    $table = $_GET['table'];
    $id = $_GET['id'];
    $conn = OpenCon();
    $location;
    if(isset($_GET['image']))
    {
        $image = $_GET['image'];
        $sql = "DELETE FROM images WHERE ID = $image";
        $conn->query($sql);
    }
    $sql = "DELETE FROM $table WHERE ";
    if($table == "items" || $table == "lthings")
    {
        $message;
        if(isset($_GET['reason']))
        {
            $message = $_GET['reason'];
        }
        else
        {
            $message = "Тази обява нарушава нашите условия за ползване!";
        }
        $date = date("Y-m-d h:i:sa").'';
        $msg = "INSERT INTO messages (from_ID, to_ID, message, date, seen) VALUES (0, $to_id, '$message', '$date', false)";
        $conn->query($msg);
        $sql .= "IID = $id";
    }
    else if($table == "users")
    {
        $sql .= "id = $id";
        $location = "users.php";
    }
    else if($table == "admins")
    {
        $sql .= "ID = $id";
        $location = "admins.php";
    }
    else
    {
        $sql .= "MID = $id";
        $location = "messages.php";
    }
   
    $conn->query($sql);
    header("Location: $location");
    ob_enf_fluch();
    exit();
    

?>