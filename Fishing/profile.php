<?php
session_start();
include "logging.php";
include "conn.php";
include "towns.php";
$f=false;
$message="";
//*****************************************************************************************************************************************
if(isset($_POST["submit"])){//Zapisvane na informaciq
	$message="Miava prez submit";
    if($_POST["submit"]==1){//change Nickname
        $sql = "UPDATE customer SET NickName='".$_POST["Nname"]."' WHERE ID='".$_SESSION['user_ID']."'";
        if (mysqli_query($conn, $sql)) {
			$message= "Record updated successfully";
		} else {
			$message= "Error updating record: " . mysqli_error($conn);
		}
        $_SESSION["user_Nname"]=$_POST["Nname"];
		$f=true;
    }else if($_POST["submit"]==2){//change Names
        $sql = "UPDATE customer SET FName='".$_POST["Fname"]."', SName='".$_POST["Sname"]."' WHERE ID='".$_SESSION['user_ID']."'";
        if (mysqli_query($conn, $sql)) {
			$message= "Record updated successfully";
		} else {
			$message= "Error updating record: " . mysqli_error($conn);
		}
		$f=true;
    }else if($_POST["submit"]==3){//change Password
        $sql = "SELECT Pass FROM customer WHERE ID='".$_SESSION['user_ID']."'";
        $result = mysqli_query($conn, $sql);
        $row= mysqli_fetch_assoc($result);
        if($row["Pass"]==$_POST["OldPass"]){
			if($_POST["NewPass"]==$_POST["RePass"]){
				$sql = "UPDATE customer SET Pass='".$_POST["NewPass"]."' WHERE ID='".$_SESSION['user_ID']."'";//sql for password
				if (mysqli_query($conn, $sql)) {
					$message= "Record updated successfully";
				} else {
					$message= "Error updating record: " . mysqli_error($conn);
				}
				$f=true;
			}
        }
		if($f==true){
			$message="There is a mistake with the password";//Show mistake in pass
		}
    }else if($_POST["submit"]==4){//change Location
		$numb=$_POST["place"]-1;
		$sql = "UPDATE customer SET Place='".$numb."' WHERE ID='".$_SESSION['user_ID']."'";//sql for loc
        if (mysqli_query($conn, $sql)) {
			$message= "Record updated successfully";
		} else {
			$message= "Error updating record: " . mysqli_error($conn);
		}
		$f=true;
    }else if($_POST["submit"]==5){//change Description
		$sql = "UPDATE customer SET Description='".$_POST["Desc"]."' WHERE ID='".$_SESSION['user_ID']."'";//sql for description
        if (mysqli_query($conn, $sql)) {
			$message= "Record updated successfully";
		} else {
			$message= "Error updating record: " . mysqli_error($conn);
		}
	}else if ($_POST["submit"]==6){//*******************Img saving
		$sql = "SELECT Img_name FROM customer WHERE ID='".$_SESSION['user_ID']."'";
        $result = mysqli_query($conn, $sql);
        $row= mysqli_fetch_assoc($result);
		$target_dir = "Img/User_Img/";
		$save_path=$target_dir.$row["Img_name"];
		foreach($_FILES as $files){
			echo $files['name'];
		}
		$file = $_FILES['my_file']['name'];
		echo $_FILES['my_file']['error'];
		$path = pathinfo($file);
		$filename = $path['filename'];
		$ext = $path['extension'];
		if($ext=="jpeg" || $ext=="png" || $ext=="gif" || $ext=="jpg" || $ext=="jpeg"){
			//deleting the old adress
			if (file_exists($save_path)) {
				if (!unlink($save_path)) {  
					echo ($save_path." cannot be deleted due to an error");  
				}  
				else {  
					echo ($save_path." has been deleted");  
				}  
			}
			//adding the new img
			$temp_name = $_FILES['my_file']['tmp_name'];
			$save_path = $target_dir.$filename.".".$ext;
			$save_path_sql = $filename.".".$ext;
			if (file_exists($save_path)) {
				 $f=false;
				$gres=9;
				$messages="Моля променете името на снимката, сега то е".$save_path;
			}else{
				 move_uploaded_file($temp_name,$save_path);
				 $sql = "UPDATE customer SET Img_name='".$save_path_sql."' WHERE ID='".$_SESSION['user_ID']."'";//sql for description
				if (mysqli_query($conn, $sql)) {
					$message= "Record updated successfully";
				}else {
					$message= "Error updating record: " . mysqli_error($conn);
				}
				 echo "Congratulations! File Uploaded Successfully.";
			}
		}else{
			$f=false;
			$gres=9;
			$messages="Снимката трябва да бъде от типвете:jpg, jpeg, gif, png";
		}
	}else if($_POST["submit"]=="exit"){
		session_unset();
		session_destroy();
		header("Location: ../index.php");
		die();
	}
	if($f==true){
		$message="There is a mistake with the password";//Show message of success
	}
}
//*******************************************************************************************************************************
$sql="SELECT * FROM customer WHERE ID=".$_SESSION["user_ID"];//get the db
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$save_path="Img/User_Img/".$row["Img_name"];
if (!file_exists($save_path)) {
	$save_path="Img/FB_Img/user.png";
}
//*************************************************************************************************************
$broj=0;
$offer=array();
if($row["Attend"]!=null){
	$token = strtok($row["Attend"], ",");
	while ($token !== false)
	{
		$offer[$broj]=$token;
		$token = strtok(",");
		$broj++;
	}
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
        <br><br>
		<h5><?php echo $message; ?></h5>
		<form method="post" action="profile.php">
			<h1><?php echo "Здравейте ".$row["FName"].' "'.$row["NickName"].'" '.$row["SName"]." !";?></h1>
			<h3>Опит: <?php echo $row["Exp"]; ?> точки</h3>
			<button type="submit" class="typeBtn2" style="padding:10px 0px; background-color:#E85A4F; width:120px;" name="submit" value="exit">Излез</button>
		</form>
    <div>
		<div class="otdel">
        <form class="form-inline" action="profile.php" method="post">
            <label for="Nname">Променете Прякор:</label>
            <input type="text" id="Nname" placeholder="Въведи Прякор..." name="Nname">
            <button type="submit" name="submit" value="1">Запиши</button>
        </form>
		</div>
		<div class="otdel">
        <form class="form-inline" action="profile.php" method="post">
            <label for="Fname">Променете Първо име:</label>
            <input type="text" id="Fname" placeholder="Въведи Първо име..." name="Fname">
            <label for="Sname">Променете Второ име:</label>
            <input type="text" id="Sname" placeholder="Въведи Второ име..." name="Sname">
            <button type="submit" name="submit" value="2">Запиши</button>
        </form>
		</div>
		<div class="otdel">
        <form class="form-inline" action="profile.php" method="post">
            <label for="OldPass">Стара парола:</label>
            <input type="password" id="OldPass" placeholder="Въведи Стара парола" name="OldPass">
			<br>
            <label for="NewPass">Нова парола:</label>
            <input type="password" id="NewPass" placeholder="Въведи Нова парола" name="NewPass">
			<br>
            <label for="RePass">Въведете отнова парола:</label>
			<br>
            <input type="password" id="RePass" placeholder="Въведи отнова парола" name="RePass">
            <button type="submit" name="submit" value="3">Запиши</button>
        </form>
		</div>
		<div class="otdel">
        <form class="form-inline" action="profile.php" method="post">
            <label for="place">Променете най-близкото място до вас:</label>
            <select name="place" required>
                <?php
                    foreach($towns as $town){
                    $br=$br+1;
                ?>
                <option value="<?php echo $br;?>"><?php echo $town; ?></option>
                <?php
                    }
                ?>
            </select>
            <button type="submit" name="submit" value="4">Запиши</button>
        </form>
		</div>
		<div class="otdel">
        <form class="form-inline" action="profile.php" method="post">
            <label for="Desc">Променете си описанието:</label>
            <textarea style="width:60%; height:120px; margin:10px 10px;" id="Desc" placeholder="Въведи Описанието" name="Desc"></textarea>
            <button type="submit" name="submit" value="5">Запиши</button>
        </form>
		</div>
		 <!--Image upload--> 
		<div class="otdel">
        <form class="form-inline" action="profile.php" method="post" enctype="multipart/form-data">
			<a target="_blank" href=<?php echo $save_path;?>>
				<img src=<?php echo $save_path; ?> style="max-width:200px;max-height:200px;height:auto;"/>
			</a>
            <label for="my_file"><b>Смени профилна снимка</b></label>
			<input type="file" name="my_file" id="my_file" /><br /><br />
            <button type="submit" name="submit" value="6">Запиши</button>
        </form>
		</div>
    </div>
	<?php
		$keep=array();//offers to keep
		$broj_vtor=0;//their amount
		for ($i=0;$i<$broj;$i++){
			$sql = "SELECT ID, Time, Taken FROM offer WHERE ID=".$offer[$i];//get the order
			$result = mysqli_query($conn, $sql);
			$check_acc=false;//
			if (mysqli_num_rows($result) > 0) {//check if the row exists
				$check_acc=true;
			} else {
				$check_acc=false;
			}
			if($check_acc==true){//check if that is the right offer
				$row = mysqli_fetch_assoc($result);//get the row
				$date_time = new DateTime($row['Time']);
				$date=$date_time->format('d/m');//get the day and month
				$keep[$broj_vtor]=$offer[$i];
				$broj_vtor++;
	?>
	<div>
		<h2><b>На <?php echo $date; ?></b></h2><br>
		<div style="display: inline;">
			<button type="button" class="typeBtn2" style="padding:10px 0px; border-radius: 3px;" onclick="window.location.replace('/Fishing/offer.php?id=<?php echo $row["ID"]; ?>')">Виж оферта</button>
			<button type="button" class="typeBtn2" style="padding:10px 0px; border-radius: 3px; background-color:#E85A4F; width:20%;" onclick="Exit(<?php echo $row["ID"]; ?>, <?php echo $_SESSION["user_ID"]; ?>)" >Откажи се</button>
	    </div>
	<br>
	<?php
			}
		}
		$att="";
		foreach($keep as $item){
			if($att!=""){
				$att=$att.",".$item;
			}else{
				$att=$item;
			}
		}
		$sql = "UPDATE customer SET Attend='".$att."' WHERE ID=".$_SESSION["user_ID"];
		$result = mysqli_query($conn, $sql);
	?>
	</div>
	</div>
	</div>
	</div>
	<br><br>
	<?php
	    include "footer.php";
	?>
    <script src="JS/scroll.js"></script>
	<script src="JS/cancel.js"></script>
</body>
</html>