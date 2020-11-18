﻿// JavaScript source code
var open = Array();
open = ["Бургас", "Созопол", "Несебър", "Варна"];
var position = 0;
function Page_Show(Element, m) { //m-is it index:true or it comes from /Fishing:false; Element-the dropdown
	console.log("Pokazvane na stranica");
	console.log("position=" + position.toString());
	var i = 0;
	for (i; i < 4; i++) {
		var att = "town"+i.toString();//reference the id of the dropdown elements
		var link;
		if (m == true) {//check if it is the index page
			link = "index.php?place=" + (i + position).toString();//prepare the href
		} else {
			link = "../index.php?place=" + (i + position).toString();
		}
		document.getElementById(att).innerHTML = open[i];//make the text in the links
		document.getElementById(att).setAttribute("href", link);//set the href
	}
	document.getElementById(Element).classList.toggle("show");
}
function Page_Turn(f, m) {//flip the pages of the dropdown with AJAX
	//f-true:napred,false:nazad; g-the first city number; h-is it the glav button; m-is it index:true or it comes from /Fishing:false
	console.log("NACALO*********************************************************************************");
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var res = JSON.parse(this.responseText);//get a JSON array
			res.forEach(function (entry, index) {//function for getting the new array
				console.log("new arr" + index + ":" + entry);
				open[index] = entry;
            });
			//show or hide buttons
			backBut = document.getElementById("back_butt");//Nazad
			forBut = document.getElementById("for_butt");//Napred
			var even = "";
			if (position == 0) {//check if they are needed
				backBut.style.display = "none";
			} else {
				backBut.style.display = "block";
				if (position + 1 >= 24) {
					forBut.style.display = "none";
				} else {
					forBut.style.display = "block";
				}
			}
			Page_Show('myDropdown', true);
		}
	};
	if (f == true) {//what is the position
		position = position + 4;
	} else {
		position = position - 4;
	}
	var go = "Fishing/ajax_to_db.php";
	var add = "true)";
	if (m == false) {
		go = "ajax_to_db.php";
		add = "false)";
	}
	console.log("f=" + f.toString() + ";d=" + position.toString());
	xmlhttp.open("GET", go + "?c=" + f.toString() + "&d=" + position.toString(), true);
	xmlhttp.send();
}