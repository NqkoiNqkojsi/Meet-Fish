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
    if (!event.target.matches('.dropbtn') && !event.target.matches('.dropdown-item') {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    var itm=document.getElementById("dtBox");
    for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        console.log("openDropdown:" + openDropdown.classList.contains('show').toString())
        console.log("itm:" + itm.style.display.toString())
      if (openDropdown.classList.contains('show') && itm.style.display === "none") {
        openDropdown.classList.remove('show');
      }
    }
  }
}
//Show Hidden elements
function Page_Show(Element) {
    console.log("Pokazvane na element");
    document.getElementById(Element).classList.toggle("show");
}