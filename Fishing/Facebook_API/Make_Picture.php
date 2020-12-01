<?php
$date="";
if(isset($_REQUEST["date"])){
	$date=$_REQUEST["date"];
}
$mqsto="";
if(isset($_REQUEST["mqsto"])){
	$mqsto=$_REQUEST["mqsto"];
}
$prof_pic="../Img/FB_Img/";
if(isset($_REQUEST["pic"])){
	$prof_pic=$prof_pic.$_REQUEST["pic"];
}
$link="";
if(isset($_REQUEST["id"])){
    $link="https://meetandfish.online/Fishing/offer.php?id=";
	$link=$link.$_REQUEST["id"];
}
$ime="";
if(isset($_REQUEST["ime"])){
	$ime=$_REQUEST["ime"];
}
?>
<html>
<head>
	<title>Facebook Api posting</title>
	<style>
		.carda {
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
			padding: 16px;
			text-align: center;
			background-color: #DEF2F1;
		}
		.card-body {
			-ms-flex: 1 1 auto;
			flex: 1 1 auto;
			min-height: 1px;
			padding: 1.25rem;
		}
		.card_img {
			width: 100%;
		}
	</style>
</head>
<body onload="Set_Var(<?php echo "'".$ime."', '".$id."'"; ?>)">
<div class="carda">
	<img src=<?php echo $prof_pic;?> class="card_img" alt="Thubnail images">
	<div class="card-body" id="card">
	    <?php
		$date_time = new DateTime($vreme);
		$time=$date_time->format('H:i');//get the hour and min
		$date=$date_time->format('d.m');//get the day and month
        ?>
		<h2><b>Дата: <?php echo $date; ?></b></h2><br>
		<h3><b>Час: <?php echo $time; ?></b></h2><br>
		<h3>В зоната на:<?php echo $mqsto;?></h3>
</div></div>
	<script type="text/javascript" src="html2canvas/dist/html2canvas.js"></script>
	<script type="text/javascript" src="jquery-1.9.1.js"></script>
    <script type="text/javascript">
		var myImage = "";
		var ime = "";
		var ID = "https://meetandfish.online/Fishing/offer.php?id=";
		var myJSON = Object();
		function Set_Var(name, id,) {
			ime = name;
			ID = ID+id;
        }
        html2canvas($("#testdiv").then(function(canvas) {
			myImage = canvas.toDataURL("image/png");
			Send_Info();
		});
		function Send_Info() {
			console.log(myImage);
			myJSON = { "name": ime, "url": myImage, "link": ID };
			console.log(myJSON);
			data = JSON.stringify(myJSON);
			xhttp.open("GET", "upload_to_facebook.php?info_var="+data, true);
			xhttp.send();
        }
    </script>
</body>
</html>