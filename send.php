<?php
	include "connect.php";
	$conn = OpenCon();
	$to_id = $_GET["to"];
	$message = $_POST["message"];
	session_start();
	if(!isset($_SESSION["ID"]))
	{
		header("Location: login.php");
		return;
	}
	if(!isset($message))
	{
	    exit;
	}
	$from_id = $_SESSION["ID"];
	$sql = "INSERT INTO messages (from_ID, to_ID, message) VALUES ($from_id, $to_id, '$message')";
	$conn->query($sql);
	header("Location: messages.php");
	ob_enf_fluch();
?>
<script>
    alert("Опитвате се да изпратите празно съобщение");
    return;
</script>