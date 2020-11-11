<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/Fishing/Mailer/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/Fishing/Mailer/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/Fishing/Mailer/SMTP.php';

$mail = new PHPMailer(true);
$mail->isSMTP(); 
$mail->CharSet = 'UTF-8';
//$mail->SMTPDebug = 2;//*****************Delete for no messages************************** // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; //$mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is deprecated
$mail->SMTPAuth = true;
$mail->Username = 'meet.and.fish@gmail.com'; // email
$mail->Password = 'ddphblhjxqwrryyz'; // password
$mail->setFrom('mackarelbot@meetandfish.online', 'MackarelBot'); // From email and name
$mail->addAddress($address, $name); // to email and name
$mail->Subject = $subject;
$mail->AddEmbeddedImage($dir.'Img/logo2.png', 'logo');
$mail->msgHTML($message); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
$mail->AltBody = 'HTML messaging not supported Отиди на:'.$link; // If html emails is not supported by the receiver, show this body
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
$mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
if(!$mail->send()){
    //echo "Mailer Error: " . $mail->ErrorInfo;
}else{
   // echo "Message sent!";
}
?>