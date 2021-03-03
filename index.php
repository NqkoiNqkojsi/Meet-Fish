<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
include "Fishing/logging.php";
$message="";
$filter=0;
$plc; $page=1; $d1; $d2;
if(isset($_REQUEST["place"])){
	$plc=$_REQUEST["place"];
}
if(isset($_REQUEST["page"])){
	$page=$_REQUEST["page"];
}
if(isset($_REQUEST["d1"])){
	$d1=$_REQUEST["d1"];
}
if(isset($_REQUEST["d2"])){
	$d2=$_REQUEST["d2"];
}
$nav=0;
include "Fishing/conn.php";
include "Fishing/datemech.php";
if(isset($_SESSION["Verified"])==true){
    if($_SESSION["Verified"]==false){
        $sql = "SELECT ID, Creation FROM customer WHERE ID=".$_SESSION['Ver_id'];
        $result = mysqli_query($conn, $sql);
        if(!$result || mysqli_num_rows($result) == 0){//check if there is the same nname
		    session_unset();
	    }
    }
}
include "Fishing/get_offer.php";
include "Fishing/towns.php";
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Място да си намериш компания за риба">
    <meta name="keywords" content="Project,MeetAndFish,meetandfish,fishing,рибарство,споделено рибарство,оферти за рибарство,заедно,риба,ходене,ходене за риба,лодка,кораб,въдица,компания,обява,среща,ИАРА,споделено">
    <meta name="author" content="Stelian Grozev">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Meet & Fish</title>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<link rel="shortcut icon" type="image/x-icon" href="Fishing/Img/logo2.ico">
	<link rel="stylesheet" href="Fishing/CSS/content_style.css">
	<link rel="stylesheet" href="Fishing/CSS/nav.css">
	<link rel="stylesheet" href="Fishing/CSS/form.css">
	<link rel="stylesheet" href="Fishing/CSS/img.css">
	<script src="Fishing/JS/datedropper.pro.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
</head>
<body class="body">
	<div class="navbar" id="navbar">
		<a href="index.php">Начало</a>
		<div class="dropdown" style="display: block;">
			<button class="dropbtn" onclick="DR_Show('myDropdown1')">Времето</button>
			<div id="myDropdown1" style="" class="dropdown-content">
				<?php include "Fishing/weat_wid.php"; ?>
			</div>
		</div>
		<div class="dropdown">
			<button id="dropbtn"  class="dropbtn" onclick="Page_Show('myDropdown', true)">По Място 
				<i class="fa fa-caret-down" ></i>
			</button>
			<div id="myDropdown" class="dropdown-content">
				<button class="dropdown-item" id="back_butt" onclick="Page_Turn(false, true)" style="background-color:#17252A; color:#FEFFFF; display:none;">Назад</button>
					<a  href="#" class="dropdown-item" id="town0"></a>
					<a  href="#" class="dropdown-item" id="town1"></a>
					<a  href="#" class="dropdown-item" id="town2"></a>
					<a  href="#" class="dropdown-item" id="town3"></a>
				<button class="dropdown-item" id="for_butt" onclick="Page_Turn(true, true)" style="background-color:#17252A; color:#FEFFFF; display:block;">Напред</button>
			</div>
		</div>
		<?php include "Fishing/datefilter.php"; ?>
		<a href="Fishing/offer_maker.php">Направете оферта</a>
		<?php
			if(!isset($_SESSION["user_ID"])){
		?>
		<a href="Fishing/Sign_Up.php">Регистрирайте се</a>
		<?php
			}else{
		?>
		<a href="Fishing/profile.php"><?php echo $_SESSION["user_Nname"]; ?></a>
		<?php
			}
		?>
	</div>
	<br><br>
	<div style="width:40%; margin: auto;" >
	<div id="demo" class="carousel slide" data-ride="carousel"><!--CAROSELL-->

		<!-- Indicators -->
		<ul class="carousel-indicators">
			<li data-target="#demo" data-slide-to="0" class="active"></li>
			<li data-target="#demo" data-slide-to="1"></li>
			<li data-target="#demo" data-slide-to="2"></li>
		</ul>
  
		<!-- The slideshow -->
		<div class="carousel-inner">
			<div class="carousel-item active">
			    <a href="https://www.nariba.com/" style="padding:0px 0px;" target="_blank">
				    <img src="Fishing/Img/carousell1.jpg" alt="Img1" width="80%">
				</a>
			</div>
			<div class="carousel-item">
				<a href="https://recepti.gotvach.bg/g-34135" style="padding:0px 0px;" target="_blank">
					<img src="Fishing/Img/carousell2.jpg" alt="Recipe link" width="80%">
				</a>
			</div>
			<div class="carousel-item">
				<a href="http://iara.government.bg" style="padding:0px 0px;" target="_blank">
					<img src="Fishing/Img/carousell3.jpg" alt="IARA link" width="80%">
				</a>
			</div>
		</div>
  
		<!-- Left and right controls -->
		<a class="carousel-control-prev" href="#demo" data-slide="prev">
			<span class="carousel-control-prev-icon"></span>
		</a>
		<a class="carousel-control-next" href="#demo" data-slide="next">
			<span class="carousel-control-next-icon"></span>
		</a>
	</div>
	</div>
	<br>
	<?php
	if(isset($_SESSION["Verified"])==true){
	    if($_SESSION["Verified"]==0){
	?>
	<div id="Modal1" class="modala">
		<!-- Modal content -->
		<div class="modal-contenta">
			<span class="close">&times;</span>
			<h5>Моля подвърдете имейла си, за <br>да продължите с профила си</h5>
			<button class="typeBtn2" onclick="Email1(<?php echo (($_SESSION['Ver_id'])+6)*3; ?>)">Изпрати наново</button>
		</div>
	</div>
	<?php
	    }
	}
	?>
	<!--Main Content-->
		<?php
			$red=mysqli_num_rows($result);//count the number of rows
			$prebr=0;
			if($page!=0){
				for($i=1;$i<=($page-1)*12;$i++){
					$row = mysqli_fetch_assoc($result);
					$prebr++;
				}
			}
			for($i=1;$i<=12 && $i<=$red-$prebr;$i++){//cycle through the rows
				$row = mysqli_fetch_assoc($result);//get the row
				if(isset($_REQUEST["d1"]) && isset($_REQUEST["d2"])){
				    if($row['Time']>=$d1 && $row['Time']<=$d2){
				        include "Fishing/index_offer.php";
				    }else{
				        $prebr++;
				    }
				}else{
				    include "Fishing/index_offer.php";
				}
			}
			if(($red-$prebr)%4!=0){
			?>
		</div>
			<?php
			}
			$link1="index.php?";// make a link for the two buttons
			$link2="";
			if(isset($_REQUEST["place"])){
				$link1=$link1."place=".$plc."&";
			}
			$link2=$link1."page=".($page+1);
			$link1=$link1."page=".($page-1);
			if($prebr>11){
			?>
			<a href="<?php echo $link1;?>" class="previous">&laquo; Предишен</a>
			<?php
			}
			if(($red-$prebr)>12){//check if a next button is needed
			?>
			<a href="<?php echo $link2;?>" class="next">Следващ &raquo;</a>
			<?php
			}
			include "Fishing/notify.php";
			?>
	<br><br><br>
	<?php
	    include "Fishing/footer.php";
	?>
	<script src="Fishing/JS/scroll.js"></script>
	<script src="Fishing/JS/modal1.js"></script>
	<script src="Fishing/JS/go_ajax.js"></script>
	<script src="Fishing/JS/dropdown_Ajax.js"></script>
</body>
</html>
