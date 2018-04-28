<?php
require_once "PHPMailer/PHPMailerAutoload.php";
$mail = new PHPMailer;
//Enable SMTP debugging.
//$mail->SMTPDebug = 3;
//Set PHPMailer to use SMTP.
$mail->isSMTP();
//Set SMTP host name
$mail->Host = "in-v3.mailjet.com";
//Set this to true if SMTP host requires authentication
$mail->SMTPAuth = true;
//Provide username and password
$mail->Username = "c8ba7dda35c18fdc86952068fe4bb36e";
$mail->Password = "66f2bc986d242fc3245e6a8f02ea9a4f";
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";
//Set TCP port to connect to
//$mail->Port = 587;
$mail->Port = 25;
$mail->From = "kkanchi@gmail.com";
$mail->FromName = "Kanchi";
$mail->addAddress("kkanchi@gmail.com", "Kanchi");
$mail->isHTML(true);
$mail->Subject = "Subject Text";
$mail->Body = "<i>Mail body in HTML</i>";
$mail->AltBody = "This is the plain text version of the email content";
if($mail->send()){
    echo "Message has been sent successfully";
}
?>