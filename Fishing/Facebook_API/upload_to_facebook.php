<?php
//Used to upload the canvas to the facebook page
//set the send variables

$ime="";
if(isset($_REQUEST["ime"])){
	$ime=$_REQUEST["ime"];
}
$link="";
if(isset($_REQUEST["link"])){
	$ime=$_REQUEST["link"];
}
$link_img="";
include("Make_Picture.php");
include("config.php");
$canvasHelper = $fb->getCanvasHelper();

try {
    $accessToken = $canvasHelper->getAccessToken();
}
catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
}
catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
}

if (isset($accessToken)) {
    // Logged in.

    $My_message=$ime."Ви кани на риболов на ".$link;
    $data = [
      'message' => $My_message,
      'source' => $fb->fileToUpload($link_img),
    ];

    try {
        $response = $fb->post('/104356978172893/feed', $data, $AccessToken);
    }
    catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: '.$e->getMessage();
        exit;
    }
    catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: '.$e->getMessage();
        exit;
    }
    $graphNode = $response->getGraphNode();

    echo 'Photo ID: ' . $graphNode['id'];
}
?>
