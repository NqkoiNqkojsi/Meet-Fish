<?php
$sql = "SELECT ID, Time, Sender, Taken FROM offer WHERE Notice=0";//check the date times and free places of every offer
$result = mysqli_query($conn, $sql);
$send=array();
$br2=0;
if ($result && mysqli_num_rows($result) > 0) {//look at the OFFERS
    while($row = mysqli_fetch_assoc($result)) {//cycle through ever offer
        $time = new DateTime($row["Time"]);
		date_modify($time,"-1 days");
		if($time<$now){
            $send[$br2]=array($row["Sender"], $row["ID"]);//get the sender
	    	if($row["Taken"]!=null || $row["Taken"]!=""){
		    	$token = strtok($row["Taken"], ",");//get everyone who attends
		        $broj=1;
		    	while ($token != false)
		    	{
		    		if($token!=$f){
		    		$send[$broj+$br2]=array($token, $row["ID"]);
		    		$broj++;
		    		}
		    		$token = strtok(",");
		    	}
		    	$br2+=$broj+1;
	    	}   
		}
		$sql="UPDATE offer SET Notice=1 WHERE ID=".$row["ID"];
		mysqli_query($conn, $sql);
    }
}
//********************************************email***************************************************************
foreach($send as $a){
	$sql = "SELECT ID, Email, NickName, FName, SName FROM customer WHERE ID=".$a[0];//check the date times and free places of every offer
	$result = mysqli_query($conn, $sql);
	$row=mysqli_fetch_assoc($result);
	$to=$row["Email"];
	$subject="Утре за Риба";
	$message = "
	<html>
	<head>
		<title>Утре за Риба</title>
	</head>
	<body>
	<img src='cid:logo' alt='Logo' style='width:256px;height:256px;'>
	<p>Здравейте ".$row["FName"].' "'.$row["NickName"].'" '.$row["SName"].", напомняме ви, че до един ден ще се проведе ходенето за риба на адрес:'meetandfish.online/Fishing/offer.php?id=".$a[1]."'</p><br>
	</body>
	</html>
	";

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <meet_and_fish@abv.bg>' . "\r\n";
$address=$row["Email"];
	$name=$row["NickName"];
	$link="meetandfish.online/Fishing/offer.php?id=".$a[1];
	$dir="Fishing/";

	include "mail_starter.php";
}
?>