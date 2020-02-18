<?php
	//свъзваме се с базата данни
	include 'profileCon.php';
	session_start();
	$conn=OpenCon();
	
		//ако са кликнали бутона за запазване
		if(isset($_POST['save'])){


			$email=hash('sha256',$_SESSION['email']."Ibrqm,Venci");
			$password=hash('sha256',$_SESSION['password']."Ibrqmov,Nenov");
			
			//взимаме id-то на вече влезналия в профила си портребител
        	$sql="SELECT * FROM users";
        	$result = $conn->query($sql);
			$int = 0;
			$dbID;
        	while($int < $row=$result->num_rows){
          		$row = $result->fetch_assoc();
          		$dbEmail = $row['e-mail'];
          		$dbPassword = $row['pass'];
          		if($dbEmail === $email  &&  $dbPassword === $password){
					$dbID=$row['id'];
			  	}
          		$int++;
			}	
			
			
				$emailii=$_POST['email'];
				$passii=$_POST['password'];
				$name=$_POST['name'];
				$secName=$_POST['secName'];
				$lastName=$_POST['lastName'];

				// взимаме данните от профилната му снимка
				$image = $_FILES["item_photo"]["tmp_name"];
				$imgContent = addslashes(file_get_contents($image));

			// ако е избрал снимка 
			if(empty($image)){
				//дали са попълнени полетата
				if(!empty($_POST['name'])&&!empty($_POST['secName'])&&!empty($_POST['lastName'])&&!empty($_POST['password'])&&!empty($_POST['email'])){
						
						if(strlen($passii)>=6){
						$sql="UPDATE `users` SET `e-mail`='$email',`pass`='$password',`name`='$name',`secName`='$secName',`lastName`='$lastName' WHERE id=$dbID";
						$result = $conn->query($sql);
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
				//дали са попълнени полетата->ние рябва да сменим и снимката и данните към профила му
				if(!empty($_POST['name'])&&!empty($_POST['secName'])&&!empty($_POST['lastName'])&&!empty($_POST['password'])&&!empty($_POST['email'])){
					// i devete
				}
				// трябва да сменим само снимката на профила
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