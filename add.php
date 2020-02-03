<?php
	include 'connect.php';
	function Add($title, $desc, $price, $type, $date)
	{
		$conn = OpenCon();
		$sql = "INSERT INTO items
					(title, description, price, type, date)
					VALUES ('$title', '$desc', $price, '$type', '$date')";
		$conn->query($sql);
		CloseCon($conn);
	}
	Add($_POST['title'], $_POST['desc'], $_POST['price'], $_POST['type'], $_POST['date']);
?>