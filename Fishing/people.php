<?php
session_start();
include "logging.php";
include "conn.php";
include "towns.php";
$id=0;
if(isset($_REQUEST["id"])){
	$id=$_REQUEST["id"];
}else{
	header("location:profile.php");
    die();
}
if(isset($_SESSION["user_ID"])){
	if($_SESSION["user_ID"]==$id){
		header("location:profile.php");
		die();
	}
}
$sql="SELECT * FROM customer WHERE ID=".$id;//get the db
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
//Checking User Data
$save_path="Img/User_Img/".$row["Img_name"];
if (!file_exists($save_path)) {
	$save_path="Img/FB_Img/user.png";
}

?>
<html>
<head>
    <title>Meet & Fish</title>
	<style>
		.Img_Cont {
			position: relative;
			width: 100%;
			height: 300px;
		}

		.Img_In1 {
			max-height: 95%;
			max-width: 95%;
			width: auto;
			height: auto;
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			margin: auto;
		}
	</style>
<?php 
	include "navbar.php";
?>
    </div>
	<br><br>
    <div class="containerut">  
        <h1><?php echo  $row["FName"].' "'.$row["NickName"].'" '.$row["SName"];?></h1>
		<div class="Img_Cont">
			<a target="_blank" href=<?php echo $save_path;?>>
				<img src=<?php echo $save_path;?> class="Img_In1" alt="Thubnail images">
			</a>
		</div>
		<h3><?php echo  "Те имат: ".$row["Exp"]."XP";?></h3>
		<h4><?php echo "Описание:".$row["Description"];?></h4>

	</div>
	<br><br>
	<?php
	    include "footer.php";
	?>
    <script src="JS/scroll.js"></script>
	<script src="JS/cancel.js"></script>
</body>
</html>