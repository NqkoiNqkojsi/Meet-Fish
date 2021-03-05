<?php
include config.php;
function GetFacebookLoginUrl(){
	$endpoint = "https://www.facebook.com/v6.0/dialog/oauth";

	$params = array(
		'client_id' => APP_ID,
		'riderect_uri' => RIDERECT_URI.
		'scope' => 'email',
		'auth_type' => 'rerequest'
	);
	return $endpoint."?".http_build_query($params);
}
?>