<?php
	include 'connect.php';
	function Add($title, $desc, $price, $type, $date)
	{
		$conn = OpenCon();
		$typ;
		if($type == "Обява")
		{
			$typ = true;
		}
		else
		{
			$typ = false;
		}
		$sql = "INSERT INTO items
					(title, description, price, type, date)
					VALUES ('$title', '$desc', $price, '$typ', '$date')";
		$conn->query($sql);
		CloseCon($conn);
		header("Location: index.php");
	}
	Add($_POST['title'], $_POST['desc'], $_POST['price'], $_POST['group3'], $_POST['date']);
?>