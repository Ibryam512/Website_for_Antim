<?php
	//изпрашане на имейл
	$to_email = "bamko2003@gmail.com";
	$subject = 'Testing PHP Mail';
	$message = 'email by: '. $_POST["name"]. 'email: '. $_POST["email"]. 'message: '. $_POST["message"];
	$headers = 'From: noreply @ company . com';
	mail($to_email,$subject,$message,$headers);
	header("Location: questions.html");

?>