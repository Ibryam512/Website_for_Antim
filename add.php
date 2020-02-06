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

		

		$check = getimagesize($_FILES["image"]["tmp_name"]);
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));

		$sql = "INSERT into images (image) VALUES ('$imgContent')";
		$conn->query($sql);
		$last_id = $conn->insert_id;
		$sql = "INSERT INTO items
					(title, description, price, type, date, imageID)
					VALUES ('$title', '$desc', $price, '$typ', '$date', $last_id)";
		$conn->query($sql);
		CloseCon($conn);
		header("Location: index.php");
	}
	Add($_POST['title'], $_POST['desc'], $_POST['price'], $_POST['group3'], $_POST['date']);
?>