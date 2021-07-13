<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'webskill001@gmail.com';
    $mail->Password   = 'web@1999';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('webskill001@gmail.com', 'Mailer');
    $mail->addAddress('sumitchouhan10091999@gmail.com');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Here is the test title';
    $mail->Body    = 'This is the HTML message body <b>test!</b>';

    if($mail->send()){
		echo "message sent";
	}else{
		echo "message not sent ".$mail->ErrorInfo;
	}
   