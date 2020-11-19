	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<link rel="shortcut icon" type="image/x-icon" href="Img/logo2.ico">
	<link rel="stylesheet" href="CSS/content_style.css">
    <link rel="stylesheet" href="CSS/nav.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="DateTimePicker/src/DateTimePicker.css" />
    <script type="text/javascript" src="DateTimePicker/src/DateTimePicker.js"></script>
    <script type="text/javascript" src="DateTimePicker/src/i18n/DateTimePicker-i18n.js"></script>
</head>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>
<body class="body">
<div class="navbar" style="position: relative;" id="navbar">
	<a href="../index.php">Начало</a>
	<div class="dropdown" style="display: block;">
			<button class="dropbtn" onclick="DR_Show('myDropdown1')">Времето</button>
			<div id="myDropdown1" style="" class="dropdown-content">
				<?php include "Fishing/weat_wid.php"; ?>
			</div>
	</div>
	<div class="dropdown">
			<button id="dropbtn"  class="dropbtn" onclick="Page_Show('myDropdown', false)">По Място 
				<i class="fa fa-caret-down" ></i>
			</button>
			<div id="myDropdown" class="dropdown-content">
				<button class="dropdown-item" id="back_butt" onclick="Page_Turn(false, false)" style="background-color:#17252A; color:#FEFFFF; display:none;">Назад</button>
					<a  href="#" class="dropdown-item" id="town0"></a>
					<a  href="#" class="dropdown-item" id="town1"></a>
					<a  href="#" class="dropdown-item" id="town2"></a>
					<a  href="#" class="dropdown-item" id="town3"></a>
				<button class="dropdown-item" id="for_butt" onclick="Page_Turn(true, false)" style="background-color:#17252A; color:#FEFFFF; display:block;">Напред</button>
			</div>
		</div>
	<a href="offer_maker.php">Направи оферта</a>
	<?php
		if(!isset($_SESSION["user_ID"])){
	?>
	<a href="Sign_Up.php">Регистрирай се</a>
	<?php
		}else{
	?>
	<a href="profile.php"><?php echo $_SESSION["user_Nname"]; ?></a>
	<?php
		}
	?>