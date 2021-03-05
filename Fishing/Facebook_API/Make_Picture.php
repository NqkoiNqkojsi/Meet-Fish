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
$prof_pic="../Img/Post_Img/";
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
$date=date_format($new_date,"d.m.y");


function Error_Logging($name, $msg){
    $ifp = fopen( $name, 'w' );
    
    fwrite( $ifp, $msg);

    fclose( $ifp );
}
Error_Logging("../Log_files/picture_making.txt", $link.":Going to Making picture")
?>
<html>
<head>
	<title>Facebook Api posting</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>
		.carda {
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
			padding: 5px;
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
			height:50%;
		}
		.txt{
			color:white;
			margin: 30px;
		}
		.Img_Cont {
			position: relative;
			width: 100%;
			height: 300px;
		}

		.Img_In1 {
			max-height: 90%;
			max-width: 90%;
			width: auto;
			height: auto;
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			margin: auto;
			border-style: solid;
			border-width: 2px;
		}

		.FB_Img {
			/* Use "linear-gradient" to add a darken background effect to the image (photographer.jpg). This will make the text easier to read */
			background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.7)), url("../Img/FB_Img/waves.jpg");
			/* Set a specific height */
			height: 100%;
			/* Position and center the image to scale nicely on all screens */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			position: relative;
		}
	</style>
</head>
<body>
<div class="carda" id="carda" onload="takeScreenShot(<?php echo "'".$ime."'"; ?>, <?php echo "'".$link."'"; ?>);">
	<div class="FB_Img">
	<div class="Img_Cont">
		<img src=<?php echo $prof_pic;?> class="Img_In1" alt="Thubnail images">
	</div>
	<div class="card-body" id="card">
		<h3 class="txt" style="font-size: 50px;">В зоната на:<?php echo $mqsto;?></h3>
		<h2 class="txt" style="font-size: 40px;"><b>Дата: <?php echo $date; ?></h2>
		<h3 class="txt" style="font-size: 40px;"><b>Час: <?php echo $time; ?></h2>
		</div>
	</div>
</div>
	<p id="Error"></p>
	<script type="text/javascript" src="html2canvas/dist/html2canvas.js"></script>
    <script type="text/javascript">
		var myImage;
		var ime = "";
		var ID;
		var mes="посети го на https://meetandfish.online/Fishing/offer.php?id="+<?php echo $link; ?>;
		var myJSON = Object();
		var div = document.getElementById("carda");
		window.onload = function() {
			setTimeout(() => {
				takeScreenShot(<?php echo "'".$ime."'"; ?>, <?php echo "'".$link."'"; ?>);
			}, 1000);
		}
		function takeScreenShot(name, id) {
			var f = true;
			ime = name;
			ID = id;
			console.log(mes);
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
		}


		function saveAs(Img) {   
			
			var filename=<?php echo "'".$_REQUEST["id"].".png'"; ?>;
			var url = 'add_Img.php';

			$.ajax({ 
				type: "POST", 
				url: url,
				dataType: 'text',
				data: {
					base64data : Img,
					name : filename
				},
				success: function (data) {
					console.log(data);
					setTimeout(() => {
						Send_Info(filename); 
					}, 2000);
				},
			});
		}


		function Send_Info(src_img) {
		console.log("Sending to Facebook");
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					var myElement = document.getElementById("Error");
					myElement.innerHTML = this.responseText;
				}
			};
			console.log(myImage);
			myJSON = { "name": ime, "url": src_img, "link": ID };
			console.log(myJSON);
			data = JSON.stringify(myJSON);
			xhttp.open("GET", "upload_to_facebook.php?ime="+ime+"&url="+src_img+"&link="+ID, true);
			xhttp.send();
        }
    </script>
</body>
</html>
