<?php
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = "От: ".$name."\r\nИмейл: ".$email."\r\nСъобщение: ".$_POST["message"]; 
    
    mail("bamko2003@gmail.com", "Въпрос/Бъг", $message);
    mail("vencal4o76@gmail.com", "Въпрос/Бъг", $message);
    header("Location: index.php");
	ob_enf_fluch();
?>