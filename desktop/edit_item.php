<?php
	include 'connect.php';
	session_start();
	function Edit($title, $desc, $price, $date)
	{
		$conn = OpenCon();
		$id = $_GET['id'];
		//проверяваме типа на фаила, който ни е подаден
		$title = mysqli_real_escape_string($conn,$title);
		$desc = mysqli_real_escape_string($conn,$desc);
		$date=mysqli_real_escape_string($conn,$date);
		$sql = "SELECT * FROM items WHERE IID = $id";
		$check = false;
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc())
		{
			if($row['userID'] == $_SESSION['ID'])
			{
				$check = true;
				break;
			}
		}
		
		if($check)
		{
			$sql = "UPDATE `items` SET `title`='$title',`description`='$desc',`price`=$price,`date`='$date' WHERE IID = $id";
			$conn->query($sql);
			CloseCon($conn);			
				
			header("Location: my_items.php");
		}
		else
		{
			header("Location: index.php");
		}
	
	}
	
	$F="<";
	$E=">";
	$title = $_POST['title'];
	$T=strpos($title,$F);
	$T2=strpos($title,$E);
	$desc = $_POST['desc'];
	$D=strpos($desc,$F);
	$D2=strpos($desc,$F);
	if($T !== false && $T2 !== false || $D !== false && $D2 !== false){
	   header("Location: my_items.php");
	   exit();
	}
        Edit($_POST['title'], $_POST['desc'], $_POST['price'], $_POST['date']);
?>