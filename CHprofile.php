<?php
	include 'profileCon.php';
	session_start();
    $conn=OpenCon();
		if(isset($_POST['photo'])){
			
		}
		else if(isset($_POST['save'])){
			if(!empty($_POST['name'])&&!empty($_POST['secName'])&&!empty($_POST['lastName'])&&!empty($_POST['password'])&&!empty($_POST['email'])){
				$mom=false;
        		if($mom == false){
					$dbID = $_SESSION['id'];
					$emailii=$_POST['email'];
					$email=hash('sha256',$_POST['email']."Ibrqm,Venci");
                	$passii=$_POST['password'];
					$pass=hash('sha256',$_POST['password']."Ibrqmov,Nenov");
					$name=$_POST['name'];
					$secName=$_POST['secName'];
					$lastName=$_POST['lastName'];
					if(strlen($passii)>=6){
						////skildfjhgjlkdsfhgjlkdsfhglkjfdhsglkjsd
					$sql="UPDATE `users` SET `e-mail`='$email',`pass`='$pass',`name`='$name',`secName`='$secName',`lastName`='$lastName' WHERE id=$dbID";
                	$result = $conn->query($sql);
                	unset($_SESSION['id']);
                	unset($_SESSION['email']);
                	unset($_SESSION['password']);
                	unset($_SESSION['name']);
                	unset($_SESSION['secName']);
                	unset($_SESSION['lastName']);
                	$dbID++;
                	$_SESSION['id']=$dbID;
                	$_SESSION['email']=$emailii;
                	$_SESSION['password']=$passii;
                	$_SESSION['name']=$name;
                	$_SESSION['secName']=$secName;
                	$_SESSION['lastName']=$lastName;
					header("Location: Profile.php");
					}
					else{
						header("Location: Profile.php");
					}
				}
				else{
					header("Location: CHprofile.html");
				}
			}
		}
		else{
			header("Location: CHprofile.html");
		}
	?>