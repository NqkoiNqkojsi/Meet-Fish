<?php
session_start();
$offer=0;
$message="echo";
if(isset($_REQUEST["id"])){
	$offer=$_REQUEST["id"];
}
include "towns.php";
include "conn.php";
$sql = "SELECT * FROM offer WHERE ID=".$offer;//get the asked offer
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);//first db;
$sql = "SELECT ID, NickName, FName, SName, Birth, Exp, Email, Description FROM customer WHERE ID=".$row["Sender"];//get the info of the the sender of the offer
$result = mysqli_query($conn, $sql);
$sender=mysqli_fetch_assoc($result);//second db
$date = new DateTime($sender['Birth']);
$time= new Datetime($row["Time"]);
$interval = date_diff(new DateTime(), $date);//get the diffrence between now and the time of birth
$age=$interval->format('%y');
$used_time=date_format($time, 'd.m в H:i');
$dop=$row["Place"];
$chng1=hndlcms($row['Location'], false);//format the two text strings
$chng2=hndlcms($row['Info'], false);
//Check if the pearson is already in_array
$check_acc=false;
$token = strtok($row["Taken"], ",");
if(isset($_SESSION["user_ID"])){
	while ($token !== false)
	{
		if($token==$_SESSION["user_ID"]){
			$check_acc=true;
			break;
		}
		$token = strtok(" ");
	}
}
function GetName($part, $why){//Go to db to get the name of the participants
	$sql = "SELECT ID, NickName FROM customer WHERE ID=".$part;//get the info of the the sender of the offer
	$result= mysqli_query($why, $sql);
	$goer=mysqli_fetch_assoc($result);//second db	
	return $goer["NickName"];	
}
function GetAllNames($need1, $need2, $why){
	$token = strtok($need1, ",");
	$names=$need2;
	while ($token !== false)
	{
		$names=$names.", ".GetName($token, $why);
		$token = strtok(",");
	}
	return $names;	
}
?>
<html>
<head>
	<title>Offer on <?php echo date_format($row["Time"], "d.m");?> </title>
	<link rel="stylesheet" href="CSS/form.css">
<?php 
	include "navbar.php";
?>
	</div>
	<br><br>
	<div class="containerut">
			<h3>На <span><?php echo $used_time;?></span> ще се проведе споделен риболов.</h3><br>
		<br>
			<div style="display:inline;"><h4>Организирано от <div class="tooltipa"><b><?php echo $sender["FName"].' "'.$sender["NickName"].'" '.$sender["SName"];?></b><span class="tooltiptexta"><?php echo $age."год., Опит:".$sender["Exp"]."т., ".$sender["Description"];?></span></div>.</h4></div><br>
		<br>
			<h4 style="display: inline;">Ще бъде в околността на <?php echo $towns[intval($row["Place"])]; ?> и <?php echo $sender["NickName"];?> опредили мястото на срещата:</h4>
			<?php
			$f=false;
			if(isset($_SESSION["user_ID"])){
				if($check_acc==false && $_SESSION["user_ID"]!=$row["Sender"]){//check if it the customer is in and show the location
				    $f=false;
				}else{
				    $f=true;
			?>
			<button id="ModalBtn1" class="typeBtn1">Покажи</button>
			<!-- The Modal -->
			<div id="Modal1" class="modala">
			<!-- Modal content -->
				<div class="modal-contenta">
					<span class="close">&times;</span>
					<h5><?php echo $row["Location"]; ?></h5>
				</div>
			</div>
			<?php
				}
			}
			if($f==false){
			?>
			<h3>Първо заяви участвате</h3>
		<?php } ?>
		<br><br>
		<?php
			if($row["Use_Boat"]==true){
		?>
		<h4>Ще бъде с лодка, чиито номер е "<?php echo $row["Ship"];?>"</h4><!--Show the boat info-->
		<?php
			}else{
		?>
		<h4>Ще бъде<b> без</b> лодка</h4>
		<?php
			}
		?><br>
		<h5><b>Повече информация: </b><?php echo $chng2;?></h5>
		<?php
			if(isset($_SESSION["user_ID"])){
				if($check_acc==false && $_SESSION["user_ID"]!=$row["Sender"] ){
		?>
		<button onclick="Join()">Присъединете се към рибарсвото</button><!--Add Ajax-->
		<script>
			function Join(){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						window.location.replace('offer.php?id='+<?php echo $offer;?>);
					}
				};
				xmlhttp.open("GET", "ajax_to_db.php?a=" + <?php echo $offer;?>+"&b="+<?php echo $_SESSION["user_ID"];?>, true);
				xmlhttp.send();
			}
			
		</script>
		<?php
				}else{
		?>
		<br>
		<h2 color="red">Вече сте регистриран</h2>
		<?php
				}
			}else{
		?>
		<br>
		<h2 style="color:#E85A4F;">Трябва да сте регистриран за да участвате</h2>
		<?php
			}
		?>
		<br>
		<h4>Има:<?php echo $row["Free"];?> места; Ще бъдеш присъединен от <?php echo GetAllNames($row["Taken"], $sender["NickName"], $conn);?></h4>
		<?php 
		    include "user_mail.php";
		?>
	</div><br><br>
	<script src="JS/scroll.js"></script>
	<script src="JS/modal1.js"></script>
	<script src="JS/collapse.js"></script>
</body>
</html>