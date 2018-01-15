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
$mail->Host       = "email-smtp.us-west-2.amazonaws.com";
$mail->Username   = "AKIAIBXOFSO6ZQA3SCVQ";
$mail->Password   = "AviXTW+/nrZWC2KHiqV28wWlVrnEboIbrAZNe7XkyccR";
//

$mail->SetFrom('uktoyama@ukcarstokyo.com', 'uktoyama'); //from (verified email address)
$mail->Subject = "Email Subject"; //subject

//message
$body = "I think it would be better to link one of the city files rather than GMT or EST, as then they will keep track of ";

#$body = eregi_replace("[]",'',$body);
$mail->MsgHTML($body);
//

//recipient
$mail->AddAddress("jainmca4444@gmail.com", "Test Recipient");

//Success
print_r($mail->Send());

?>
 
