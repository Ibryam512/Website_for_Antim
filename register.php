<?php
//свързвеаме се с базата данни
include 'profileCon.php';
$conn=OpenCon();

//взимаме хешираните данни напортебителя
$email=hash('sha256',$_POST['email']."Ibrqm,Venci");
$password=hash('sha256',$_POST['password']."Ibrqmov,Nenov");

//взимаме именат на потребителя
$name=$_POST['name'];
$secName=$_POST['secName'];
$lastName=$_POST['lastName'];

//проверяваме дали са попълнени полетата
if(isset($email)&&isset($password)&&isset($name)&&isset($secName)&&isset($lastName)){

    //при евентуална грешка при връзката с базата данни
    if($conn->connect_error){
        die('Conn failed !!!! '.$conn->connect_error);
    }

        //подсигуряваме се дали вече няма създаден профил с този имейл
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


        // ако не е бил използван този профил
        if($mom == false){

            //добавяме портребитеял в базата данни
            $sql="INSERT INTO `users`(`e-mail`, `pass`, `name`, `secName`, `lastName`) VALUES ('$email','$password','$name','$secName','$lastName')";
            $result = $conn->query($sql);
			$id = $conn->insert_id;

            $emailii=$_POST['email'];
            $passii=$_POST['password'];
            session_start();
			//$_SESSION['ID'] = $id;
            $_SESSION['email']=$emailii;
            $_SESSION['password']=$passii;
            $_SESSION['name']=$name;
            $_SESSION['secName']=$secName;
            $_SESSION['lastName']=$lastName;

            //препращаме потребителя към току-що създаеният му профил
            header("Location: Profile.php");
            exit();
        }
}
?>