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
$Img="";
if(isset($_REQUEST["url"])){
	$Img=$_REQUEST["url"];
}

include("config.php");

if (isset($AccessToken)) {
    // Logged in.

    $My_message=$ime." Ви кани на риболов! Посетете офертата на ".$link;
    $data = [ 
      'source' => $fb->fileToUpload('https://meetandfish.online/Stelyo_Branch/Fishing/Img/FB_Img/'.$Img),//remove Stelyo_Branch when pulling
      'message' => $My_message
    ];

    try {
        $response = $fb->post('/104356978172893/photos', $data, $AccessToken);
    }
    catch(Facebook\Exceptions\FacebookResponseException $e) {
        $msg='Graph returned an error: '.$e->getMessage();
        $error_string=__FILE__."****:".$msg;
        echo $msg;
        error_log($error_string, 0, "../Log_files/API.log");
        exit;
    }
    catch(Facebook\Exceptions\FacebookSDKException $e) {
        $msg= 'Facebook SDK returned an error: '.$e->getMessage();
        $error_string=__FILE__."****:".$msg;
        echo $msg;
        error_log($error_string, 0, "../Log_files/API.log");
        exit;
    }
    $graphNode = $response->getGraphNode();

    $sql = "UPDATE customer SET FB_ID='".$graphNode['id']."' WHERE ID=".$_REQUEST["link"];
	mysqli_query($conn, $sql);

    echo 'Photo ID: ' . $graphNode['id'];

    if (!unlink('../Img/FB_Img/'.$Img)) {  
		echo ($Img." cannot be deleted due to an error");  
	}  
	else {  
    	echo ($Img." has been deleted");  
	}  
}
?>
