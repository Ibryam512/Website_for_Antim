<?php
	include 'connect.php';

	function Edit($title, $desc, $date)
	{
		$conn = OpenCon();
		$id = $_GET['id'];
		//проверяваме типа на фаила, който ни е подаден
		$title = mysqli_real_escape_string($conn,$title);
		$desc = mysqli_real_escape_string($conn,$desc);
		$date=mysqli_real_escape_string($conn,$date);	
		$sql = "UPDATE `lthings` SET `title`='$title',`description`='$desc', `date`='$date' WHERE IID = $id";
				$conn->query($sql);
				CloseCon($conn);			
				
				header("Location: my_items.php");
	
	}
	
	Edit($_POST['title'], $_POST['desc'], $_POST['price'], $_POST['date']);
	
	
?>