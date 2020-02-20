
<?php
	include 'connect.php';

	function Add($title, $desc, $price, $type, $date)
	{
		$conn = OpenCon();
		if(isset($_SESSION['ID'])){
		$id = $_SESSION['ID'];
		}
		else{
		header("Location: login.html");
		return;
		}
		$image = $_FILES["item_photo"]["tmp_name"];
		$type = mime_content_type($image);
		//проверяваме типа на фаила, който ни е подаден
		if ($type == 'image/png' || $type == 'image/jpeg'){
			$imgContent = addslashes(file_get_contents($image));
			$sql = "INSERT INTO images (image) VALUES ('$imgContent')";
			$conn->query($sql);
			$last_id = $conn->insert_id;
			$title = $title;
			$desc = $desc;
			if($type == "Обява")
			{
				$sql = "INSERT INTO items
						(title, description, price, date, imageID, userID)
						VALUES ('$title', '$desc', $price, '$date', $last_id, '$id')";
			}
			else
			{
				$sql = "INSERT INTO lthings
						(title, description, date, imageID, userID)
						VALUES ('$title', '$desc', '$date', $last_id, '$id')";
			}
			$conn->query($sql);
			CloseCon($conn);
			header("Location: index.php");
		}
	}
	Add($_POST['title'], $_POST['desc'], $_POST['price'], $_POST['group3'], $_POST['date']);
?>
