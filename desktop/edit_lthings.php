<?php
	include 'connect.php';
	session_start();


	function Edit($title, $desc, $date)
	{
		$conn = OpenCon();
		$id = $_GET['id'];
		//проверяваме типа на фаила, който ни е подаден
		$title = mysqli_real_escape_string($conn,$title);
		$desc = mysqli_real_escape_string($conn,$desc);
		$date=mysqli_real_escape_string($conn,$date);	
		$sql = "SELECT * FROM lthings WHERE IID = $id";
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
			$sql = "UPDATE `lthings` SET `title`='$title',`description`='$desc', `date`='$date' WHERE IID = $id";
					$conn->query($sql);
					CloseCon($conn);			
					
					header("Location: my_items.php");
		}
		else
		{
			header("Location: lost_things.php");
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
	Edit($title, $desc, $_POST['date']);
	
	
?>