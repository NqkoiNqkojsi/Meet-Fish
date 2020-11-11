<?php
$sql = "SELECT ID, Time FROM offer";//check the date times and free places of every offer
$result = mysqli_query($conn, $sql);
$delete_id=array();//every id of offer that needs to be deleted
$delete_peop=array();//every not verified date
$br=-1;
$br1=-1;
$now = new DateTime();
$izpishi = $now->format('Y-m-d H:i');
if ($result && mysqli_num_rows($result) > 0) {//look at the OFFERS
    while($row = mysqli_fetch_assoc($result)) {//cycle through ever offer 
        if($izpishi  > $row["Time"]){//Search for passed offers
			$br=$br+1;
			$delete_id[$br]=$row["ID"];
		}
    }
}
$sql = "SELECT ID, Creation FROM customer WHERE Verified=0";//check the date times and free places of every offer
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {//look at the CUSTOMERS
    while($row = mysqli_fetch_assoc($result)) {//cycle through ever customer who isnt verified 
        $time = new DateTime($row["Creation"]);
		date_modify($time,"+2 days");
		if($time<$now){
			$br1++;
			$delete_peop[$br1]=$row["ID"];
		}
    }
}
//Delete offers and people
foreach($delete_id as $a){
	$sql = "DELETE FROM offer WHERE id='".$a."'";//delete the useless offers
	$result = mysqli_query($conn, $sql);
}
foreach($delete_peop as $a){
	$sql = "DELETE FROM customer WHERE ID='".$a."'";//delete the unvalidated users
	$result = mysqli_query($conn, $sql);
}
//*************
//*************
//*************
if(!isset($_REQUEST["place"])){//get everything
    /*if(isset($_REQUEST["d1"]) && isset($_REQUEST["d2"])){
        $sql = "SELECT ID, Time, Place, Use_Boat, Prof FROM offer WHERE Free>0 AND Time>='".$d1."' AND Time<='".$d2."' ORDER BY Time ASC";//filter by date results
	    $result = mysqli_query($conn, $sql);
    }else{*/
	    $sql = "SELECT ID, Time, Place, Use_Boat, Prof FROM offer WHERE Free>0 ORDER BY Time ASC";//
	    $result = mysqli_query($conn, $sql);
    //}
}else {//get by place
    /*if(isset($_REQUEST["d1"]) && isset($_REQUEST["d2"])){
        $sql = "SELECT ID, Time, Place, Use_Boat, Prof FROM offer WHERE Free>0 AND Place='".$plc."' AND Time>='".$d1."' AND Time<='".$d2."' ORDER BY Time ASC";//filter by date and place results 
	    $result = mysqli_query($conn, $sql);
    }else{*/
	    $sql = "SELECT ID, Time, Place, Use_Boat, Prof FROM offer WHERE Free>0 AND Place='".$plc."' ORDER BY Time ASC";//get the offers only for specified places
	    $result = mysqli_query($conn, $sql);
    //}
}
?>