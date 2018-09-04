<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');

class Cupones {

    public static function getuser($Stoken) {
        $dbh = Conectar::con();
        //Funcion para realizar la consulta de la ubicacion y regresar la laptitud y la longitud
        $cs = "select t.username from token t where t.token = '$Stoken';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra en la tabla empresa ni en la tabla authorities
        if (!$filas[0]) {
            header("HTTP/1.0 404 Not Found");
            exit();
        } else {
            $username = $filas['username'];
        }
        return $username;
    }

    public static function generate_cadenaqr($Stoken, $idcupon) {
        $dbh = Conectar::con();
        $username = Cupones::getuser($Stoken);
        $id_codigo_qr = '';
        $cs = "SELECT id_codigo_qr FROM codigo_qr where username = '$username' and id_cupon = '$idcupon';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra en la tabla empresa ni en la tabla authorities
        if (!$filas[0]) {
            
        } else {
            $id_codigo_qr = $filas['id_codigo_qr'];
        }
        return $id_codigo_qr;
    }

    public function get_idcupons($place_id) {
        $id_cupon = array();
        $dbh = Conectar::con();
        $fa = date('Y-m-d');
        $cs = "SELECT c.id_cupon from sitio s inner join empresa e on e.id_empresa = s.id_empresa inner join revision_objeto r 
on e.id_empresa = r.id_empresa inner join cupon c on r.id_revision_objeto = c.id_revision_objeto  
where r.status = 'A' and c.vigencia_inicio <= '$fa' and c.vigencia_fin >= '$fa' and s.id_sitio = '$place_id' group by c.id_cupon;";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        foreach ($result as $res) {
            $id_cupon[] = $res;
        }
        return $id_cupon;
    }

    public static function search_cupons_ofasite() {
        if (isset($_GET["place_id"])) {
            $cupones = array();
            $fa = date('Y-m-d');
            $place_id = $_GET["place_id"];
            $dbh = Conectar::con();
            $arr = apache_request_headers();
            $CTOKEN = $arr['Authorization'];
            $Cseparada = preg_split("/[\s,]+/", $CTOKEN, 4);
            $Stoken = $Cseparada[1];
            $idcupon = Cupones::get_idcupons($place_id);
            //Recorrer el arreglo hasta obtener todos los ids
            //echo json_encode($idcupon);
            $qr_string = Cupones::generate_cadenaqr($Stoken, $idcup);
            $cs = "SELECT c.id_cupon as coupon_id, c.id_imagen_vista_previa as preview_img_id, c.titulo as title, c.descripcion_corta as short_description,
c.descripcion_larga as long_description, c.id_imagen_extra as extra_img_id,date_format(c.vigencia_inicio, '%d/%m/%Y') as life_from, 
date_format(c.vigencia_fin, '%d/%m/%Y') as life_to, c.terminos_y_condiciones as terms_and_conditions,'$qr_string' as qr_string,s.nombre 
as place_name from sitio s inner join empresa e on e.id_empresa = s.id_empresa inner join revision_objeto r 
on e.id_empresa = r.id_empresa inner join cupon c on r.id_revision_objeto = c.id_revision_objeto  
where r.status = 'A' and c.vigencia_inicio <= '$fa' and c.vigencia_fin >= '$fa' and s.id_sitio = '$place_id' group by c.id_cupon;";

            $result = mysqli_query($dbh, $cs) or die(mysqli_error());
            foreach ($result as $res) {
                $cupones[] = $res;
            }

            return $cupones;
        } else {
            header("HTTP/1.0 400 Bad Request");
            die();
        }
    }

}

$cupones = array();
if (isset($_GET["place_id"])) {
    $cupones = Cupones::search_cupons_ofasite();
} else if (isset($_GET["only_from_user"])) {
    
}
echo json_encode($cupones);
