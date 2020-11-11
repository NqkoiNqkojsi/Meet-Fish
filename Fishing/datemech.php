<?php
if(isset($_POST["filter"])){
    //compare the dates
    $d1=$_POST["date"];
    $d2=$_POST["date1"];
    $sw="";
    if($d1>$d2){
        $sw=$d1;
        $d1=$d2;
        $d2=$sw;
    }
    //make a link
    $sent=$_SERVER['PHP_SELF']."?";
    if(isset($_REQUEST["place"])){
	    $sent=$sent."place=".$plc."&";
    }
    $sent=$sent."d1=".$d1."&d2=".$d2;
    //go to the link
    header('location: ' .$sent);
}
function FiltDate($a){
    
}
?>