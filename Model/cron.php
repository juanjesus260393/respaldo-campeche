<?php

//Funcion buscar cupones caducados
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('Conexion.php');

Class Cron {

    public function searchcuponscaducate() {
        //Buscar todos los cupones que expiraron
        $dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
//Obtener la cantidad de codigos que han sido generados
        $fa = date("Y-m-d");
        $sql = "SELECT c.titulo, u.username,c.id_cupon FROM cupon c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto 
inner join empresa e on r.id_empresa = e.id_empresa inner join usuario_empresa u on e.id_membresia = u.id_empresa where
c.vigencia_fin <= '$fa' group by c.id_cupon;";
        foreach ($dbh->query($sql) as $res1) {
            $ccaducos[] = $res1;
            if ($ccaducos[0] == 0) {
                exit();
            }
        }
        return $ccaducos;
    }

    function sendmailcupon($info) {
        //Obtener elementos del array
        foreach ($info as $valor) {
            $resultado[] = $valor;
        }
        $ml = $resultado[0];
        $tit = $resultado[1];
        //Enviar correos de los cupones que han caducado
        //Load Composer's autoloader
        require '../vendor/autoload.php';
        require '../vendor/auxx.php';
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
            $mail->addAddress('guilmon333@gmail.com', 'juan');
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Cupones que han caducado';
            $mail->Body = '<h3>El siguiente Cupon ha caducado</h3>'
                    . '<br><br>'
                    . 'Correo de contacto de la empresa : <h3>' . $ml . '</h3>'
                    . 'Titulo del Cupon : <h3>' . $tit . '</h3>';

            $mail->SMTPDebug = false;
            $mail->send();
            echo 'El mensaje de los cupones que han caducado ha sido enviado';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

}

//Proceso para el envio de correos
$validacion = new Cron();
$aux = $validacion->searchcuponscaducate();
//Si no existe ningun cupon caducado, que no realice nada
if ($aux == NULL) {
    exit();
} else {
    for ($i = 0; $i < count($aux); $i++) {
        $correo = $aux[$i]["username"];
        $titulo = $aux[$i]["titulo"];
        //Meter parametros en una lista
        $info = array($correo, $titulo);
        //Se envia el correo de los cupones que han caducado
        $sm = $validacion->sendmailcupon($info);
    }
}


