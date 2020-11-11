<?php
$towns=array("Бургас", "Созопол", "Несебър", "Варна", "Ахелой", "Ахтопол", "Синеморец",
			"Цараево", "Черноморец", "Китен", "Слънчев Бряг", "Свети Влас", "Приморско", 
			"Балчик", "Каварна", "Ямбол", "Елхово", "София", "Велико Търново", "Русе",
			"Севлиево", "Видин", "Пловдив", "Други");
$towns_eng=array("burgas", "sozopol", "nesebar", "varna", "aheloy", "ahtopol", "sinemoretz",
			"tsarevo", "chernomorets", "kiten", "sunny beach", "saint vlas", "primorsko", 
			"balchik", "kavarna", "yambol", "elhovo", "sofia", "veliko tarnovo", "ruse",
			"sevlievo", "vidin", "plovdiv", "other");
function hndlcms($text, $type) {//Function for dealing with " and '
	$new="";
	if($type==true){
		$new=str_replace('"', "&^&", $text);
		$new=str_replace("'", "#`#", $new);
	}else{
		$new=str_replace('&^&', '"', $text);
		$new=str_replace("#`#", "'", $new);
	}
	return strip_tags($new);
}

function weat_link($numb){//make so it's the right place for the weather widget
	switch($numb){
		case 0:$text="burgas-38918";break;
		case 1:$text="sozopol-11366";break;
		case 2:$text="nesebar-36146";break;
		case 3:$text="varna-2162";break;
		case 4:$text="aheloy-48802";break;
		case 5:$text="ahtopol-82789";break;
		case 6:$text="sinemoretz-35487";break;
		case 7:$text="tsarevo-41338";break;
		case 8:$text="aheloy-48802";break;
		case 9:$text="aheloy-48802";break;
		case 10:$text="nesebar";break;
		case 11:$text="nesebar";break;
		default:$text="sofia-18373";break;
	}
	return $text;
}
?>