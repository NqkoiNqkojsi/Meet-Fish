<?php
function New_Profile(){

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
	//header("Location:../index.php");
	//die();
}

function Check_Exist($name, $data){
	if($new_pr==false){
		$sql = "SELECT ".$name." FROM customer WHERE ".$name."='".$data."'";
		$result = mysqli_query($conn, $sql);
		if($result && mysqli_num_rows($result) == 1){//check if there is the same email
			$new_pr=true;
			$old_pr=false;
		}else{
			$old_pr=true;
		}
	}
}
?>