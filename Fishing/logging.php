<?php
function console_log( $data ){
  echo '<script>';
  echo 'console.log("php_log:"+'. json_encode( $data ) .')';
  echo '</script>';
}
?>
