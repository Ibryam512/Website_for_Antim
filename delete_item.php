<?php
	//изтриване на собствена обява
	include "connect.php";
	$conn = OpenCon();
	$id = $_GET["id"];
	$sql = "DELETE FROM `items` WHERE IID = $id";
	$conn->query($sql);
	header("Location: index.php");
?>