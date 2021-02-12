<?php
session_start();
include "logging.php";
include "conn.php";
include "towns.php";
$id=0;
if(isset($_REQUEST["id"])){
	$id=$_RQUEST["id"];
}else{
	header("location:profile.php");
    die();
}
if($_SESSION["user_ID"]==$id){
	header("location:profile.php");
    die();
}
$sql="SELECT * FROM customer WHERE ID=".$_SESSION["user_ID"];//get the db
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
<?php 
	include "navbar.php";
?>
    </div>
	<br><br>
    <div class="containerut">  
        <h6><?php echo  $row["FName"].' "'.$row["NickName"].'" '.$row["SName"];?></h6>
		<img src=<?php echo $save_path; ?> style="max-width:200px;max-height:200px;height:auto;"/>
		<h3><?php echo  "They have: ".$row["Exp"]."Exp";?></h3>
		<h4><?php echo "Discription".$row["Discription"];?></h4>

	</div>
	<br><br>
	<?php
	    include "footer.php";
	?>
    <script src="JS/scroll.js"></script>
	<script src="JS/cancel.js"></script>
</body>
</html>