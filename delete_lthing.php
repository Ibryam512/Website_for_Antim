<?php
	include "connect.php";
	$conn = OpenCon();
	$id = $_GET["id"];
	$sql = "DELETE lthings, images FROM lthings INNER JOIN images ON ilthings.imageID = images.ID WHERE lthings.IID = $id";
	$conn->query($sql);
	header("Location: my_items.php");
?>