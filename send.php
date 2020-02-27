<?php
	//връзка с базата данни
	include "connect.php";
	$conn = OpenCon();
	$to_id = $_GET["to"];
	$message = $_POST["message"];
	session_start();
	if(!isset($_SESSION["ID"]))
	{
		header("Location: login.html");
		return;
	}
	//изпращане на съобщение
	$from_id = $_SESSION["ID"];
	$sql = "INSERT INTO messages (from_ID, to_ID, message) VALUES ($from_id, $to_id, '$message')";
	$conn->query($sql);
	header("Location: index.php");
?>