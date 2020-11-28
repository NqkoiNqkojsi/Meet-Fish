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
include("");
include("config.php");
$My_message=$ime."Ви кани на риболов на ".$link;
$data = [
  'message' => $My_message,
  'source' => $fb->fileToUpload($link_img),
];

try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->post('/me/photos', $data, '{access-token}');
}
catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
}
catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

$graphNode = $response->getGraphNode();

echo 'Photo ID: ' . $graphNode['id'];
?>
