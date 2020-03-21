<?php
	function OpenCon()
	{
		$dbhost = "localhost";
		$dbuser = "id12716257_website_for_antim";
		$dbpass = "123123";
		$db = "id12716257_website_for_antim";
		$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
		
		return $conn;
	}
	
	function CloseCon($conn)
	{
		$conn -> close();
	}
?>