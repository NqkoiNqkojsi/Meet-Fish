function Login_FB(str) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log("Success");
        }
    };
    var xmlhttp = new XMLHttpRequest();
    console.log(str);
    xmlhttp.open("GET", "Fishing/Facebook_API/facebook_login.php", true);
    xmlhttp.send();
}

function Delete_FB(id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    };
    var xmlhttp = new XMLHttpRequest();
    console.log(id);
    xmlhttp.open("GET", "Fishing/Facebook_API/delete_to_facebook.php?id=" + id, true);
    xmlhttp.send();
}