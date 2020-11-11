<!-- weather widget start -->
<?php
if(isset($_REQUEST["place"])==false && isset($_SESSION["user_Plc"])==false){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/sofia-18373"><img src="https://w.bookcdn.com/weather/picture/32_18373_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
}else{
	$nmb=0;
	if(isset($_SESSION["user_Plc"])==true){
		$nmb=$_SESSION["user_Plc"];
	}
	if(isset($_REQUEST["place"])==true){
		$nmb=$plc;
	}else if(isset($dop)==true){
	    $nmb=$dop;
	}
	if($nmb==0){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/burgas-38918"><img src="https://w.bookcdn.com/weather/picture/32_38918_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==1){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/sozopol-11366"><img src="https://w.bookcdn.com/weather/picture/32_11366_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==2){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/nesebar-36146"><img src="https://w.bookcdn.com/weather/picture/32_36146_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==3){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/varna-2162"><img src="https://w.bookcdn.com/weather/picture/32_2162_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==4){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/aheloy-48802"><img src="https://w.bookcdn.com/weather/picture/32_48802_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==5){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/ahtopol-82789"><img src="https://w.bookcdn.com/weather/picture/32_82789_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==6){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/sinemoretz-35487"><img src="https://w.bookcdn.com/weather/picture/32_35487_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==7){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/tsarevo-41338"><img src="https://w.bookcdn.com/weather/picture/32_41338_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==8){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/chernomorets-66834"><img src="https://w.bookcdn.com/weather/picture/32_66834_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==9){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/kiten-49777"><img src="https://w.bookcdn.com/weather/picture/32_49777_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==10){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/slanchev-bryag-w494378"><img src="https://w.bookcdn.com/weather/picture/32_w494378_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==11){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/sveti-vlas-30456"><img src="https://w.bookcdn.com/weather/picture/32_30456_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==12){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/primorsko-42265"><img src="https://w.bookcdn.com/weather/picture/32_42265_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==13){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/balchik-26416"><img src="https://w.bookcdn.com/weather/picture/32_26416_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==14){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/kavarna-39269"><img src="https://w.bookcdn.com/weather/picture/32_39269_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==15){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/yambol-47247"><img src="https://w.bookcdn.com/weather/picture/32_47247_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==16){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/elhovo-458389"><img src="https://w.bookcdn.com/weather/picture/32_458389_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==17){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/sofia-18373"><img src="https://w.bookcdn.com/weather/picture/32_18373_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==18){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/veliko-tarnovo-2156"><img src="https://w.bookcdn.com/weather/picture/32_2156_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==19){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/ruse-2157"><img src="https://w.bookcdn.com/weather/picture/32_2157_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==20){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/sevlievo-40602"><img src="https://w.bookcdn.com/weather/picture/32_40602_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==21){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/vidin-41543"><img src="https://w.bookcdn.com/weather/picture/32_41543_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else if($nmb==22){
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/plovdiv-11472"><img src="https://w.bookcdn.com/weather/picture/32_11472_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}else{
?>
<!-- weather widget start --><a target="_blank" style="padding: 0px 0px;" href="https://www.booked.net/weather/sofia-18373"><img src="https://w.bookcdn.com/weather/picture/32_18373_1_1_34495e_250_2c3e50_ffffff_ffffff_1_2071c9_ffffff_0_6.png?scode=124&domid=w209&anc_id=62195"  alt="booked.net"/></a><!-- weather widget end -->
<?php
	}
}
?>