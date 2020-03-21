<?php
	include "connect.php";
	$conn = OpenCon();
	$mid = $_GET["id"];
	$sql = "DELETE FROM `messages` WHERE MID = $mid";
	$conn->query($sql);
	header("Location: messages.php");
?>