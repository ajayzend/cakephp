<?php
require_once('/var/www/html/website/app/webroot/phpmailer2/class.phpmailer.php');
$mail = new phpmailer;

// Set mailer to use AmazonSES.


			$fromEmail = EMAIL_FROM;
			#$toEmail  = $emailArr;
			$toEmail  = "ajay.kumar.iimt@gmail.com";
			$toName = "";
			$fromName ="";



$mail->IsAmazonSES();

// Set AWSAccessKeyId and AWSSecretKey provided by amazon.
$mail->AddAmazonSESKey(AWSAccessKeyId, AWSSecretKey);
$mail->SMTPDebug = true;
// "From" must be a verified address.

$mail->setFrom($fromEmail, 'sender');
$mail->AddAddress($toEmail);


$mail->Subject = 'INVOICE';
$mail->Body = "TEST BODY";
$sendMail = $mail->Send(); // send message

print_r($sendMail);
 


