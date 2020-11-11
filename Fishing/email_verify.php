<?php
$check=true;
$q;
if(isset($_REQUEST["q"])){
	$q=$_REQUEST["q"]/3-6;
}
if(isset($_REQUEST["q"])){
    include "conn.php";
    $sql = "SELECT Email, ID, FName, SName, NickName FROM customer WHERE ID=?";
	$stmt= $conn->prepare($sql);
	$stmt->bind_param("i", $q);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    var_dump($q);
    var_dump($row);
    //****************Hashing key*********************
    $timeTarget = 0.05; // 50 milliseconds 
    $cost = 15;
    $cod=password_hash($row["NickName"], PASSWORD_BCRYPT, ["cost" => $cost]);
	$to=$row["Email"];
    $subject="Подвърждаване на имейл";
    $message = "
    <html>
    <head>
    	<title>Подвърждаване на имейл</title>
    </head>
    <body>
    <img src='cid:logo' alt='Logo' style='width:256px;height:256px;'>
    <p>Здравейте ".$row["FName"].' "'.$row["NickName"].'" '.$row["SName"].", за да завършите регистрацията Отидете на:<b> 'https://meetandfish.online/Fishing/verify.php?a=".(($q*19+23)*3)."&key=".$cod."'</b></p>
    <p>Блогодарим ви за учстието!</p>
    </body>
    </html>
    ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $address=$to;
    $name=$row["NickName"];
    $link="https://meetandfish.online/Fishing/verify.php?a=".(($q*19+23)*3);
    $dir="";

    include "mail_starter.php";
}else{
    $id=mysqli_insert_id($conn);
    //****************Hashing key*********************
    $timeTarget = 0.05; // 50 milliseconds 
    $cost = 15;
    $hash=password_hash($_POST["nname"], PASSWORD_BCRYPT, ["cost" => $cost]);;
    $check=false;
    $to=$_POST["email"];
    $subject="Подвърждаване на имейл";
    $message = "
    <html>
    <head>
    	<title>Подвърждаване на имейл</title>
    </head>
    <body>
    <img src='cid:logo' alt='Logo' style='width:256px;height:256px;'>
    <p>Здравейте ".$_POST["fname"].' "'.$_POST["nname"].'" '.$_POST["sname"].", за да завършите регистрацията Отидете на:<b> 'https://meetandfish.online/Fishing/verify.php?a=".(($id*19+23)*3)."&key=".$hash."'</b></p>
    <p>Блогодарим ви за учстието!</p>
    </body>
    </html>
    ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $address=$to;
    $name=$_POST["nname"];
    $link="https://meetandfish.online/Fishing/verify.php?a=".(($id*19+23)*3);
    $dir="";

    include "mail_starter.php";

    $_SESSION["Verified"]=false;
    $_SESSION["Ver_id"]=$id;
    $plc=$plc;
}
?>