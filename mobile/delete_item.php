<?php
	include "connect.php";
	$conn = OpenCon();
	$id = $_GET["id"];
	$sql = "DELETE items, images FROM items INNER JOIN images ON items.imageID = images.ID WHERE items.IID = $id";
	$conn->query($sql);
	header("Location: my_items.php");
?>

