<?php
// Start the session
session_start();
include "logging.php";
$f=false;
$g=true;
$mess="Nothing";
include "towns.php";
include "conn.php";
if(isset($_SESSION["user_ID"])){/*Stop user who haven't signed in*/
	if(isset($_POST["submit"])){
		$g="TRUE";
		$h="TRUE";
		if(!isset($_POST["boat"])){/*Get the checkbox-boat value*/
			$g="FALSE";
			$_POST["boat_num"]="";
			$mess=$mess." Nqma lodka;";
		}else{
		    if(!$_POST["boat"]=="yes"){
		        $g="FALSE";
			    $_POST["boat_num"]="";
		    	$mess=$mess." Nqma lodka;";
		    }
		}
		if(!isset($_POST["prof"])){/*Get the checkbox-prof value*/
			$h="FALSE";
		}else{
		    if(!$_POST["prof"]=="yes"){
		        $h="FALSE";
		    }
		}
		$f=true;
		if($f==true){/*make the query*/
			$chng1=hndlcms($_POST['loc'], true);
			$chng2=hndlcms($_POST['info'], true);
			$place=intval($_POST['place'])-1;
			$last_id;
			$sql = "INSERT INTO offer (ID, Sender, Time, Place, Location, Info, Use_Boat, Ship, Free, Prof) ".
				"VALUES (0, ".$_SESSION["user_ID"].", '".$_POST['time']."', ".$place.", '".
				$chng1."', '".$chng2."', ".$g.", '".strip_tags($_POST['boat_num'])."', ".$_POST['seat'].", ".$h.")";
			if (mysqli_query($conn, $sql)) {
				$last_id=mysqli_insert_id($conn);
			} else {
				$mess=$mess."<br>". "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			$mess=$mess."<br>".$sql;
			$sql="SELECT ID, Exp, Attend FROM customer WHERE ID=".$_SESSION["user_ID"];
			$result =mysqli_query($conn, $sql);
			$row=mysqli_fetch_assoc($result);
			$row["Exp"]+=5;//go up the Exp
			if($row["Attend"]==null){
				$row["Attend"]=$last_id;
			}else{
				$row["Attend"]=$row["Attend"].",".$last_id;
			}
			$sql = "UPDATE customer SET Exp=".$row['Exp'].", Attend='".$row["Attend"]."' WHERE ID=".$_SESSION["user_ID"];
			console_log($sql);
			if (mysqli_query($conn, $sql)) {
				//header("Location: ../index.php");
				//die();
				$sql=$sql.";  izprashta"
				console_log( $sql );
			} else {
				echo "Error updating record: " . mysqli_error($conn);
			}
		}else{/*Show a error message if the submit is incorrect*/
	        $mess="Има някаква грешката с твойта оферта!";
	        $g=false;
		}
	}
}
?>
<html>
<head>
	<title>Offer Maker</title>
	<link rel="stylesheet" href="CSS/maker_style.css">
<?php 
include "navbar.php";
?>
	</div>
	<br>
<?php
if(!isset($_SESSION["user_ID"])){/*Stop user who haven't signed in*/
?>
	<h1 style="color:#E85A4F;">Моля запишете се или влезте в профила си за да пуснете оферта</h1>
	<button class="button" onclick="window.location.replace('/Fishing/Sign_Up.php');">Запешете се/Влезте в профила си</button>
<?php
}else{
?>
	<h2>Попълнете формата за да пусните оферта</h2>
<?php
    if($g==false){
?>
    <h3 style="color:#E85A4F;"><?php echo $mess; ?></h3>
<?php } ?>    
	<form action="/Fishing/offer_maker.php" method="post">
	<div class="row">
		<div class="col-25">
			<label for="time">Кога ще ходите за риба?</label>
		</div>
		<div class="col-75">
		    <?php include "datefilter.php"; ?>
		</div>
	</div>
		
	<div class="row">
		<div class="col-25">
			<label for="place">Кой е най-близкият град/село</label>
		</div>
		<div class="col-75">
			<select style="width: 22%; float: left;" name="place" required>
			<?php
			foreach($towns as $town){
				$br=$br+1;
			?>
				<option value="<?php echo $br;?>"><?php echo $town; ?></option>
			<?php
			}
			?>
			</select><br>
		</div>
	</div>
		
	<div class="row">
		<div class="col-25">
			<label for="loc">Обяснете къде е локация</label>
		</div>
		<div class="col-75">
			<textarea id="loc" name="loc" placeholder="Напиши локацията.." style="height:200px" required></textarea>
		</div>
	</div>
		
	<div class="row">
		<div class="col-25">
			<label for="info">Дайте информция</label>
		</div>
		<div class="col-75">
			<textarea id="info" name="info" placeholder="Напишите свойта информация.." style="height:200px"></textarea>
		</div>
	</div>
	<div id="coll">
		<div class="row">	
			<div class="col-25">
				<label for="boat_num" class="collapsible">Номера на лодката</label>
			</div>
			<div class="col-75">
				<input class="collapsible" style="width: 20%; float: left;" type="text" id="boat_num" name="boat_num" placeholder="Номера на твойта лодка..">
			</div>
		</div>
	</div>
		
	<div class="row">
		<div class="col-25">
			<label for="boat">Имате ли лодка?:</label>
		</div>
		<div class="col-75">
			<input type="checkbox" style="float: left;" id="Check" name="boat" value="yes" onclick="Collapse()"><br>
		</div>
	</div>
		
	<div class="row">
		<div class="col-25">
			<label for="prof">Ще бъде ли професионално ходене?:</label>
		</div>
		<div class="col-75">
			<input type="checkbox" style="float: left;" id="Check1" name="prof" value="no"><br>
		</div>
	</div>
	
	<div class="row">	
		<div class="col-25">
			<label for="seat">Колко хора могат да дойдат с вас?</label>
		</div>
		<div class="col-75">
			<input type="number" style="float: left;" name="seat" required>
		</div>
	</div>
	
		<button type="submit" class="typeBtn2" name="submit" value="Submit">Запиши</button>
		<script src="JS/collapse.js"></script>
	</form>
	</div>
	<br><br>
<?php
}
?>
    <?php
	    include "footer.php";
	?>
    <script>
		function SendCust(){
			window.location.replace("/Sign_Up.php");
		}
	</script>
	<script src="JS/scroll.js"></script>
	<script src="JS/data_picker.js"></script>
</body>
</html>