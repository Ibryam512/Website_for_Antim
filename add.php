<?php
	include 'connect.php';

	function Add($title, $desc, $price, $type, $date)
	{
		$conn = OpenCon();
		$table;
		   
		$image = $_FILES["item_photo"]["tmp_name"];
        $imgContent = addslashes(file_get_contents($image));

		$sql = "INSERT INTO images (image) VALUES ('$imgContent')";
		$conn->query($sql);
		$last_id = $conn->insert_id;
		$title = strtolower($title);
		$desc = strtolower($desc);
		if($type == "Обява")
		{
			$sql = "INSERT INTO items
					(title, description, price, date, imageID)
					VALUES ('$title', '$desc', $price, '$date', $last_id)";
		}
		else
		{
			$sql = "INSERT INTO lthings
					(title, description, date, imageID)
					VALUES ('$title', '$desc', '$date', $last_id)";
		}
		$conn->query($sql);
		CloseCon($conn);
		header("Location: index.php");
	}
	Add($_POST['title'], $_POST['desc'], $_POST['price'], $_POST['group3'], $_POST['date']);
?>