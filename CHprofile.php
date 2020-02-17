<?php
	include 'profileCon.php';
	session_start();
    $conn=OpenCon();
		if(isset($_POST['save'])){
						$dbID = $_SESSION['id'];
						$emailii=$_POST['email'];
						$email=hash('sha256',$_POST['email']."Ibrqm,Venci");
						$passii=$_POST['password'];
						$pass=hash('sha256',$_POST['password']."Ibrqmov,Nenov");
						$name=$_POST['name'];
						$secName=$_POST['secName'];
						$lastName=$_POST['lastName'];
						$image = $_FILES["item_photo"]["tmp_name"];
						$imgContent = addslashes(file_get_contents($image));
			if(empty($image)){

				if(!empty($_POST['name'])&&!empty($_POST['secName'])&&!empty($_POST['lastName'])&&!empty($_POST['password'])&&!empty($_POST['email'])){
						
						if(strlen($passii)>=6){
						$sql="UPDATE `users` SET `e-mail`='$email',`pass`='$pass',`name`='$name',`secName`='$secName',`lastName`='$lastName' WHERE id=$dbID";
						$result = $conn->query($sql);
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
			}
			else{
				if(!empty($_POST['name'])&&!empty($_POST['secName'])&&!empty($_POST['lastName'])&&!empty($_POST['password'])&&!empty($_POST['email'])){
					// i devete
				}
				else{
					$sql="UPDATE 'users' SET 'pic'=$image WHERE id=$dbID";
					$result=$conn->query($sql);
					header("Location: Profile.php");
				}
			}	
		}
		else{
			header("Location: CHprofile.html");
		}
	?>