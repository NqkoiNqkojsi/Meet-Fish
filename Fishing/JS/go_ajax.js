function Email1(str){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "Fishing/email_verify.php?q=" + str.toString(), true);
    xmlhttp.send();
}