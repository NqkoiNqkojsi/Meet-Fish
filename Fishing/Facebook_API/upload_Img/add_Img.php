<?php
    $data = $_REQUEST['base64data']; 
    $name='../Img/FB_Img/'.$_REQUEST['name'];

    $image = explode('base64,',$data); 
    echo $image;

    file_put_contents($name, base64_decode($image));

?>