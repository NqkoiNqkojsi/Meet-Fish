<?php
include "conn.php";
$new_pr=false;
echo $new_pr;
$old_pr=false;
function New_Profile(){
	$sql = "SELECT NickName FROM customer WHERE NickName='".$_POST['nname']."'";
	$result = mysqli_query($conn, $sql);
	if($result && mysqli_num_rows($result) == 1){//check if there is the same nname
		$f=false;
		$gres=1;
		$messages="Има грешка с подадената информация!";
	}
	if (!preg_match("/[a-zA-Z0-9._-]{3,15}/", $_POST['nname'])) {
	    $f=false;
		$gres=3;
		$message2="Прякорът НЕ съотвества с Изискванията";
		$messages="Има грешка с подадената информация!";
	}
	if (!preg_match("/^\S*(?=\S{8,15})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $_POST['psw'])) {
	    $f=false;
		$gres=5;
		$message2="Паролата НЕ съотвества с Изискванията";
		$messages="Има грешка с подадената информация!";
	}else{
	    if($_POST["psw"]!=$_POST["psw-repeat"]){//check the passwords
		    $f=false;
		    $gres=6;
		    $messages="Паролите не си СЪОТВЕТСВАТ!";
	    }    
	}
	//****************************************************************************
    //*************************Hashing passwords***********************
    $timeTarget = 0.05; // 50 milliseconds 
    $cost = 8;
    do {
        $cost++;
        $start = microtime(true);
        $pwd=password_hash($_POST['psw'], PASSWORD_BCRYPT, ["cost" => $cost]);
        $end = microtime(true);
    } while (($end - $start) < $timeTarget);
	//**********Adding to DB************
	$plc=($_POST['place']-1);
	if($f==true){
	    $today=date("Y-m-d");
		$onemonth=new DateTime("now");
		$onemonth->modify("+1 month");
		$future_date=$onemonth->format('Y-m-d');
	    //***************************Binding & Excecuting************************
		try{
            $sql="INSERT INTO customer (ID, NickName, FName, SName, Email, Pass, Birth, Place, Ship, Exp, Description, "."Creation, Verified, Plan, Plan_End, Img_name, fb_access_token) "    ."VALUES (0, ?, ?, ?, ?, '".$pwd."', '".$_POST['birth']."', ".$plc.	", ?, 0, ?, '".$today."', 0, ".$_POST['submit'].", '".$future_date."', ?)";
            $stmt= $conn->prepare($sql);
            $stmt->bind_param("ssssssss", $_POST['nname'], $_SESSION['fb_user_info']["first_name"], $_SESSION['fb_user_info']["last_name"], $_SESSION['fb_user_info']["email"], $_POST['ship'], $_POST['Desc'], $save_path_sql, $_SESSION['fb_access_token']);
            $stmt->execute();
        }catch(Exception $e){
            console_log("Error: " . $e->getMessage());
        }
	    include "email_verify.php";//send email verification
		header("location:../index.php");
		die();
	    /*$resul = $stmt->get_result();
        $row = $resul->fetch_assoc();
		if ($row!==false) {
			include "email_verify.php";//send email verification
			header("location:../index.php");
			die();
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		*/
	}
}

function Old_Profile(){
	$sql = $conn->prepare("SELECT Email, ID, Pass, NickName, Place, Verified FROM customer WHERE Email=?");
	$sql->bind_param("s", $_SESSION['fb_user_info']["email"]);
	$sql->execute();
	$result = $sql->get_result();
	$row = $result->fetch_assoc();
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
	echo "Old profile got in nname:".$row["NickName"];
	//header("Location:../index.php");
	//die();
}

function Check_Exist($name, $data){
	$sql = "SELECT ".$name." FROM customer WHERE ".$name."='".$data."'";
	$result = mysqli_query($conn, $sql);
	if($result && mysqli_num_rows($result) == 1){//check if there is the same email
		$new_pr=true;
	}else{
		$old_pr=true;
		Old_Profile();
	}
}

if(isset($_POST["send3"])){
	New_Profile();
}
?>