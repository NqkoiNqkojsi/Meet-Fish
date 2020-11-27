<?php
// Start the session
session_start();
session_unset();
include "logging.php";
include "conn.php";
include "towns.php";
$f=true;
$g=true;
$gres=0;
$br=0;
$messages="";
$message2="";
$plan=0;
if(isset($_REQUEST["plan"])){
	$plan=$_REQUEST["plan"];
}
function test_input($data) {//Clear the input
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//*************************************CHECK if the SIGN UP is correct*******************************************
if(isset($_POST["submit"])){
	foreach($_POST as $item){//test input everyhing
		$item=test_input($item);
	}
	$sql = "SELECT NickName FROM customer WHERE NickName='".$_POST['nname']."'";
	$result = mysqli_query($conn, $sql);
	if($result && mysqli_num_rows($result) == 1){//check if there is the same nname
		$f=false;
		$gres=1;
		$messages="Има грешка с подадената информация!";
	}
	$sql = "SELECT Email FROM customer WHERE Email='".$_POST['email']."'";
	$result = mysqli_query($conn, $sql);
	if($result && mysqli_num_rows($result) == 1){//check if there is the same email
		$f=false;
		$gres=2;
		$messages="Има грешка с подадената информация!";
	}
	//******Regular Expressions*******
	if (!preg_match("/[a-zA-Z0-9._-]{3,15}/", $_POST['nname'])) {
	    $f=false;
		$gres=3;
		$message2="Прякорът НЕ съотвества с Изискванията";
		$messages="Има грешка с подадената информация!";
	}
	if (!preg_match("([a-zA-Z]{3,30}\s*)", $_POST['sname']) || !preg_match("([a-zA-Z]{3,30}\s*)", $_POST['fname'])) {
	    $f=false;
		$gres=4;
		$message2="Имената НЕ съотвестват с Изискванията";
		$messages="Има грешка с подадената информация!";
	}
	if (!preg_match("/^\S*(?=\S{8,15})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $_POST['psw'])) {
	    $f=false;
		$gres=5;
		$message2="Паролата НЕ съотвества с Изискванията";
		$messages="Има грешка с подадената информация!";
	}else{
	    if($_POST["psw"]!=$_POST["psw-repeat"]){//check the passwords
		    $f=false;
		    $gres=6;
		    $messages="Паролите не си СЪОТВЕТСВАТ!";
	    }    
	}
	//********reCaptcha**********
	$captcha;
	if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
    }
    if(!$captcha){
        $f=false;
		$gres=7;
		$messages="Моля направете reCaptcha!";
    }
    $secretKey = "6Leu6OsUAAAAAEuCTR8wWBRr6sDQ-jaInoYi7X6C";
    $ip = $_SERVER['REMOTE_ADDR'];
    // post request to server
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response,true);
    // should return JSON with success as true
    if(!$responseKeys["success"]) {
        $g=false;
		$gres=8;
	    $messages="GTFO you filthy bot!";
    }
    //****************************************************************************
    //*************************Hashing passwords***********************
    $timeTarget = 0.05; // 50 milliseconds 
    $cost = 8;
    do {
        $cost++;
        $start = microtime(true);
        $pwd=password_hash($_POST['psw'], PASSWORD_BCRYPT, ["cost" => $cost]);
        $end = microtime(true);
    } while (($end - $start) < $timeTarget);
	//**********Adding to DB************
	$plc=($_POST['place']-1);
	if($f==true){
	    $today=date("Y-m-d");
	    //***************************Binding & Excecuting************************
		$sql="INSERT INTO customer (ID, NickName, FName, SName, Email, Pass, Birth, Place, Ship, Exp, Description, "."Creation, Verified) "    ."VALUES (0, ?, ?, ?, ?, '".$pwd."', '".$_POST['birth']."', ".$plc.	", ?, 0, ?, '".$today."', 0)";
		$stmt= $conn->prepare($sql);
		$stmt->bind_param("ssssss", $_POST['nname'], $_POST['fname'], $_POST['sname'], $_POST['email'], $_POST['ship'], $_POST['Desc']);
	    $stmt->execute();
	    include "email_verify.php";//send email verification
		header("location:../index.php");
		die();
	    /*$resul = $stmt->get_result();
        $row = $resul->fetch_assoc();
		if ($row!==false) {
			include "email_verify.php";//send email verification
			header("location:../index.php");
			die();
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		*/
	}
}
//*************************************CHECK if the LOG IN is correct*******************************************
$g=true;
if(isset($_POST["enter"])){
    //****************SQL Statement********************************
	$sql = $conn->prepare("SELECT Email, ID, Pass, NickName, Place, Verified FROM customer WHERE Email=?");
	$sql->bind_param("s", $_POST["lEmail"]);
	$sql->execute();
	$result = $sql->get_result();
	$row = $result->fetch_assoc();
	//********reCaptcha**********
	$captcha;
	if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
    }
    if(!$captcha){
        $f=false;
		$gres=9;
		$messages="Моля направете reCaptcha!";
    }
    $secretKey = "6LckJ-wUAAAAAPupE77DGPWiPDwpLlctufoHnDHp";
    $ip = $_SERVER['REMOTE_ADDR'];
    // post request to server
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response,true);
    // should return JSON with success as true
    if(!$responseKeys["success"]) {
        $g=false;
		$gres=10;
	    $messages="GTFO you filthy bot!";
    }
	//*******************The other validation*************************
	if(!$result || mysqli_num_rows($result) == 0){
		$g=false;
		$gres=11;
		$messages="Въведeна е Грешна информация!";
	}else{
		if(!password_verify($_POST["lPass"], $row["Pass"])){
			$g=false;
			$gres=12;
			$messages="Въведeна е Грешна информация!";
		}
	}
	if($g==true){
	    if($row["Verified"]==true){
		    $_SESSION["user_ID"]=$row["ID"];
		    $_SESSION["user_Nname"]=$row["NickName"];
		    $_SESSION["user_Plc"]=$row["Place"];
		    $_SESSION["Verified"]=true;
		    $_SESSION["Ver_id"]=$row["ID"];
		}else{
		    $_SESSION["Verified"]=false;
		    $_SESSION["Ver_id"]=$row["ID"];
		}
		
		header("Location:../index.php");
		die();
	}
}
include "passext.php";
?>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" href="CSS/sign_up_style.css">
	<link rel="stylesheet" href="CSS/pricing.css">
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
<?php 
	include "navbar.php";
