<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once("PHPMailer/src/PHPMailer.php");
require_once("PHPMailer/src/SMTP.php");
require_once("PHPMailer/src/Exception.php");

$mail = new PHPMailer;
$mail->CharSet = "UTF-8";
$mail->Encoding = "base64"; // format d'encodage des données
$mail->isSMTP();
$mail->SMTPDebug = 0; 
$mail->Port = 587;
$mail->SMTPSecure = "tls"; // protocole
$mail->SMTPAuth = true;

/* Gmail config: */
$mail->Username = "hardwareunit.contact@gmail.com";
$mail->Host = "smtp.gmail.com";
$mail->setFrom("hardwareunit.contact@gmail.com", 'HardwareUnit');

$mail->Password = "Hardwareunit1";

// fonction envoie de mail (merci Thomas L)
function send_mail($to, $subject, $body, $is_html = true)
{
    global $mail;
    $mail->AddAddress($to);
    $mail->Subject = $subject;
    $mail->isHTML($is_html);
    $mail->Body = $body;
    $mail->Send();
}
?>