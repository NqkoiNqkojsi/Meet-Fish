<?php
//Used to upload the canvas to the facebook page
//set the send variables
$id="";
if(isset($_REQUEST["id"])){
	$id=$_REQUEST["id"];
}

include("config.php");

if (isset($AccessToken)) {
    // Logged in.

    try {
        $response = $fb->delete(
            '/104356978172893_'.$id.'/',
            array(),
            $AccessToken);
    }
    catch(Facebook\Exceptions\FacebookResponseException $e) {
        $msg='Graph returned an error: '.$e->getMessage();
        echo $msg;
        $error_string=__FILE__."****:".$msg;
        error_log($error_string, 0, "../Log_files/API.log");
        exit;
    }
    catch(Facebook\Exceptions\FacebookSDKException $e) {
        $msg= 'Facebook SDK returned an error: '.$e->getMessage();
        echo $msg;
        $error_string=__FILE__."****:".$msg;
        error_log($error_string, 0, "../Log_files/API.log");
        exit;
    }
    $graphNode = $response->getGraphNode();
    echo $graphNode;
}
?>