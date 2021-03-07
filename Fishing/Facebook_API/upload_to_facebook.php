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
function Error_Logging($name, $msg){
    $ifp = fopen( $name, 'w' );

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, $msg);

    // clean up the file resource
    fclose( $ifp );
}



if (isset($AccessToken)) {
    // Logged in.

    $My_message=$ime." Ви кани на риболов! Посетете офертата на ".$link;
    $data = [ 
      'source' => $fb->fileToUpload('https://meetandfish.online/Fishing/Img/FB_Img/'.$Img),//remove Stelyo_Branch when pulling
      'message' => $My_message
    ];

    try {
        $response = $fb->post('/104356978172893/photos', $data, $AccessToken);
    }
    catch(Facebook\Exceptions\FacebookResponseException $e) {
        $msg='Graph returned an error: '.$e->getMessage();
        $error_string=__FILE__."****:".$msg;
        echo $msg;
        Error_Logging("../Log_files/API.log", $msg."<br>");
        error_log($error_string, 0, "../Log_files/API.log");
        exit;
    }
    catch(Facebook\Exceptions\FacebookSDKException $e) {
        $msg= 'Facebook SDK returned an error: '.$e->getMessage();
        $error_string=__FILE__."****:".$msg;
        echo $msg;
        Error_Logging("../Log_files/API.log", $msg."<br>");
        error_log($error_string, 0, "../Log_files/API.log");
        exit;
    }
    $graphNode = $response->getGraphNode();

    $sql = "UPDATE offer SET FB_ID='".$graphNode['post_id']."' WHERE ID=".$_REQUEST["link"];
	if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    }else{
        echo "Error updating record: " . mysqli_error($conn);
    }

    echo 'Photo ID: ' . $graphNode['post_id']."<br>";
    $msg='Photo ID: ' . $graphNode['post_id']."<br>";

    if (!unlink('../Img/FB_Img/'.$Img)) {  
		echo ($Img." cannot be deleted due to an error");
        $msg=$msg.$Img." cannot be deleted due to an error";
	}  
	else {  
    	echo ($Img." has been deleted");  
        $msg=$msg.$Img." has been deleted";
	}
    Error_Logging("../Log_files/API.log", $msg."<br>");
}
?>
