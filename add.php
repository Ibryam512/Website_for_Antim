<?php
	include 'connect.php';

	function Add($title, $desc, $price, $type, $date)
	{
		$conn = OpenCon();
		$table;
		if($type == "Обява")
		{
			$table = "items";
		}
		else
		{
			$table = "lthings";
		}

		   
		
        $image = $_FILES["image"]["tmp_name"];
        $imgContent = addslashes(file_get_contents($image));

		$sql = "INSERT INTO images (image) VALUES ('$imgContent')";
		$conn->query($sql);
		$last_id = $conn->insert_id;
		$sql = "INSERT INTO $table
					(title, description, price, date, imageID)
					VALUES ('$title', '$desc', $price, '$date', $last_id)";
		$conn->query($sql);
		CloseCon($conn);
		header("Location: index.php");
	}
	Add($_POST['title'], $_POST['desc'], $_POST['price'], $_POST['group3'], $_POST['date']);
?>