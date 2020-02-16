<?php
	include 'profileCon.php';
	session_start();
    $conn=OpenCon();
		if(isset($_POST['photo'])){
			$idDB=$_SESSION['id'];
			$image=addslashes($_FILES['photo']['tmp_name']);
			$name=addcslashes($_FILES['image']['name']);
			$image= file_get_contents($image);
			$image=base64_encode($image);
			$sql="UPDATE `users` SET `id`='$dbID',`pic`='$image' WHERE 1";
			$result=mysqli_query($sql,$conn);
		}
		else if(isset($_POST['save'])){
			if(!empty($_POST['name'])&&!empty($_POST['secName'])&&!empty($_POST['lastName'])&&!empty($_POST['password'])&&!empty($_POST['email'])){
				$sql1="SELECT * FROM users";
      			$result = $conn->query($sql1);
      			$id = 0;
        		$mom = false;
        		while($id < $row=$result->num_rows){
          		$row = $result->fetch_assoc();
          		$bdEmail=$row['e-mail'];
          		if($email==$bdEmail){
              		$mom=true;
          		}
          		$id++;
        		}
        		if($mom == false){
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
				else{
					header("Location: CHprofile.html");
				}
			}
		}
		else{
			header("Location: CHprofile.html");
		}
	?>