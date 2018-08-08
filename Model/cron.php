<?php

//Funcion buscar cupones caducados
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

Class Cron {

    function sendmailcupon($info) {
        //Obtener elementos del array
        foreach ($info as $valor) {
            $resultado[] = $valor;
        }
        //print_r($resultado);
        
            echo $resultado[0];
             echo $resultado[1];
        
    }

    public function searchcuponscaducate() {
        //Buscar todos los cupones que expiraron
        $dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
//Obtener la cantidad de codigos que han sido generados
        $fa = date("Y-m-d");
        $sql = "SELECT c.titulo, u.username,c.id_cupon, count(q.id_codigo_qr) as total FROM codigo_qr q inner join cupon c on q.id_cupon = c.id_cupon inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto 
inner join empresa e on r.id_empresa = e.id_empresa inner join usuario_empresa u on e.id_membresia = u.id_empresa where
c.vigencia_fin <= '$fa'  and q.canjeado = '1'  group by c.id_cupon;";
        if (empty($dbh->query($sql))) {
            $ccaducos[] = NULL;
            exit();
        } else {
            foreach ($dbh->query($sql) as $res1) {
                $ccaducos[] = $res1;
            }
        }
        return $ccaducos;
    }

    public function searchlimitcupons($areglo) {
        for ($i = 0; $i < count($areglo); $i++) {
            $id = $areglo[$i]["id_cupon"];
        }
        return $id;
    }

}

$validacion = new Cron();
$aux = $validacion->searchcuponscaducate();
for ($i = 0; $i < count($aux); $i++) {
    $total = $aux[$i]["total"];
    $correo = $aux[$i]["username"];
    $titulo = $aux[$i]["titulo"];
    //Meter parametros en una lista
    $info = array($correo, $titulo);
    //print_r($info);
    $sm = $validacion->sendmailcupon($info);
    //sendmailcupon($info);
    $dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
//Obtener la cantidad de codigos que han sido generados
    $sql = "Select c.id_cupon from cupon c inner join codigo_qr q on c.id_cupon = q.id_cupon where c.limite_codigos = '$total' group by c.id_cupon;";
    if (empty($dbh->query($sql))) {
        $ccaducos[] = NULL;
        exit();
    } else {
        foreach ($dbh->query($sql) as $res1) {
            $ccaducos[] = $res1;
            $aux2 = $validacion->searchlimitcupons($ccaducos);
            $aux2;
        }
    }
}



