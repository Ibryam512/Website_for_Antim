<?php
	$host="localhost";
    $user="root";
    $pas="";
    $db="login";
    $conn=new mysqli($host,$user,$pas,$db);

		if(isset($_POST['photo'])){
    		
		}
		else if(isset($_POST['save'])){
			session_start();
			if(!empty($_POST['name'])&&!empty($_POST['secName'])&&!empty($_POST['lastName'])&&!empty($_POST['password'])&&!empty($_POST['email'])){
				$dbID = $_SESSION['id'];
                $email=$_POST['email'];
                $passii=$_POST['password'];
				$pass=hash('sha256',$_POST['password']."Ibrqmov,Nenov");
				$name=$_POST['name'];
				$secName=$_POST['secName'];
				$lastName=$_POST['lastName'];
				////skildfjhgjlkdsfhgjlkdsfhglkjfdhsglkjsd
				$sql="UPDATE `users` SET 'id'='$idID',`e-mail`='$email',`pass`='$pass',`name`='$name',`secName`='$secName',`lastName`='$lastName'";
                $result = $conn->query($sql);
                unset($_SESSION['id']);
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                unset($_SESSION['name']);
                unset($_SESSION['secName']);
                unset($_SESSION['lastName']);
                $dbID++;
                $_SESSION['id']=$dbID;
                $_SESSION['email']=$email;
                $_SESSION['password']=$passii;
                $_SESSION['name']=$name;
                $_SESSION['secName']=$secName;
                $_SESSION['lastName']=$lastName;
				header("Location: Profile.php");
			}
		}
		else{
			header("Location: CHprofile.html");
		}
	?>