function Login_FB(str) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log("Success");
            var link = document.getElementById("fb_butt");
            link.setAttribute('href', this.responseText);
        }
    };
    console.log(str);
    xmlhttp.open("GET", "Fishing/Facebook_API/facebook_login.php", true);
    xmlhttp.send();
}