<?php
$Img_exists=false;
$img="Fishing/Img/Post_Img/".$row["Img"];
$img0=$img;
if (file_exists($img0) && $img0!="Fishing/Img/Post_Img/") {
	$Img_exists=true;
}

$img1="Stelyo_Branch/".$img;
if ( $Img_exists==false && file_exists($img1) && $img1!="Stelyo_Branch/Fishing/Img/Post_Img/") {
	$Img_exists=true;
	$img0=$img1;
}

$img2="../".$img;
if ($Img_exists==false && file_exists($img2) && $img2!="../Fishing/Img/Post_Img/") {
	$Img_exists=true;
	$img0=$img2;
}
$img=$img0;
if($Img_exists==false){
	if($row["Prof"]==true){
		$ima=rand(1, 4).".jpg";
		$img="Fishing/Img/professional".$ima;
	}else{
		if($row["Use_Boat"]==true){
			$ima=rand(1, 5).".jpg";
			$img="Fishing/Img/boat".$ima;
		}else{
			$ima=rand(1, 5).".jpg";
			$img="Fishing/Img/beach".$ima;
		}
	}
}

if($i%4==1){
?>
	<div class="rowa" id="food">
<?php } ?>
<div class="columna">
	<div class="carda" style="background:#f2cc8f">
		<div class="Img_Cont">
			<a class="Img_In1" target="_blank" href=<?php echo $img;?>>
				<img class="Img_In1" src=<?php echo $img;?> alt="Thubnail images">
			</a>
		</div>
		<div class="card-body" style=" margin: auto;">
	        <?php
			$date_time = new DateTime($row['Time']);
			$time=$date_time->format('H:i');//get the hour and min
			$date=$date_time->format('d.m');//get the day and month
			?>
		    <h2><b>Дата: <?php echo $date; ?></b></h2><br>
		    <h3><b>Час: <?php echo $time; ?></b></h2><br>
		    <h3>В зоната на:<?php echo $towns[intval($row["Place"])];?></h3>
		    <button type="button" class="typeBtn2" onclick="window.location.replace('/Fishing/offer.php?id=<?php echo $row["ID"]; ?>')">Научете повече</button>
</div></div></div>
<?php	
if($i%4==0){
?>
</div>
<?php } ?>