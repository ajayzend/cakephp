<?php
require_once('class.phpmailer.php');

?>
<?php

//include phpmailer


//SMTP Settings
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth   = true;
$mail->SMTPSecure = "tls";
$mail->Host       = EMAIL_HOST;
$mail->Username   = AWSAccessKeyId;
$mail->Password   = AWSSecretKey;
//

$mail->SetFrom(EMAIL_FROM, FromName); //from (verified email address)
$mail->Subject = "Email Subject"; //subject

//message
$body = "I think it would be better to link one of the city files rather than GMT or EST, as then they will keep track of ";

#$body = eregi_replace("[]",'',$body);
$mail->MsgHTML($body);
//

//recipient
$mail->AddAddress("ajay.kumar.iimt@gmail.com", "Test Recipient");

//Success
print_r($mail->Send());

?>
 
