<?php

//include phpmailer
require_once('postmaster/class.phpmailer.php');

//SMTP Settings
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth   = true;
#$mail->SMTPSecure = "tls";
$mail->Host       = "email.us-west-2.amazonaws.com";
    $mail->Port = 587;  // SMTP Port
$mail->Username = "AKIAJGHUF6XJOJSU4X3A"; // SMTP server username
$mail->Password = "AjlFyyBTGbdT9uxsSA7tcHrwqCToHcvMjWPW2V+5Kld1";
//

$mail->From = "uktoyama@ukcarstokyo.com";
$mail->FromName = "uktoyama";
$mail->AddAddress("jainmca4444@gmail.com");
$mail->Subject = "Email Subject"; //subject

//message
$body = "This is a test message.";

$mail->MsgHTML($body);
//

//recipient


//Success
if ($mail->Send()) {
    echo "Message sent!"; die;
}

//Error
if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}

?>
