<?php
    $data = $_REQUEST['base64data']; 
    $name='../Img/FB_Img/'.$_REQUEST['name'];

    $ifp = fopen( $name, 'wb' );

    $image = explode( ',', $data);

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $image[ 1 ] ) );

    // clean up the file resource
    fclose( $ifp );
?>