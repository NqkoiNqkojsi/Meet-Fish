<?php
include "Facebook_API/config.php";

function MakeFbApiCall($endpoint, $params){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $endpoint.'?'.http_build_query($params));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

	$fbResponse=curl_exec($ch);
	$fbResponse=json_decode($fbResponse, TRUE);
	curl_close($ch);
	
	echo $endpoint.'?'.http_build_query($params);
	return array(
		'endpoint' => $endpoint,
		'params' => $params,
		'fbResponse' => $fbResponse,
		'has_errors' => isset($fbResponse['error']) ? TRUE : FALSE,
		'error_message' => isset($fbResponse['error']) ? $fbResponse['error']['message'] : ''
	);
}

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

function GetAccessTokenWithCode($code){
	$endpoint = "https://www.facebook.com/".GRAPH_VERSION."/oauth/access_token";
	$params = array(
		'client_id' => APP_ID,
		'client_secret' => APP_SECRET,
		'redirect_uri' => RIDERECT_URI,
		'code' => $code
	);
	return MakeFbApiCall($endpoint, $params);
}
?>