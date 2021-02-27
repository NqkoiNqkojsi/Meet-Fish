<?php
//include("../Log_files/logging_to_file.php");
//$log_filename="API_logs.txt";
$log_time = date('Y-m-d h:i:sa');
$date1="";
$date2="";
if(isset($_REQUEST["date1"])){
	$date1=$_REQUEST["date1"];
}
$mqsto="";
if(isset($_REQUEST["mqsto"])){
	$mqsto=$_REQUEST["mqsto"];
}
$prof_pic="../Img/User_Img/";
if(isset($_REQUEST["pic"])){
	$prof_pic=$prof_pic.$_REQUEST["pic"];
}else{
	$prof_pic="../Img/FB_Img/user.png";
}
$link="";
if(isset($_REQUEST["id"])){
    $link="";
	$link=$link.$_REQUEST["id"];
}
$ime="";
if(isset($_REQUEST["ime"])){
	$ime=$_REQUEST["ime"];
}
$new_date=date_create($date1);
$time=date_format($new_date,"H:i");
$date=date_format($new_date,"d.M");
$message_send="посети го на https://meetandfish.online/Fishing/offer.php?id=".$link;
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
			width: 600px;
			height: 600px;
		}
		.card-body {
			-ms-flex: 1 1 auto;
			flex: 1 1 auto;
			min-height: 1px;
			padding: 1.25rem;
		}
		.card_img {
			height:30%;
		}
	</style>
</head>
<body>
<div class="carda" id="carda" onload="takeScreenShot(<?php echo "'".$ime."'"; ?>, <?php echo "'".$link."'"; ?>);">
	<img src=<?php echo $prof_pic;?> class="card_img" alt="Thubnail images"><br>
	<div class="card-body" id="card">
		<h2 style="font-size: 50px;"><b>Дата: <?php echo $date; ?></b></h2><br>
		<h3 style="font-size: 40px;"><b>Час: <?php echo $time; ?></b></h2><br>
		<h3 style="font-size: 40px;">В зоната на:<?php echo $mqsto;?></h3>
</div></div>
	<p id="Error"></p>
	<script type="text/javascript" src="html2canvas/dist/html2canvas.js"></script>
    <script type="text/javascript">
		var myImage;
		var ime = "";
		var ID;
		var mes="";
		var myJSON = Object();
		var div = document.getElementById("carda");
		window.onload = function() {
			setTimeout(() => {
				takeScreenShot(<?php echo "'".$ime."'"; ?>, <?php echo "'".$link."'"; ?>, <?php echo "'".$message_send."'"; ?>);
			}, 1000);
		}
		function takeScreenShot(name, id, mes1) {
			var f = true;
			ime = name;
			ID = id;
			mes = mes1;
			console.log("predi canvas");
			try {
				html2canvas(div).then(function(canvas){
					document.body.appendChild(canvas);
					myImage = canvas.toDataURL("image/png");
					console.log(myImage);
					saveAs(myImage);
				});
			} catch (error) {
				console.error(error);
				f = false;
			}
			setTimeout(() => {
				if (f == true) {
					console.log("After making a photo");
					console.log("Img Url=" + myImage);
				}
			}, 2000);
		}


		function saveAs(Img) {   
			
			var filename=<?php echo "'".$_REQUEST["id"].".png'"; ?>;
			var url = 'upload_Img/add_Img.php';

			$.ajax({ 
				type: "POST", 
				url: url,
				dataType: 'text',
				data: {
					base64data : Img,
					name : filename
				}
			});
			Send_Info(filename);
		}


		function Send_Info(src_img) {
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var myElement = document.getElementById("Error");
					myElement.innerHTML = responseText;
				}
			};
			console.log(myImage);
			myJSON = { "name": ime, "url": src_img, "link": ID };
			console.log(myJSON);
			data = JSON.stringify(myJSON);
			xhttp.open("GET", "upload_to_facebook.php?ime="+ime+"&url="+src_img+"&link="+ID+"&mes="+mes, true);
			xhttp.send();
        }
    </script>
</body>
</html>
