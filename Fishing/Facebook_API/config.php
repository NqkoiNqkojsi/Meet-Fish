<?php
define('FACEBOOK_SDK_V4_SRC_DIR', "https://meetandfish.online/Stelyo_Branch/Fishing/Facebook_API".'/Facebook/');
require_once("https://meetandfish.online/Stelyo_Branch/Fishing/Facebook_API".'/Facebook/autoload.php');
ini_set('display_errors', 1);

$fb = new \Facebook\Facebook([
  'app_id' => '198412948406802',
  'app_secret' => '8f1a318c934afa4f244b3f48c37929b8',
  'default_graph_version' => 'v2.2'
]);
$AccessToken = 'EAAC0dJ1PAhIBAA6dCPzyAuWN3rBXegkGmYiOpXw3pjIjL5Ws2Mya3YuYZBNLc3kneBRGFDPGnCeJ41RtfJocm5isrGSxDAZCoR6OABEpaMKq2bu2kirYP5AcQuB220QDrQBh2Iyd64R3vmOorvHUTyN6FrCD9G5PsPD4kaJwZDZD';

?>


