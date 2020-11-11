function Collapse(x, y){
    var i;
    for(i=1; i<=4; i++){
        var name="Coll"+i.toString();
        var elem=document.getElementById(name);
        elem.style.display = "none";
    }
    var content =document.getElementById(x);
    var clicked =document.getElementById(y);
    console.log(x);
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
     setTimeout(function(){
        if (content.style.display === "block") {
            content.style.display = "none";
        }
    }, 10000);
}

function openForm(x) {
  document.getElementById(x).style.display = "block";
}

function closeForm(x) {
  document.getElementById(x).style.display = "none";
}
