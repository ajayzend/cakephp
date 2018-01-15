<?php
require_once('/var/www/html/website/app/webroot/phpmailer2/class.phpmailer.php');
$mail = new phpmailer;

// Set mailer to use AmazonSES.


			$fromEmail = "uktoyama@ukcarstokyo.com";
			#$toEmail  = $emailArr;
			$toEmail  = "jainmca4444@gmail.com";
			$toName = "";
			$fromName ="";



$mail->IsAmazonSES();

// Set AWSAccessKeyId and AWSSecretKey provided by amazon.
$mail->AddAmazonSESKey("AKIAIBXOFSO6ZQA3SCVQ", "AviXTW+/nrZWC2KHiqV28wWlVrnEboIbrAZNe7XkyccR");
$mail->SMTPDebug = true;
// "From" must be a verified address.

$mail->setFrom($fromEmail, 'sender');
$mail->AddAddress($toEmail);


$mail->Subject = 'INVOICE';
$mail->Body = "TEST BODY";
$sendMail = $mail->Send(); // send message

print_r($sendMail);
 


