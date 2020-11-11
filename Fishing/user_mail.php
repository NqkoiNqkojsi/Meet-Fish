<?php
//*************functions***********
function GetReceiver($id, $conn, $row){
	$token = strtok($row, ",");
	$names="no";
	$numb=0;
	while ($token !== false)
	{
	    if($numb==$id){
		    $names=GetName($token, $conn);
	    }
	    $numb++;
		$token = strtok(",");
	}
	return $names;	
}
function GetEmail($name, $conn){
	$sql = "SELECT ID, NickName, Email FROM customer WHERE NickName='".$name."'";//get the info of the the sender of the offer
	$result= mysqli_query($conn, $sql);
	$goer=mysqli_fetch_assoc($result);//second db	
	return $goer["Email"];
}
//**********************Sending emails***************************
if(isset($_POST["izprati1"])){
    //************Sending to sender**********************
    $to=$sender["Email"];
    $writer=$_SESSION["user_Nname"];
    $subject="Съобщение от ".$writer;
    $message = "
    <html>
    <head>
    	<title>Съобщение от ".$writer."</title>
    </head>
    <body>
    <img src='cid:logo' alt='Logo' style='width:256px;height:256px;'>
    <p>Получили сте писмо от ".$writer.", който се е записал във вашата оферта на ".$used_time.".<br></p>
    <p>То гласи:<br><br>'".$_POST["email"]."'<br><br></p>
    <p>Ако искате да отговорите на ".$writer." отидете на:'https://meetandfish.online/Fishing/offer.php?id=".$row["ID"]."' и на пишете писмо на правилния човек, изпратете го и те щего получат.</p>
    </body>
    </html>
    ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $address=$to;
    $link="Получили сте писмо от ".$writer.", който се е записал във вашата оферта на ".$used_time."; 
    То гласи:".'"$_POST["email"]"
    '."Ако искате да отговорите на ".$writer." отидете на:'https://meetandfish.online/Fishing/offer.php?id=".$row["ID"]."' и на пишете писмо на правилния човек, изпратете го и те щего получат.";
    $name=$sender["NickName"];
    $dir="";

    include "mail_starter.php";   
}else if(isset($_POST["izprati2"])){
    //************Sending to participant**********************
    $ime=$_POST["name"];
    $to=GetEmail($ime, $conn);
    $writer=$sender["NickName"];
    $subject="Съобщение от ".$writer;
    $message = "
    <html>
    <head>
    	<title>Съобщение от ".$writer."</title>
    </head>
    <body>
    <img src='cid:logo' alt='Logo' style='width:256px;height:256px;'>
    <p>Получили сте писмо от ".$writer.", който се е записал във вашата оферта на ".$used_time.".<br></p>
    <p>То гласи:<br><br>'".$_POST["email"]."'<br><br></p>
    <p>Ако искате да отговорите на ".$writer." отидете на:'https://meetandfish.online/Fishing/offer.php?id=".$row["ID"]."' и на пишете писмо на правилния човек, изпратете го и те щего получат.</p>
    </body>
    </html>
    ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $address=$to;
    $link="Получили сте писмо от ".$writer.", който се е записал във вашата оферта на ".$used_time."; 
    То гласи:".'"$_POST["email"]"
    '."Ако искате да отговорите на ".$writer." отидете на:'https://meetandfish.online/Fishing/offer.php?id=".$row["ID"]."' и на пишете писмо на правилния човек, изпратете го и те щего получат.";
    $name=$ime;
    $dir="";

    include "mail_starter.php";
}else{
    if(isset($_SESSION["user_ID"])){
        if($check_acc==true){
//*********************DIV Forums*********************
?>
<button class="open-button" onclick="openForm('emailForm')">Изпрати имейл на организителя</button>
<div class="form-popup" id="emailForm">
  <form action="offer.php?id=<?php echo $offer; ?>" class="form-container" method="post">
    <h4>Напиши имейл на <?php echo $sender["FName"].' "'.$sender["NickName"].'" '.$sender["SName"]; ?></h4>
    <textarea id="email" name="email" placeholder="Пишете тук.." style="height:300px"></textarea>
    <button type="submit" name="izprati1" class="btn">Изпрати</button>
    <button class="btn cancel" onclick="closeForm('emailForm')">Затвори</button>
  </form>
</div>
<?php        
        }else if($_SESSION["user_ID"]==$row["Sender"]){
?>
<button class="open-button" onclick="openForm('emailForm')">Изпрати имейл на някой участник</button>
<div class="form-popup" id="emailForm">
  <form action="offer.php?id=<?php echo $offer; ?>" class="form-container" method="post">
    <h4>Напиши имейл на </h4>
    <select name="name" required>
    <?php
        $br=0;
	    while(GetReceiver($br, $conn, $row["Taken"])!="no"){
	        $izp=GetReceiver($br, $conn, $row["Taken"]);
	 ?>
	    <option value="<?php echo $izp;?>"><?php echo $izp; ?></option>
    <?php
            $br=$br+1;
        }
    ?>
    </select>
    <textarea id="email" name="email" placeholder="Пишете тук.." style="height:300px"></textarea>
    <button type="submit" name="izprati2" class="btn">Изпрати</button>
    <button class="btn cancel" onclick="closeForm('emailForm')">Затвори</button>
  </form>
</div>
<?php
        }
    }
}
?>