<?php
session_start();
include "conn.php";
$a=0;
$b;
if(isset($_REQUEST["a"])){//get the id of the pearson
	$a=$_REQUEST["a"];
	$a=($a/3-23)/19;
}
if(isset($_REQUEST["key"])){
	$b=$_REQUEST["key"];
}
//***************Select statements*************************
$sql="SELECT ID, NickName, Place FROM customer WHERE ID=?";
$stmt= $conn->prepare($sql);
$stmt->bind_param("i", $a);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if(password_verify($row["NickName"], $b)){
//**************Update statements*********************
    $sql = "UPDATE customer SET Verified=1 WHERE ID=?";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("i", $a);
    $stmt->execute();
    $_SESSION["user_ID"]=$a;
    $_SESSION["user_Nname"]=$row["NickName"];
    $_SESSION["user_Plc"]=$row["Place"];
    $_SESSION["Verified"]=true;
    header("Location: ../index.php");
    die();
}else{
    echo "There is a problem! Please, try again later.";
}
//header("Location: ../index.php");
//die();
?>