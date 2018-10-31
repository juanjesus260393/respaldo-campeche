<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');
//Modal de publicidad el cual es el encargado de de proporcionar las funciones que necesita el ws de publicidad
class Ad {

    //Funcion que define el tipo de publicidad
    public static function define_type() {
        //Se calcula la publicad entre 1 y 100
        $prob = mt_rand(1, 100);
        $rtn = [];
        //Si la probabilidad es 70 se muestra un banner
        if ($prob <= 70) {
            $tipo = 'B';
        } else {
            //Si se encuentra entre 30% se muestra un flyer
            $tipo = 'F';
        }
        return $tipo;
    }

    //Funcion que busca un tipo de publicidad en base al tipo obtenido de la funcion define_type
    public static function search_register() {
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        $Ad = new Ad();
        //tipo de publicidad obtenido de la funcion define_type
        $tipo = $Ad->define_type();
        $cs = "SELECT a.id_ad, a.visualizaciones FROM ad a inner join revision_objeto r on a.id_revision_objeto = r.id_revision_objeto where a.tipo ='$tipo'  and r.status = 'A'  ORDER BY RAND() LIMIT 1;";
        $result = mysqli_query($pd, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra ningun registro se envia un arreglo vacio
        $extra = [];
        if (!$filas[0]) {
            $id = $extra;
            $vis= $extra;
        } else {
            //Si se encuentra un registro que coincida con la consulta se envia su identificador y sus visualozaciones 
            $id = $filas['id_ad'];
            $vis = $filas['visualizaciones'];
        }
        return array($id, $vis);
    }

    //Funcion que define el tipo de membresia en base al idenficador de membresia
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
//Funcion que actualiza la cantidad de visualizaciones que se obtienen de una publicidad
    public static function update_ad($id, $vis) {
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        $visulazciones = $vis + 1;
        $cs = "UPDATE ad SET visualizaciones = '$visulazciones' WHERE id_ad = '$id'";
        //Si la actualizacion no se ejecuta correctamente envia un emcabezado 201
        if (!mysqli_query($pd, $cs)) {
            header("HTTP/1.0 201 something wrong");
            mysqli_close($pd);
        } else {
            //Si la actualizacion se ejecuta correctamente enviar el mensaje 202 
            header("HTTP/1.0 202 ok");
            mysqli_close($pd);
        }
    }

    //Funcion que define el registro de la publicidad
    public static function define_register() {
        $conn = new Conectar();
        $pd = $conn->con();
        $Ad = new Ad();
        //Se busca el tipo de publicidad solicitado
        $id = $Ad->search_register();
        list($ida, $vis) = $id;
        $cs = "SELECT a.id_img as advert_id, a.tipo as type, m.id_membresia,a.url_sitio as web_url FROM empresa e inner join membresia m on e.id_membresia = m.id_membresia inner join revision_objeto r on
 e.id_empresa = r.id_empresa inner join ad a on r.id_revision_objeto = a.id_revision_objeto where a.id_ad = '$ida' group by a.id_ad;";
        $result = mysqli_query($pd, $cs) or die(mysqli_error());
        $filas2 = mysqli_fetch_array($result);
        //Si no se encuentra en la busquedad de la publicidad que no ha sido autorizada previamente
        if (!$filas2[0]) {
            $rtn = [];
        } else {
            //Si la busquedad arroja un resultado se envia la informacion de la publicidad codificada
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
include 'mdlSeguridad.php';
$Ads = Ad::define_register();
echo json_encode($Ads);
