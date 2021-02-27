<?php
define('FACEBOOK_SDK_V4_SRC_DIR', '/home/u157928248/domains/meetandfish.online/public_html/Stelyo_Branch/Fishing/Facebook_API/Facebook/Facebook/');
require_once('/home/u157928248/domains/meetandfish.online/public_html/Stelyo_Branch/Fishing/Facebook_API/Facebook/Facebook/autoload.php');
ini_set('display_errors', 1);

$fb = new \Facebook\Facebook([
  'app_id' => '198412948406802',
  'app_secret' => '8f1a318c934afa4f244b3f48c37929b8',
  'default_graph_version' => 'v2.2'
]);

$AccessToken="EAAC0dJ1PAhIBAA90viCeSNZA9amdMOThBtmnIn8rCOWcBZBXKVgm1kUwZBTPMLZBbAFRDS5HfOOniXMUxLrzbOUKk8ZCYqpsZBGA6ZAfTVB5ysP1XGJBLMZCWxde95JNJR3qXdZBOgyE2nxwLruiDtfaVU96uLK9qPpVqCis5TSwZBlAZDZD";

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


