<?php
require_once(LIB_PATH_INC."vendor/PHPMailer/PHPMailer.php");
require_once(LIB_PATH_INC."vendor/PHPMailer/SMTP.php");
require_once(LIB_PATH_INC."vendor/PHPMailer/PHPMailer.php");

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = MAILTRAP_HOST;
$mail->SMTPAuth = true;
$mail->Username = MAILTRAP_USER;
$mail->Password = MAILTRAP_PASSWORD;
$mail->SMTPSecure = 'tls';
$mail->Port = MAILTRAP_PORT;
$mail->CharSet = 'UTF-8';


function send_email($email, $code){
    global $mail;
    $mail->setFrom('info@mailtrap.io', 'Mailtrap');
    $mail->Subject = 'Test Email via Mailtrap SMTP using PHPMailer';
    $mail->addAddress('recipient1@mailtrap.io', 'Tim'); 
    $mailContent = "Código de Verificación: " . $code;
    $mail->Body = $mailContent;
    // $mail->send()
    if($mail->send()){
        echo '<strong style="color:red;">El mensaje fue enviado!</strong>';
    }else{
        echo 'El mensaje no ha sido enviado.';
        echo 'Ha ocurrido el siguiente error: ' . $mail->ErrorInfo;
    }
}