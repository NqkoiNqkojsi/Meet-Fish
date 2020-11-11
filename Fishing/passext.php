<?php
$id=0;
$id1=0;
$a;
$b;
if(isset($_REQUEST["id"])){
	$id=(($_REQUEST["id"]-7)/13+23)/19;
	$id1=$_REQUEST["id"];
}
if(isset($_REQUEST["key1"])){
	$a=$_REQUEST["key1"];
}
if(isset($_REQUEST["key2"])){
	$b=$_REQUEST["key2"];
}
$message="";
$mes=true;
if(isset($_POST["send1"])){
	$sql = "SELECT ID, Email, FName, SName, NickName FROM customer WHERE Email=?";//send mail for chanding password
	$stmt= $conn->prepare($sql);
	$stmt->bind_param("s", $_POST["email"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $row=$result->fetch_assoc();
    if($row["Email"]==$_POST["email"]) {
	    $cost = 12;
        $cod=password_hash($row["FName"], PASSWORD_BCRYPT, ["cost" => $cost]);
        $cost2 = 20;
        $hash=password_hash($row["SName"], PASSWORD_BCRYPT, ["cost" => $cost2]);
    	$to=$row["Email"];
    	$subject="Промяна на парола";
    	$nov_id=($row["ID"]*19-23)*13+7;
    	$message = "
    	<html>
    	<head>
    		<title>Промяна на парола</title>
    	</head>
    	<body>
    	<p>Здравейте ".$row["NickName"].", ако искате да си променете паролата: www.meetandfish.online/Fishing/Sign_Up.php?id=".$nov_id."&key1=".$cod."&key2=".$hash."'</p>
    	</body>
    	</html>
    	";

    	$headers = "MIME-Version: 1.0" . "\r\n";
    	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    	$headers .= 'From: <meet_and_fish@abv.bg>' . "\r\n";
    	$address=$row["Email"];
	    $name=$row["NickName"];
	    $link="www.meetandfish.online/Fishing/Sign_Up.php?id=".$nov_id;
	    $dir="";

	    include "mail_starter.php";
	}else{
	    $mes=false;
	    $message="Their is no account with this email";
	}
}else if(isset($_POST["send2"])){
	$sql = "SELECT Pass, NickName, Verified, SName, FName, ID, Place FROM customer WHERE ID=?";
    $stmt= $conn->prepare($sql);
	$stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if(password_verify($row["FName"], $a)&&password_verify($row["SName"], $b)){
	    if($_POST["NewPass"]==$_POST["RePass"]){
	         //*************************Hashing passwords***********************
	        $pwd;
            $timeTarget = 0.05; // 50 milliseconds 
            $cost = 8;
            do {
                $cost++;
                $start = microtime(true);
                $pwd=password_hash($_POST['psw'], PASSWORD_BCRYPT, ["cost" => $cost]);
                $end = microtime(true);
            } while (($end - $start) < $timeTarget);
            //**********************Bind & Set*********************************
		    $sql = "UPDATE customer SET Pass=? WHERE ID=?";//sql for password
		    $stmt= $conn->prepare($sql);
		    $stmt->bind_param("si", $pwd, $id);
	        $stmt->execute();
	    	if($row["Verified"]==true){
		    	$_SESSION["user_ID"]=$row["ID"];
			    $_SESSION["user_Nname"]=$row["NickName"];
		    	$_SESSION["user_Plc"]=$row["Place"];
		    	$_SESSION["Verified"]=true;
			    $_SESSION["Ver_id"]=$row["ID"];
		    }else{
			    $_SESSION["Verified"]=false;
			    $_SESSION["Ver_id"]=$row["ID"];
		    }
		    header("Location:../index.php");
		    die();
	    }else{
	        $mes=false;
	        $message="The password is invalid";
	    }
    }else{
        $mes=false;
	    $message="Не се опитвай да сменяш на хората паролите, нехранимайко!"; 
    }
}
?>