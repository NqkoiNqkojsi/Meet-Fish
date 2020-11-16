<?php
if($_SERVER['REQUEST_URI']=="/index.php"){
    console_log($_SERVER['REQUEST_URI']);
    $date=new DateTime();
    $date1=new DateTime();
    $date1->modify('+2 months');
    console_log($date1);
?>
<div class="dropdown" style="display: block;">
	<button class="dropbtn" onclick="Show('myDropdown3')">По дата</button>
	<div id="myDropdown3" class="dropdown-content" style="width:590%;">
	        <p>От-до: </p>
		<form class="form-inline" action="index.php" style="display: flex; flex-flow: row wrap; align-items: center;" method="post">
            <input type="text" data-field="date" data-view="Popup" data-min="<?php echo $date->format('Y-m-d H:i:s'); ?>" data-max="<?php echo $date1->format('Y-m-d H:i:s'); ?>" name="date"  readonly>
            <input type="text" data-field="date" data-view="Popup" data-min="<?php echo date_format($date, 'd-m-Y'); ?>" data-max="<?php echo date_format($date1, 'd-m-Y'); ?>" name="date1"  readonly>
            <button type="submit" name="filter">Submit</button>
        </form>
        <div id="dtBox"></div>
	</div>
</div>

<script src="Fishing/JS/data_picker.js"></script>
<?php
}else if($_SERVER['REQUEST_URI']=="/Fishing/offer_maker.php"){
    console_log($_SERVER['REQUEST_URI']);
    $date=new DateTime();
    $date1=new DateTime();
    $date1->modify('+2 months');
    console_log($date1);
?>
<input type="text" data-field="datetime" data-view="Popup" data-min="<?php echo $date->format('d-m-Y'); ?>" data-max="<?php echo $date1->format('d-m-Y'); ?>" name="time"  readonly>
<div id="dtBox1"></div>
<script src="JS/data_picker.js"></script>
<?php } ?>
