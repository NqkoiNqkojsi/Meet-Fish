<?php
    $data = $_REQUEST['base64data']; 
    echo $data;
    $name='../Img/FB_Img/'.$_REQUEST['name'];

    $image = explode('base64,',$data); 

    file_put_contents($name, base64_decode($image[1]));

?>