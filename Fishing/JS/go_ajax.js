function Email1(str){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "Fishing/email_verify.php?q=" + str.toString(), true);
    xmlhttp.send();
}
function Send_FC(date, ime, pic, mqsto, id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            setTimeout(() => { window.location = "http://meetandfish.online/index.php";}, 2000);
        }
    };
    var str = "date1=" + date.toString() + "&ime=" + ime.toString() + "&pic=" + pic.toString + "&mqsto=" + mqsto.toString() + "&id=" + id.toString();
    var xmlhttp = new XMLHttpRequest();
    console.log(str);
    xmlhttp.open("GET", "/Stelyo_Branch/Fishing/Facebook_API/Make_Picture.php?"+str, true);
    xmlhttp.send();
}