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
    $mail->setFrom('isidro.biker@gmail.com', 'Mailer');
    $mail->addAddress('isidro.biker@gmail.com', 'isidro');
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

function sendmailComentario($usuario, $comentario,$a){

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
    $mail->setFrom('isidro.biker@gmail.com', 'Mailer');
    $mail->addAddress('isidro.biker@gmail.com', 'isidro');
    //$mail->addAddress('guilmon333@gmail.com', 'juan');
   // $mail->addAddress($usuario, '');
    //// Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
   // $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    
    $mail->isHTML(true);                                  // Set email format to HTML
    
    switch ($a){
        case 'C':
        $mail->Subject = 'Cupon Rechazado  ';
        $mail->Body    = '<p><img src="http://148.204.63.167/campeche-web2/Imagenes/correo/encabezado.png"></p>'
                . '<h3>Tu Cupon ha sido Rechazado por favor</h3>'
                                . '<h3>reviza tu información y el motivo de rechazo </h3>'
                
                        . '<br><br>'
                        . 'Usuario: <h3>'.$usuario.'</h3>'
                        . 'Comentario : <h3>'.$comentario.'</h3>'
                . '<p><img src="http://148.204.63.167/campeche-web2/Imagenes/correo/pie.png"></p>';
            break;
        case 'S':
    $mail->Subject = 'Cupon aceptado ';
     $mail->Body    = '<p><img src="http://148.204.63.167/campeche-web2/Imagenes/correo/encabezado.png"></p>'
             . '<h3>Tu Cupon ha sido aceptado </h3>'
                                . '<h3>reviza tu información</h3>'
                
                        . '<br><br>'
                        . 'Usuario: <h3>'.$usuario.'</h3>'
                        . 'Comentario : <h3>'.$comentario.'</h3>'
             . '<p><img src="http://148.204.63.167/campeche-web2/Imagenes/correo/pie.png"></p>';
            break;
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


function sendmailComentarioAS($usuario, $comentario,$a){


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
    $mail->setFrom('isidro.biker@gmail.com', 'Mailer');
    $mail->addAddress('isidro.biker@gmail.com', 'isidro');
    //$mail->addAddress('guilmon333@gmail.com', 'juan');
   // $mail->addAddress($usuario, '');
    //// Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
   // $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    
    $mail->isHTML(true);                                  // Set email format to HTML
    
    switch ($a){
        case 'C':


        $mail->Subject = 'Sitio  Aceptado';
        $mail->Body    ='<h3>Aceptado, se va a publicar</h3>'

                
                        . '<br><br>'
                        . 'Usuario: <h3>'.$usuario.'</h3>'
                        . 'Comentario : <h3>'.$comentario.'</h3>';
            break;
        case 'S':
     $mail->Subject = 'Sitio  Rechazado';
        $mail->Body    ='<h3>ha sido rechazado ,no se va a publicar  reviza el motivo</h3>'
                
                        . '<br><br>'
                        . 'Usuario: <h3>'.$usuario.'</h3>'
                        . 'Comentario : <h3>'.$comentario.'</h3>';
            break;
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



function sendmailCVid($usuario, $comentario,$a, $nombre){

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
    $mail->setFrom('isidro.biker@gmail.com', 'Mailer');
    $mail->addAddress('isidro.biker@gmail.com', 'isidro');
    //$mail->addAddress('guilmon333@gmail.com', 'juan');
   // $mail->addAddress($usuario, '');
    //// Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
   // $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    
    $mail->isHTML(true);                                  // Set email format to HTML
    
    switch ($a){
        case 'C':
        $mail->Subject = 'Video Rechazado  ';
        $mail->Body    = '<h3>Tu video ha sido Rechazado por favor</h3>'
                                . '<h3>reviza tu información y el motivo de rechazo </h3>'
                
                        . '<br><br>'
                        . 'Usuario: <h3>'.$usuario.'</h3>'
                        . 'Video: <h3>'.$nombre.'</h3>'
                        . 'Comentario : <h3>'.$comentario.'</h3>';
            break;
        case 'S':
    $mail->Subject = 'Video aceptado ';
     $mail->Body    = '<h3>Tu Video ha sido aceptado </h3>'
                            . 'Video: <h3>'.$nombre.'</h3>'
                                . '<h3>reviza tu información</h3>'
                
                        . '<br><br>'
                        . 'Usuario: <h3>'.$usuario.'</h3>'
                        . 'Comentario : <h3>'.$comentario.'</h3>';
            break;
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