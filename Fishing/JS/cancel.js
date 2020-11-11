function Exit(a, b){
var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				window.location.replace('profile.php');
            }
        };
	xmlhttp.open("GET", "ajax_to_db.php?e=" + a.toString()+"&f="+b.toString(), true);
	xmlhttp.send();
}