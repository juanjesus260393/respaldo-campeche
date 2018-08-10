<?php

//Funcion buscar cupones caducados
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('Conexion.php');

Class Cron2 {

    public function searchcuponscaducate() {
        //Buscar todos los cupones que expiraron
        $dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
//Obtener la cantidad de codigos que han sido generados
        $fa = date("Y-m-d");
        $sql = "SELECT c.titulo, u.username,c.id_cupon, count(q.id_codigo_qr) as total FROM codigo_qr q inner join cupon c on q.id_cupon = c.id_cupon inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto 
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

    public function senddeletecupon($areglo) {
        //Obtener elementos del array
        foreach ($areglo as $valor) {
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
            $mail->Subject = 'Eliminacion de Cupones';
            $mail->Body = '<h3>El siguiente cupon ha alcanzado el limite de codigos que se pueden generar y ha caducado se recomienda que se elimine si ha asi lo desea de lo contrario se le seguiran enviando correos</h3>'
                    . '<br><br>'
                    . 'Correo de contacto de la empresa : <h3>' . $tit . '</h3>'
                    . 'Titulo del Cupon : <h3>' . $ml . '</h3>';

            $mail->SMTPDebug = false;
            $mail->send();
            echo 'El mensaje delos cupones que han sido eliminados ha sido enviado';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    public function searchlimitcupons($areglo) {
        for ($i = 0; $i < count($areglo); $i++) {
            $id = $areglo[$i]["id_cupon"];
            $idro = $areglo[$i]["id_revision_objeto"];
            $titulo = $areglo[$i]["titulo"];
            $u = $areglo[$i]["username"];
            $e = $areglo[$i]["id_empresa"];
        }
        $info2 = array($id, $idro, $titulo, $u, $e);
        return $info2;
    }

}

//Proceso para el envio de correos
$validacion2 = new Cron2();
$aux = $validacion2->searchcuponscaducate();
//Si no existe ningun cupon caducado, que no realice nada
if ($aux == NULL) {
    exit();
} else {
    for ($i = 0; $i < count($aux); $i++) {
        $total = $aux[$i]["total"];
        $correo = $aux[$i]["username"];
        $titulo = $aux[$i]["titulo"];
        //Meter parametros en una lista
        $info = array($correo, $titulo);
        //Se envia el correo de los cupones que han caducado

        $dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        //Se obtiene la cantidad de codigos que han sido generados
        $sql = "SELECT c.id_cupon, c.id_revision_objeto,c.titulo, u.username,c.id_cupon,e.id_empresa ,count(q.id_codigo_qr) as total FROM codigo_qr q inner join cupon c on q.id_cupon = c.id_cupon inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto 
inner join empresa e on r.id_empresa = e.id_empresa inner join usuario_empresa u on e.id_membresia = u.id_empresa where
c.vigencia_fin <= '2018-08-10' group by c.id_cupon";
        foreach ($dbh->query($sql) as $res1) {
            $ccaducos2[] = $res1;
            $aux2 = $validacion2->searchlimitcupons($ccaducos2);
            //Si no se obtienen valores de los cupones que han caducado y tienen la misma cantidad de codigos generados se sale del programa
            if ($aux2 == NULL) {
                exit();
            }
            $id = $aux2[0];
            $ido = $aux2[1];
            $tt = $aux2[2];
            $us = $aux2[3];
            $ie = $aux2[4];
            //Se declara un arreglo en el que se enviaran los cupones que se han eliminado
            $info2 = array($tt, $us);
            //Se envia un correo con los cupones que han sido eliminados
            $aux3 = $validacion2->senddeletecupon($info2);
        }
    }
}




