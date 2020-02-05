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

		$name = $_FILES['file']['name'];
		$target_dir = "upload/";
		$target_file = $target_dir . basename($_FILES["file"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$extensions_arr = array("jpg","jpeg","png","gif");
		if( in_array($imageFileType,$extensions_arr) )
		{
			$sql = "insert into images(name) values('".$name."')";
			$conn->query($sql);
			move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
		}

		CloseCon($conn);
		header("Location: index.php");
	}
	Add($_POST['title'], $_POST['desc'], $_POST['price'], $_POST['group3'], $_POST['date']);
?>