<?php
$log_msg="";
if(isset($_REQUEST["msg"])){
	$mqsto=$_REQUEST["msg"];
    Log_file($log_msg, "API_logs.txt");
}
function Log_file($log_msg, $log_filename){
    $log_time = date('Y-m-d h:i:sa');

    wh_log("************** Start Log For Day : '" . $log_time . "'**********", $log_filename);
    wh_log($log_msg, $log_filename);
    wh_log("************** END Log For Day : '" . $log_time . "'**********", $log_filename);

    function wh_log($log_msg, $log_filename)
    {
        if (!file_exists($log_filename))
        {
            // create directory/folder uploads.
            mkdir($log_filename, 0777, true);
        }
        $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
        file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
    }
}
?>