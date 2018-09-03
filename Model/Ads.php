<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');

class Ad {

    //Funcion definir tipo
    public static function define_type() {
        $prob = mt_rand(1, 100);
        $rtn = [];
        if ($prob <= 70) {
            $tipo = 'B';
        } else {
            $tipo = 'F';
        }
        return $tipo;
    }

    //Buscar registro
    public static function search_register() {
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        $Ad = new Ad();
        $tipo = $Ad->define_type();
        $cs = "SELECT a.id_ad, a.visualizaciones FROM ad a inner join revision_objeto r on a.id_revision_objeto = r.id_revision_objeto where a.tipo ='$tipo'  and r.status = 'A'  ORDER BY RAND() LIMIT 1;";
        $result = mysqli_query($pd, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra en la tabla empresa ni en la tabla authorities
        $extra = [];
        if (!$filas[0]) {
            $id = $extra;
        } else {
            $id = $filas['id_ad'];
            $vis = $filas['visualizaciones'];
        }
        return array($id, $vis);
    }

    //Define membership
    public static function define_membership($id_membresia) {
        if ($id_membresia == '3') {
            $company_membership = 'T';
        } else if ($id_membresia == '2') {
            $company_membership = 'P';
        } else if ($id_membresia == '1') {
            $company_membership = 'S';
        }
        return $company_membership;
    }

    public static function update_ad($id, $vis) {
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        $visulazciones = $vis + 1;
        $cs = "UPDATE ad SET visualizaciones = '$visulazciones' WHERE id_ad = '$id'";
        if (!mysqli_query($pd, $cs)) {
            header("HTTP/1.0 201 something wrong");
            mysqli_close($pd);
        } else {
            header("HTTP/1.0 202 ok");
            mysqli_close($pd);
        }
    }

    //Definir registro
    public static function define_register() {
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        $Ad = new Ad();
        $id = $Ad->search_register();
        list($ida, $vis) = $id;
        $cs = "SELECT a.id_img as advert_id, a.tipo as type, m.id_membresia,a.url_sitio as web_url FROM empresa e inner join membresia m on e.id_membresia = m.id_membresia inner join revision_objeto r on
 e.id_empresa = r.id_empresa inner join ad a on r.id_revision_objeto = a.id_revision_objeto where a.id_ad = '$ida' group by a.id_ad;";
        $result = mysqli_query($pd, $cs) or die(mysqli_error());
        $filas2 = mysqli_fetch_array($result);
        //Si no se encuentra en la tabla empresa ni en la tabla authorities
        if (!$filas2[0]) {
            $rtn = [];
        } else {
            $Ad->update_ad($ida, $vis);
            $advert_id = $filas2['advert_id'];
            $type = $filas2['type'];
            $id_membresia = $filas2['id_membresia'];
            $web_url = $filas2['web_url'];
            $company_membership = $Ad->define_membership($id_membresia);
            $rtn["advert_id"] = $advert_id;
            $rtn["type"] = $type;
            $rtn["company_membership"] = $company_membership;
            $rtn["web_url"] = $web_url;
        }
        return $rtn;
    }

}

$Ads = Ad::define_register();
echo json_encode($Ads);
