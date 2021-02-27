<?php
//Used to upload the canvas to the facebook page
//set the send variables
$link="https://meetandfish.online/Fishing/offer.php?id=";
if(isset($_REQUEST["link"])){
	$link=$link.$_REQUEST["link"];
}
$ime="";
if(isset($_REQUEST["ime"])){
	$ime=$_REQUEST["ime"];
}
$mes="";
if(isset($_REQUEST["mes"])){
	$mes=$_REQUEST["mes"];
}
$Img="";
if(isset($_REQUEST["url"])){
	$Img=$_REQUEST["url"];
}

include("config.php");

if (isset($AccessToken)) {
    // Logged in.

    $My_message=$ime." Ви кани на риболов ".$mes;
    $data = [ 
      'source' => $fb->fileToUpload('../Img/FB_Img/'.$Img),
      'message' => $My_message
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

    echo 'Photo ID: ' . $graphNode['id'];

    if (!unlink('../Img/FB_Img/'.$Img)) {  
		echo ($Img." cannot be deleted due to an error");  
	}  
	else {  
    	echo ($Img." has been deleted");  
	}  
}
?>
