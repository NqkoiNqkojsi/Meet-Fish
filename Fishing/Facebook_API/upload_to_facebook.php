<?php
//Used to upload the canvas to the facebook page
//set the send variables
include("../Log_files/logging_to_file.php");
$log_filename="API_logs.txt";
$msg;
$info_var;
if(isset($_REQUEST["info_var"])){
	$info_var=json_decode($_REQUEST["info_var"]);//{ "name": ime, "url": myImage, "link": ID }
    Log_file($_REQUEST["info_var"], $log_filename);
}

include("config.php");

if (isset($accessToken)) {
    // Logged in.

    $My_message=$info_var->name."Ви кани на риболов";
    $data = [
      'link' => $info_var->link,
      'message' => $My_message,
      'source' => $fb->fileToUpload($info_var->url),
    ];

    try {
        $response = $fb->post('/104356978172893/feed', $data, $AccessToken);
    }
    catch(Facebook\Exceptions\FacebookResponseException $e) {
        $msg='Graph returned an error: '.$e->getMessage();
        Log_file($msg, $log_filename);
        exit;
    }
    catch(Facebook\Exceptions\FacebookSDKException $e) {
        $msg= 'Facebook SDK returned an error: '.$e->getMessage();
        Log_file($msg, $log_filename);
        exit;
    }
    $graphNode = $response->getGraphNode();

    $msg= 'Photo ID: ' . $graphNode['id'];
    Log_file($msg, $log_filename);
}
?>
