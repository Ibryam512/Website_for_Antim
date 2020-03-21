<?php
    session_start();
	include "connect.php";
	$conn = OpenCon();
	$to_id =  $_GET["to"];
	$from_id = $_SESSION["ID"];
	$date = date("Y-m-d h:i:sa").'';
	if($to_id === $from_id){
	    header("Location: index.php");
	    return;
	}
	$F="<";
	$E=">";
	$title = $_POST['message'];
	$T=strpos($title,$F);
	$T2=strpos($title,$E);
	if($T !== false && $T2 !== false){
	   header("Location: index.php");
	   exit();
	}
	$message =  mysqli_real_escape_string($conn,$_POST["message"]);
	
	if(!isset($_SESSION["ID"]))
	{
		header("Location: login.php");
		return;
	}
	if(!isset($message))
	{
	    header("Location: messages.php");
	    exit;
	}
	
	$sql = "INSERT INTO messages (from_ID, to_ID, message, date) VALUES ($from_id, $to_id, '$message', '$date')";
	$conn->query($sql);
	header("Location: messages.php");
	ob_enf_fluch();
?>
<script>
    alert("Опитвате се да изпратите празно съобщение");
    return;
</script>