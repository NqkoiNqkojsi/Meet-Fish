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

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      console.log("pressed dropbtn")
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
function Page_Show(Element) {
    console.log("Pokazvane na stranica");
    document.getElementById(Element).classList.toggle("show");
}