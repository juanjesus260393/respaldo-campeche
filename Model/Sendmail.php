<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';
require '../vendor/auxx.php';

function sendmail($usuario, $contraseña,$a){

$mail = new PHPMailer(true);             
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'isidro.biker@gmail.com';                 // SMTP username
    $mail->Password = EMAIL_PASS;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('isidro.biker@gmail.com.com', 'Mailer');
    //$mail->addAddress('isidro.biker@gmail.com', 'isidro');
    $mail->addAddress('guilmon333@gmail.com', 'juan');
   // $mail->addAddress($usuario, '');
    //// Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
   // $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'CUENTA';
    if($a===1){
        
        $mail->Body    = '<h3>Esta es la nueva información de tu cuenta</h3>'
                                . '<h3>Tu contraseña se cambio con exito</h3>'
                
                        . '<br><br>'
                        . 'Usuario: <h3>'.$usuario.'</h3>'
                        . 'Contraseña : <h3>'.$contraseña.'</h3>';
    }else {
    
    $mail->Body    = '<h3>Esta es la información de tu cuenta</h3>'
                        . '<br><br>'
                        . 'Usuario: <h3>'.$usuario.'</h3>'
                        . 'Contraseña : <h3>'.$contraseña.'</h3>';
    }
    $mail->AltBody = 'Esta es la información de tu cuenta'
                         . 'Usuario: '.$usuario.''
                        . 'Contraseña :'.$contraseña.'';
   
   $mail->SMTPDebug = false;
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}}