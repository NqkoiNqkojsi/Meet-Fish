<?php
include "conn.php";
include "towns.php";
$a;//a and b are for people taking up seats; a is for the offer
if(isset($_REQUEST["a"])){
	$a=$_REQUEST["a"];
}
$b;//b is for the user
if(isset($_REQUEST["b"])){
	$b=$_REQUEST["b"];
}
$c;//c and d is for the dropdown in nav; c checks if it's forward or backward move
if(isset($_REQUEST["c"])){
	$c=$_REQUEST["c"];
}
$d;//d shows from where to start
if(isset($_REQUEST["d"])){
	$d=$_REQUEST["d"];
}
$e;//id of offer to cancel
if(isset($_REQUEST["e"])){
	$e=$_REQUEST["e"];
}
$f;//id of the pearson who wants to cancel
if(isset($_REQUEST["f"])){
	$f=$_REQUEST["f"];
}
//*********************************************************************************************************************
//Functions
//**********************************************************************************************************************
//The Ajax functions
if(isset($_REQUEST["a"]) && isset($_REQUEST["b"])){//update the offer when someone participate
	$sql="SELECT ID, Free, Taken FROM offer WHERE ID=".$a;//make him appear in the offer
	$result =mysqli_query($conn, $sql);
	$row=mysqli_fetch_assoc($result);
	$row["Free"]--;
	if($row["Taken"]==null){
		$row["Taken"]=$b;
	}else{
		$row["Taken"]=$row["Taken"].",".$b;
	}
	$sql = "UPDATE offer SET Taken='".$row['Taken']."', Free=".$row['Free']." WHERE ID=".$a;
	if (mysqli_query($conn, $sql)) {//get the responseText
		echo "Record updated successfully<br>";
	} else {
		echo "Error updating record: " . mysqli_error($conn)."<br>";
	}
	$sql="SELECT ID, Attend, Exp FROM customer WHERE ID=".$b;//make the offer apear for the user
	$result =mysqli_query($conn, $sql);
	$row=mysqli_fetch_assoc($result);
	if($row["Attend"]==null){
		$row["Attend"]=$a;
	}else{
		$row["Attend"]=$row["Attend"].",".$a;
	}
	$row["Exp"]++;
	$sql = "UPDATE customer SET Attend='".$row['Attend']."', Exp=".$row["Exp"]." WHERE ID=".$b;
	if (mysqli_query($conn, $sql)) {//get the responseText
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error($conn);
	}	
}
//****************************************************************************************************************************
if(isset($_REQUEST["c"]) && isset($_REQUEST["d"])){// get the content for the places dropdown
	if($c==false){// if it's backward
		//$d=$d-4;
	}
	$send=$d.",".count($towns);//the starth of the response text with the first needed index and the array lenght
	for($loop=0;$loop<=4;$loop++){
		$send=$send.",".$towns[$loop+$d];//add the towns
	}
	echo $send;
}
//******************************************************************************************************************************
if(isset($_REQUEST["e"]) && isset($_REQUEST["f"])){//delete an appearance in offer
	$sql="SELECT ID, Taken, Sender, Free FROM offer WHERE ID=".$e;
	$result =mysqli_query($conn, $sql);
	$row=mysqli_fetch_assoc($result);
	$broj=0;
	$peop=Array();
	$offer=Array();
	$str="";
	$str1="";
	if($f==$row["Sender"]){//check if the sender wants to cancel
		$sql = "DELETE FROM offer WHERE ID=".$e;
		$result =mysqli_query($conn, $sql);
	}else{
		$token = strtok($row["Taken"], ",");//delete the pearson from the offer
		while ($token != false)
		{
			if($token!=$f){
				$peop[$broj]=$token;
				$broj++;
			}
			$token = strtok(",");
		}
		for($i=0;$i<$broj;$i++){//save it as a string
			if($i==0){
				$str=$peop[$i];
			}else{
				$str=",".$peop[$i];
			}
		}
		$row["Free"]=$row["Free"]+1;
		var_dump($str);
		var_dump($row["Free"]);
	}
	$sql="SELECT ID, Attend, Exp FROM customer WHERE ID=".$f;//get the list from offers that a pearson attends
	$result =mysqli_query($conn, $sql);
	$user=mysqli_fetch_assoc($result);
	$token = strtok($user["Attend"], ",");
	$broj=0;
	while ($token !== false)//get the sting to array
	{
		if($token!=$e){
			$offer[$broj]=$token;
			$broj++;
		}
		$token = strtok(",");
	}
	for($i=0;$i<$broj;$i++){//make the modified string
		if($i==0){
			$str1=$offer[$i];
		}else{
			$str1=",".$offer[$i];
		}
	}
	var_dump($str1);
	if($f==$row["Sender"]){
		$user["Exp"]-=5;
	}else{
		$user["Exp"]-=1;
	}
	$sql = "UPDATE offer SET Taken='".$str."', Free=".$row["Free"]." WHERE ID=".$e;
	if (mysqli_query($conn, $sql)) {//get the responseText
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error($conn);
	}
	$sql = "UPDATE customer SET Attend='".$str1."', Exp=".$user["Exp"]." WHERE ID=".$f;
	if (mysqli_query($conn, $sql)) {//get the responseText
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error($conn);
	}
}