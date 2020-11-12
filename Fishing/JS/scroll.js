var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("navbar").style.top = "0";
  } else {
    document.getElementById("navbar").style.top = "-50px";
  }
  prevScrollpos = currentScrollPos;
}
//********************************************
function Page_Turn(f, g, h, m){//flip the pages of the dropdown with AJAX
	console.log("NACALO*********************************************************************************");
	var i;
	var suobshten="";
	var nach=0;
	var go="Fishing/ajax_to_db.php";
	var add="true)";
	if(m==false){
		go="ajax_to_db.php";
		add="false)";
	}
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				var res = JSON.parse(this.responseText);//get a JSON array
				console.log("proverka 1:"+g)
				nach=parseInt(res[0]);//get the place from where to start counting
				i=nach;
				suobshten=this.responseText;
				for(; i<=nach+3; i++){
					var mqs=i-nach+1;
					var id="town"+mqs.toString();//make the string to find the link
					suobshten=suobshten+"; "+id+"; "+res[mqs+1];
					var link;
					if(m==true){//check if it is the index page
						link="index.php?place="+i.toString();//prepare the href
					}else{
						link="../index.php?place="+i.toString();
					}
					document.getElementById(id).innerHTML=res[mqs+1];//make the text in the links
					document.getElementById(id).setAttribute("href", link);//set the href
				}
				console.log(suobshten);
				//show or hide buttons
				backBut=document.getElementById("back_butt");
				forBut=document.getElementById("for_butt");
				glavBut=document.getElementById("dropbtn");
				var even="";
				if(h==false){
					if(f==true){
						even="Page_Turn(true, "+i.toString()+", true, "+add;
						console.log("1even="+even);
					}
					else{
						even="Page_Turn(false, "+nach.toString()+", true, "+add;
						console.log("2even="+even);
					}
					console.log("i="+i+"; nach="+nach);
					glavBut.setAttribute( "onClick", even );
					even="Page_Turn(true, "+i.toString()+", false, "+add;
					forBut.setAttribute( "onClick", even);
					even="Page_Turn(false, "+(nach-4).toString()+", false, "+add;
					backBut.setAttribute( "onClick", even);
				}
				if(nach==0){//check if they are needed
					backBut.style.display="none";
				}else{
					backBut.style.display="block";
					if(i+1>=24){
						forBut.style.display="none";
					}else{
						forBut.style.display="block";
					}
				}
            }
        };
	console.log("f="+f.toString()+";d="+g);
	xmlhttp.open("GET", go+"?c=" + f.toString()+"&d="+g.toString(), true);
	xmlhttp.send();
	document.getElementById("myDropdown").classList.toggle("show");
}
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    var itm=document.getElementById("dtBox");
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show') && itm.style.display === "none") {
        openDropdown.classList.remove('show');
      }
    }
  }
}
//Show Hidden elements
function Show(str){
	document.getElementById(str).classList.toggle("show");
}