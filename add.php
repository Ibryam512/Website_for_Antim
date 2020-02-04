<?php
	include 'connect.php';
	function Data($date)
	{
		$data = "";
		$month = $date[0] . $date[1] . $date[2];
		if($month == "Jan")
		{
			$data .= "01/";
		}
		else if($month == "Feb")
		{
			$data .= "02/";
		}
		else if($month == "Mar")
		{
			$data .= "03/";
		}
		else if($month == "Apr")
		{
			$data .= "04/";
		}
		else if($month == "May")
		{
			$data .= "05/";
		}
		else if($month == "Jun")
		{
			$data .= "06/";
		}
		else if($month == "Jul")
		{
			$data .= "07/";
		}
		else if($month == "Aug")
		{
			$data .= "08/";
		}
		else if($month == "Sep")
		{
			$data .= "09/";
		}
		else if($month == "Oct")
		{
			$data .= "10/";
		}
		else if($month == "Nov")
		{
			$data .= "11/";
		}
		else if($month == "Dec")
		{
			$data .= "12/";
		}
		$day = $date[4] . $date[5];
		$data .= $day . '/';
		$year = $date[8] . $date[9] . $date[10] . $date[11];
		$data .= $year;
		return $data;
	}
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
		
		$dat = strtotime(Data($date));
		$newformat = date('Yyyy-mm-dd',$dat);
		$sql = "INSERT INTO items
					(title, description, price, type, date)
					VALUES ('$title', '$desc', $price, '$typ', $newformat)";
		$conn->query($sql);
		CloseCon($conn);
		header("Location: index.php");
	}
	Add($_POST['title'], $_POST['desc'], $_POST['price'], $_POST['group3'], $_POST['date']);
?>