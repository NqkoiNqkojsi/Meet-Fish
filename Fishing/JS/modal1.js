// Get the modal
var modal = document.getElementById("Modal1");

// Get the button that opens the modal
var btn = document.getElementById("ModalBtn1");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
console.log("The script is ready");
// When the user clicks the button, open the modal 
if(btn!==undefined && btn!==null){
    console.log("Button is ready");
    btn.onclick = function() {
        modal.style.display = "block";
    }
}else{
    window.onload = function(event){
	    modal.style.display = "block";
    }
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

function OpCls(f){
    if(f==true){
         modal.style.display = "block";
    }else{
         modal.style.display = "none";
    }
}