<?php

$useragent=$_SERVER['HTTP_USER_AGENT'];

if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{
header('Location: mobile/index.php');
}
else{
    header('Location: desktop/index.php');
}
?>
<?php
session_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		
		<meta name="keywords" content="Antim I, Antim">
		<meta name="autors" content="Ibryam Ibryamov, Ventsislav Nenov">
		<title>Сергия</title>
		<link rel="icon" href="desktop/pic/LOGO.png">
		<link rel="stylesheet" href="desktop/css/style.css">
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<script src="js/jquery.js"></script>
		<script src="js/materialize.js"></script>
		<script src="js/script.js"></script>
	</head>
	<body>
	    
		<div id="menu">
			<ul>
			<ul id="dropdown1" class="dropdown-content">
					<li><a href="desktop/Profile.php">Профил</a></li>
					<li class="divider"></li>
					<li><a href="desktop/my_items.php">Мои обяви</a></li>
			</ul>
			<?php
            	
            	if(!empty($_SESSION['image'])){
                	$i=$_SESSION['image'];
                	$l="pic/PROF/".$i;
                	echo "<div class='nav-wrapper'><il id='options'><a class='dropdown-trigger' href='desktop/Profile.php' data-target='dropdown1'><button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'><img style='border-radius: 5000px;' src='$l'height='44' width='44'></button></a></il></div>";
            	}
            	else{
                	echo "<div class='nav-wrapper'><il id='options'><a class='dropdown-trigger' href='desktop/Profile.php' data-target='dropdown1'><button style='border-radius: 5000px;cursor: pointer;background-color:initial;border: initial;'><img style='border-radius: 5000px;' src='pic/profilePic.png'height='44' width='44'></button></a></il></div>";
            	}
        		?> 
				
				
				<li id="options"><a href="desktop/team.php">За нас</a></li>
				<li id="options"><a href="desktop/questions.php">Въпроси</a></li>
				<li id="options"><a href="desktop/messages.php">Съобщения</a></li>
				<li id="options"><a href="desktop/lost_things.php">Изгубени вещи</a></li>
				<li id="options"><a style="background-color: white;" href="desktop/index.php">Сергия</a></li>
				<li id="options" title="Добави"><a class="btn-floating btn-medium waves-effect waves-light blue pulse" href="desktop/add.php" style="margin-top: 10%;"><i class="material-icons">+</i></a></li>
				<li id="image"><img src="desktop/pic/image.png" height="45" width="45"></li>
			</ul>
		</div>
		<div id="search">
			<form  method="post" action="index.php"> 
				<div class="input-field col s12 " style="background-color: white;">
                  <input style="text-align: center;" placeholder="Търси" name="search" id="search" type="text" class="validate">
                </div>
				<button class="btn waves-effect waves-light" type="submit" name="submit">Търси</button>
			</form> 
		</div>
		<table width="100%" height="100%">
			<?php
				//включваме файлът за връзка с базата данни
				include 'desktop/connect.php';
				//функция за търсене на постове
				function Search()
				{
					//отваряме връзка
					$conn = OpenCon();
					//прожеряваме дали трябва да покажем всичко или само част от обявите
					if(isset($_POST["search"])){
					    //само някой ще се покажат
					    $search = strtolower($_POST["search"]);
					    $F="'%";
					    $E="%'";
					    $pos=strpos($search,$F);
					    $pos2=strpos($search,$E);
					    if($pos !== false || $pos2 !== false)
					    {
					        echo"Няма намерени резултати";
					        return;
					    }
					}
					else{
					    //всички ще се покажат
					    $search = "";
					}
					//изпълняваме заявка
					$sql = "SELECT * FROM items
							LEFT JOIN images
							ON items.imageID = images.ID
							WHERE LOWER(title) LIKE '%$search%'";
					$result = $conn->query($sql);
					$smth = 0;
    					//извеждаме нужната информация
    					while($row = $result->fetch_assoc())
    					{
    						$title = $row["title"];
    						$desc = $row["description"];
    						$image = $row["image"];
    						$price=$row['price'];
    						$id = $row["IID"];
    						if($smth % 2 == 0)
    						{
    							echo"<tr>
    									<td width='50%'><div id='post' class='card' style='max-width:700;' >
    									<div class='card-image waves-effect waves-block waves-light'>
    										<a href='desktop/detail.php?item=$id' title='Пълен размер'><img style='max-height:500;' src='data:image/jpeg;base64,".base64_encode($image)."' class='img-thumnail' /></a>
    									</div>
    									<div class='card-content'style='background-color: white;'>
    										<span class='card-title activator grey-text text-darken-4'>$title<i class='material-icons right'>$price лв.</i></span>
    									</div>
    									<div class='card-reveal'>
    										<span class='card-title grey-text text-darken-4'>$title<i class='material-icons right'>затвори</i></span>
    										<p>$desc</p>
    									</div></td>";
    							$smth++;		
    						}
    						else
    						{
    							echo"<td width='50%'><div id='post' class='card' style='max-width:700;'>
    									<div class='card-image waves-effect waves-block waves-light'>
    										<a href='desktop/detail.php?item=$id' title='Пълен размер'><img style='max-height:500' src='data:image/jpeg;base64,".base64_encode($image)."' class='img-thumnail' /></a>
    									</div>
    									<div class='card-content'style='background-color: white;'>
    										<span class='card-title activator grey-text text-darken-4'>$title<i class='material-icons right'>$price лв.</i></span>
    									</div>
    									<div class='card-reveal'>
    										<span class='card-title grey-text text-darken-4'>$title<i class='material-icons right'>затвори</i></span>
    										<p>$desc</p>
    									</div></td></tr>";
    							$smth++;
    						}
    					}
					if($smth == 1){
					    echo"<td width='50%'></td>";
					}
					else if($smth==0)
					{
					    echo"Няма намерени резултати";
					    return;
					}
				}
				Search();
			?>
		</table>
	</body>
</html>