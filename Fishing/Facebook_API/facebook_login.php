<?php
include "Facebook_API/config.php";
function GetFacebookLoginUrl(){
	$endpoint = "https://www.facebook.com/".GRAPH_VERSION."/dialog/oauth";

	$params = array(
		'client_id' => APP_ID,
		'redirect_uri' => RIDERECT_URI,
		'state'=>APP_STATE,
		'scope' => 'email',
		'auth_type' => 'rerequest'
	);
	return $endpoint."?".http_build_query($params);
}
?>