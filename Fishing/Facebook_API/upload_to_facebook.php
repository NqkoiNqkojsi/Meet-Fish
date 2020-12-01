<?php
//Used to upload the canvas to the facebook page
//set the send variables
$info_var;
if(isset($_REQUEST["info_var"])){
	$info_var=json_decode($_REQUEST["info_var"]);//{ "name": ime, "url": myImage, "link": ID }
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
