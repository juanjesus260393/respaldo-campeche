<?php

//Buscar todos los codigos de todos los cupones
$dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
//Obtener la cantidad de codigos que han sido generados
$fa = date("Y-m-d");
$sql2 = "Select c.id_cupon from cupon c where c.vigencia_fin <= '2018/08/07';";
if (empty($dbh->query($sql2))) {
    $platillo2[] = NULL;
    exit();
} else {
    foreach ($dbh->query($sql2) as $res2) {
        $platillo2[] = $res2;
    }
    //Se desplaza el resultado de la busquedad de los cupones que han sido cambiados
    for ($i = 0; $i < count($platillo2); $i++) {
        $sql3 = "SELECT c.titulo,c.id_cupon ,count(q.id_codigo_qr) as total FROM codigo_qr q inner join cupon c on  q.id_cupon = c.id_cupon  where c.id_cupon = ".$platillo2[$i]["id_cupon"]." group by c.id_cupon;";
        if (empty($dbh->query($sql3))) {
            $platillo3[] = NULL;
            exit();
        } else {
            foreach ($dbh->query($sql3) as $res3) {
                print_r($platillo3[] = $res3);
            }   
            
        }
    }
    for ($i = 0; $i < count($platillo3); $i++) {
                $platillo3[$i]["id_cupon"];
            }
}


  