?>
	</div>
	<br>
	<br>
	<script src="JS/scroll.js"></script>
	<div class="row">
<?php
if(isset($_POST["submit"])){
    if($f==false){
?>      <h3>submit=<?php var_dump($_POST["submit");?>; <?php gettype($_POST["submit");?></h3>
		<div class="column" style="padding: 10px;">
			<form action="Sign_Up.php" method="post">
				<div class="container">
					<h1>Запиши се</h1>
					<h4 style="color:#E85A4F;"><?php echo $messages; ?></h4>
					<h6><?php var_dump($gres); ?></h6>
					<hr>
			
					<label for="nname"><b>Прякор*</b></label>
					<input id="Inp1" onfocus="Collapse('Coll1', 'Inp1')" type="text" placeholder="Въведете Прякор..." name="nname" required>
					<?php 
					if($gres==3){
					?>
					<div class="HiddObj" style="display:block;">
					    <h6 style="color=#E85A4F;"><?php echo $message2; ?></h4>
					</div>
					<?php } ?>
					<div class="HiddObj" id="Coll1">
					    <ul>
				            <li>Може да се използват Големи и Малки букви</li>
				            <li>Може да се използват числа и знаците:"._-"</li>
				            <li>Трябва да е между 3 и 15 дължина</li>
					    </ul>
					</div>
			
					<label for="fname"><b>Първо име*</b></label>
					<input id="Inp2" onfocus="Collapse('Coll2', 'Inp2')" type="text" placeholder="Въведете Първо име..." name="fname" required>
					<?php
					if($gres==4){
					?>
					<div class="HiddObj" style="display:block;">
					    <h6 style="color=#E85A4F;"><?php echo $message2; ?></h4>
					</div>
					<?php } ?>
					<div class="HiddObj" id="Coll2">
					    <ul>
				            <li>Трябва да се използва в началото 1 Главна буква</li>
				            <li>Останалите да са малки букви</li>
					    </ul>
					</div>
			
					<label for="sname"><b>Второ име*</b></label>
					<input id="Inp3" onfocus="Collapse('Coll3', 'Inp3')" type="text" placeholder="Въведете Второ име..." name="sname" required>
					<?php
					if($gres==4){
					?>
					<div class="HiddObj" style="display:block;">
					    <h6 style="color=#E85A4F;"><?php echo $message2; ?></h4>
					</div>
					<?php } ?>
					<div class="HiddObj" id="Coll3">
					    <ul>
				            <li>Трябва да се използва в началото 1 Главна буква</li>
				            <li>Останалите да са малки букви</li>
					    </ul>
					</div>
			
					<label for="email"><b>Е-мейл*</b></label>
					<input type="text" placeholder="Въведете Е-мейл..." name="email" required>

					<label for="psw"><b>Парола*</b></label>
					<input id="Inp4" onfocus="Collapse('Coll4', 'Inp4')" type="password" placeholder="Въведете Парола..." name="psw" required>
					<?php
					if($gres==5){
					?>
					<div class="HiddObj" style="display:block;">
					    <h6 style="color=#E85A4F;"><?php echo $message2; ?></h4>
					</div>
					<?php } ?>
					<div class="HiddObj" id="Coll4">
					    <ul>
				            <li>Трябва да се използва поне 1 Главна буква</li>
				            <li>Трябва да се използва поне 1 Малка буква</li>
				            <li>Трябва да се използва поне 1 цифра</li>
				            <li>Знаците трябва да са между 8 и 16</li>
					    </ul>
					</div>

					<label for="psw-repeat"><b>Повтори Парола*</b></label>
					<input type="password" placeholder="Повтори Паролата" name="psw-repeat" required>
			
					<label for="birth"><b>Рожден Ден*</b></label>
					<input type="date" id="birth" placeholder="Въведи рожден ден..." name="birth" required><br>
			
					<label for="place"><b>Кое е най-близкото до вас?*</b></label>
					<select name="place" required>
						<?php
						foreach($towns as $town){
							$br=$br+1;
						?>
						<option value="<?php echo $br;?>"><?php echo $town; ?></option>
						<?php
						}
						?>
					</select><br>
			     
					<label for="Ship"><b>Имаш ли лодка</b></label>
					<input type="text" placeholder="Номер на лодката..." name="ship">
			
                    <label for="Desc"><b>Опишете се за другите</b></label><br>
					<textarea id="Desc" style="height:90px;" placeholder="Въведи Описанието" name="Desc"></textarea><br><br>

					<div class="g-recaptcha" data-sitekey="6Leu6OsUAAAAAERWESijZXDiawXZwO0gMKmThg4w"></div>
					<div class="clearfix">
						<button type="button" name="cancel" class="cancelbtn">Прекъсни</button>
						<?php include("plans.php"); ?>
						<!--<button type="submit" name="submit" class="signupbtn">Запиши се</button>-->
					</div>
				</div>
			</form>
		</div>
<?php
	}
}else{
?>
		<div class="column" style="padding: 10px; border-width: 0; outline-offset: 1px;">
			<form action="Sign_Up.php" method="post">
				<div class="container">
					<h1>Запиши се</h1>
					<hr>
			
					<label for="nname"><b>Прякор*</b></label>
					<input id="Inp1" onfocus="Collapse('Coll1', 'Inp1')" type="text" placeholder="Въведете Прякор..." name="nname" required>
					<div class="HiddObj" id="Coll1">
					    <ul>
				            <li>Може да се използват Големи и Малки букви</li>
				            <li>Може да се използват числа и знаците:"._-"</li>
				            <li>Трябва да е между 3 и 15 дължина</li>
					    </ul>
					</div>
			
					<label for="fname"><b>Първо име*</b></label>
					<input id="Inp2" onfocus="Collapse('Coll2', 'Inp2')" type="text" placeholder="Въведете Първо име..." name="fname" required>
					<div class="HiddObj" id="Coll2">
					    <ul>
				            <li>Трябва да се използва в началото 1 Главна буква</li>
				            <li>Останалите да са малки букви</li>
					    </ul>
					</div>
			
					<label for="sname"><b>Второ име*</b></label>
					<input id="Inp3" onfocus="Collapse('Coll3', 'Inp3')" type="text" placeholder="Въведете Второ име..." name="sname" required>
					<div class="HiddObj" id="Coll3">
					    <ul>
				            <li>Трябва да се използва в началото 1 Главна буква</li>
				            <li>Останалите да са малки букви</li>
					    </ul>
					</div>
			
					<label for="email"><b>Е-мейл*</b></label>
					<input type="text" placeholder="Въведете Е-мейл..." name="email" required>

					<label for="psw"><b>Парола*</b></label>
					<input id="Inp4" onfocus="Collapse('Coll4', 'Inp4')" type="password" placeholder="Въведете Парола..." name="psw" required>
					<div class="HiddObj" id="Coll4">
					    <ul>
				            <li>Трябва да се използва поне 1 Главна буква</li>
				            <li>Трябва да се използва поне 1 Малка буква</li>
				            <li>Трябва да се използва поне 1 цифра</li>
				            <li>Знаците трябва да са между 8 и 16</li>
					    </ul>
					</div>

					<label for="psw-repeat"><b>Повтори Парола*</b></label>
					<input type="password" placeholder="Повтори Паролата" name="psw-repeat" required>
			
					<label for="birth"><b>Рожден Ден*</b></label>
					<input type="date" id="birth" placeholder="Въведи рожден ден..." name="birth" required><br>
			
					<label for="place"><b>Кое е най-близкото до вас?*</b></label>
					<select name="place" required>
						<?php
						foreach($towns as $town){
							$br=$br+1;
						?>
						<option value="<?php echo $br;?>"><?php echo $town; ?></option>
						<?php
						}
                        ?>
					</select><br>
			     
					<label for="Ship"><b>Имаш ли лодка</b></label>
					<input type="text" placeholder="Номер на лодката..." name="ship">
			
                    <label for="Desc"><b>Опишете се за другите</b></label><br>
					<textarea id="Desc" style="height:90px;" placeholder="Въведи Описанието" name="Desc"></textarea><br><br>


			        <div class="g-recaptcha" data-sitekey="6Leu6OsUAAAAAERWESijZXDiawXZwO0gMKmThg4w"></div>
					<div class="clearfix">
						<button type="button" name="cancel" class="cancelbtn">Прекъсни</button>
						<?php include("plans.php"); ?>
						<!--<button type="submit" name="submit" class="signupbtn">Запиши се</button>-->
					</div>
				</div>
			</form>
		</div>
<?php
}
if(isset($_POST["enter"])){
	if($g==false){
?>
		<div class="column" style="padding: 10px; border-width: 0;">
			<form action="Sign_Up.php" method="post">
				<div class="container">
					<h1>Влез в профила си</h1>
					<h4 style="color:#E85A4F;"><?php echo $messages; ?></h4>
					<hr>
					
					<label for="lEmail"><b>Е-мейл</b></label>
					<input type="text" placeholder="Въведи Е-мейл..." name="lEmail" required>

					<label for="lPass"><b>Парола</b></label>
					<input type="password" placeholder="Въведи Парола..." name="lPass" required>

                    <div class="g-recaptcha" data-sitekey="6LckJ-wUAAAAAGpbh-Ryd343646rfcoKEdr3QmL6"></div>
					<button type="submit" name="enter">Влез</button>
				</div>
			</form>
			<?php include "chgpass.php"; ?>
		</div>
<?php
	}
}else{
?>
		<div class="column" style="padding: 10px; border-width: 0;">
			<form action="Sign_Up.php" method="post">
				<div class="container">
					<h1>Влез в профила си</h1>
					<hr>
					
					<label for="lEmail"><b>Е-мейл</b></label>
					<input type="text" placeholder="Въведи Е-мейл..." name="lEmail" required>

					<label for="lPass"><b>Парола</b></label>
					<input type="password" placeholder="Въведи Парола..." name="lPass" required>

                    <br><br>
                    <div class="g-recaptcha" data-sitekey="6LckJ-wUAAAAAGpbh-Ryd343646rfcoKEdr3QmL6"></div>
				    <button type="submit" name="enter">Влез</button>
				</div>
			</form>
			<?php include "chgpass.php"; ?>
		</div>
<?php
}
?>
	</div>
	<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
	<script src="JS/data_picker.js"></script>
	<script src="JS/collapse.js"></script>
	<script src="JS/modal1.js"></script>
	<?php
	if(isset($_REQUEST["id"])){
	?>
	<script scr="JS/modal1.js">
        OpCls(<?php echo $mes; ?>);
    </script>
    <?php
	}else if($mes==false){
	?>
	<script scr="JS/modal1.js">
        OpCls(true);
    </script>
    <?php
	}
	    include "footer.php";
	?>
</body>
</html>