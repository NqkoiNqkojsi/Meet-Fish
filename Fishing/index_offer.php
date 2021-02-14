<?php
$img="";
$img="Fishing/Img/Post_Img/".$row["Img"];
if (!file_exists($img) || $img=="Fishing/Img/Post_Img/") {
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
	<div class="carda">
		<a target="_blank" href=<?php echo $img;?>>
			<img src=<?php echo $img;?> class="thumbnail" alt="Thubnail images" style="max-height:300px;max-width:300px">
		</a>
		<div class="card-body">
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