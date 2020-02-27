<?php
	//изтриване на собствена обява
	include "connect.php";
	$conn = OpenCon();
	$id = $_GET["id"];
	$sql = "DELETE FROM `lthings` WHERE IID = $id";
	$conn->query($sql);
	header("Location: lost_things.php");
?>