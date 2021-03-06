<?php
define('FACEBOOK_SDK_V4_SRC_DIR', '/home/u157928248/domains/meetandfish.online/public_html/Stelyo_Branch/Fishing/Facebook_API/Facebook/Facebook/');
require_once('/home/u157928248/domains/meetandfish.online/public_html/Stelyo_Branch/Fishing/Facebook_API/Facebook/Facebook/autoload.php');
require_once('/home/u157928248/domains/meetandfish.online/public_html/Stelyo_Branch/Fishing/conn.php');
ini_set('display_errors', 1);

define('APP_ID', '198412948406802');
define('APP_SECRET', '8f1a318c934afa4f244b3f48c37929b8');
define('GRAPH_VERSION', 'v9.0');
define('RIDERECT_URI', 'https://meetandfish.online/Stelyo_Branch/Fishing/Sign_Up.php');
define('APP_STATE', 'eciphp');

$fb = new \Facebook\Facebook([
  'app_id' => APP_ID,
  'app_secret' => APP_SECRET,
  'default_graph_version' => GRAPH_VERSION
]);

$AccessToken="EAAC0dJ1PAhIBAAMVZB9CbmbTO5IlYo5XbiigdGvHlZCwr5V50QaU3ZAxVSM23LZCUQfPZARxzHLOqh3apb9YO6pJn20rr3ncz8A2wUBKE7nKY1wzAS05Y6ExVemBcg5nQrHoN008oqwT1z9o6lEDX3EZCorojri9hTZBpRzE0KveKZAWixldJNJZA";

/*$helper = $fb->getCanvasHelper();
$AccessToken;

try {
  $AccessToken = $helper->getAccessToken();
} catch(Facebook\Exception\ResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exception\SDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($AccessToken)) {
  echo 'No OAuth data could be obtained from the signed request. User has not authorized your app yet.';
  exit;
}*/
?>


