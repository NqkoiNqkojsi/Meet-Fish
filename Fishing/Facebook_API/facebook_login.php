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
	$endpoint = "https://graph.facebook.com/".GRAPH_VERSION."/oauth/access_token";
	$params = array(
		'client_id' => APP_ID,
		'client_secret' => APP_SECRET,
		'redirect_uri' => RIDERECT_URI,
		'code' => $code
	);
	return MakeFbApiCall($endpoint, $params);
}

function getFacebookUserInfo( $accessToken ) {
		// endpoint for getting a users facebook info
		$endpoint = "https://graph.facebook.com/" . 'me';

		$params = array( // params for the endpoint
			'fields' => 'first_name,last_name,email,picture',
			'access_token' => $accessToken
		);

		// make the api call
		return MakeFbApiCall( $endpoint, $params );
	}


function TryLoginWithFB($get, $conn){
	$status = 'fail';
		$message = '';

		// reset session vars
		$_SESSION['fb_access_token'] = array();
		$_SESSION['fb_user_info'] = array();
		$_SESSION['eci_login_required_to_connect_facebook'] = false;

		if ( isset( $get['error'] ) ) { // error comming from facebook GET vars
			$message = $get['error_description'];
		} else { // no error in facebook GET vars
			// get an access token with the code facebook sent us
			$accessTokenInfo = GetAccessTokenWithCode( $get['code'] );

			if ( $accessTokenInfo['has_errors'] ) { // there was an error getting an access token with the code
				$message = $accessTokenInfo['error_message'];
			} else { // we have access token! :D
				// set access token in the session
				$_SESSION['fb_access_token'] = $accessTokenInfo['fbResponse']['access_token'];

				// get facebook user info with the access token
				$fbUserInfo = getFacebookUserInfo( $_SESSION['fb_access_token'] );

				if ( !$fbUserInfo['has_errors'] && !empty( $fbUserInfo['fbResponse']['id'] ) && !empty( $fbUserInfo['fbResponse']['email'] ) ) { // facebook gave us the users id/email
					// 	all good!
					$status = 'ok';

					// save user info to session
					$_SESSION['fb_user_info'] = $fbUserInfo['fbResponse'];

					echo $_SESSION['fb_user_info']["email"];
					// check for user with facebook id
					Check_Exist("Email", $_SESSION['fb_user_info']["email"], $conn);

					// check for user with email
					//Check_Exist("fb_user_id", $_SESSION['fb_user_info']["id"], $conn);
					
				} else {
					$message = 'Invalid creds';
				}
			}
		}

		return array( // return status and message of login
			'status' => $status,
			'message' => $message,
		);
}
?>