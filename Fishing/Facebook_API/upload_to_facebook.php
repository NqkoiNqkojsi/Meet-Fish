<?php
//Used to upload the canvas to the facebook page
//set the send variables
include("../Log_files/logging_to_file.php");
$log_filename="API_logs.txt";
$link="https://meetandfish.online/Fishing/offer.php?id=";
if(isset($_REQUEST["link"])){
	$link=$link.$_REQUEST["link"];
}
$ime="";
if(isset($_REQUEST["ime"])){
	$ime=$_REQUEST["ime"];
}
$msg;
$info_var;
if(isset($_REQUEST["info_var"])){
	$info_var=json_decode($_REQUEST["info_var"]);//{ "name": ime, "url": myImage, "link": ID }
}
$url="";
if(isset($_REQUEST["url"])){
	$url=$_REQUEST["url"];
}
include("config.php");

if (isset($accessToken)) {
    // Logged in.

    $My_message=$info_var->name."Ви кани на риболов";
    $data = [
      'link' => $link,
      'message' => $My_message,
    ];

    try {
        $response = $fb->post('/104356978172893/feed', $data, $AccessToken);
    }
    catch(Facebook\Exceptions\FacebookResponseException $e) {
        $msg='Graph returned an error: '.$e->getMessage();
        $error_string=__FILE__."****:".$msg;
        error_log($error_string, 0, "../Log_files/API.log");
        exit;
    }
    catch(Facebook\Exceptions\FacebookSDKException $e) {
        $msg= 'Facebook SDK returned an error: '.$e->getMessage();
        $error_string=__FILE__."****:".$msg;
        error_log($error_string, 0, "../Log_files/API.log");
        exit;
    }
    $graphNode = $response->getGraphNode();

    $msg= 'Photo ID: ' . $graphNode['id'];
    $error_string=__FILE__."****:".$msg;
    error_log($error_string, 0, "../Log_files/API.log");
}
?>
