function Login_FB() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log("Success");
        }
    };
    var xmlhttp = new XMLHttpRequest();
    console.log(str);
    xmlhttp.open("GET", "Facebook_API/facebook_login.php", true);
    xmlhttp.send();
}