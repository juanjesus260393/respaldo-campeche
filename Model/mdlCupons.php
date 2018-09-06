<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
//require_once('mdlCodigoqr.php');
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

    public static function preparedqrstring($ic, $icqr) {
        $plaintext = $ic . "|" . $icqr;
        $encrypted = Cupones::openCypher('encrypt', $plaintext);
        return $encrypted;
    }

    public static function openCypher($action = 'encrypt', $string = false) {
        $action = trim($action);
        $output = false;

        $myKey = 'oW%c76+jb2';
        $myIV = 'A)2!u467a^';
        $encrypt_method = 'AES-256-CBC';

        $secret_key = hash('sha256', $myKey);
        $secret_iv = substr(hash('sha256', $myIV), 0, 16);

        if ($action && ($action == 'encrypt' || $action == 'decrypt') && $string) {
            $string = trim(strval($string));

            if ($action == 'encrypt') {
                $output = openssl_encrypt($string, $encrypt_method, $secret_key, 0, $secret_iv);
            };

            if ($action == 'decrypt') {
                $output = openssl_decrypt($string, $encrypt_method, $secret_key, 0, $secret_iv);
            };
        };

        return $output;
    }

    public static function generate_cadenaqr($Stoken, $idcupon) {
        $codigoqr = NULL;
        $dbh = Conectar::con();
        $username = Cupones::getuser($Stoken);
        $cs = "SELECT id_codigo_qr, id_cupon FROM codigo_qr where username = '$username' and id_cupon = '$idcupon';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        if ($result) {
            foreach ($result as $res) {
                $cqr = $res['id_codigo_qr'];
                $cupon = $res['id_cupon'];
                $codigoqr = Cupones::preparedqrstring($cupon, $cqr);
            }
        }
        return $codigoqr;
    }

    public static function get_idcupons($place_id) {
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

    public static function get_idcuponssolicitud($Stoken) {
        $id_cupon = array();
        $dbh = Conectar::con();
        $username = Cupones::getuser($Stoken);
        $cs = "SELECT q.id_cupon FROM codigo_qr q where q.username = '$username';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        foreach ($result as $res) {
            $id_cupon[] = $res;
        }
        return $id_cupon;
    }

    public static function get_cupons($qr_string, $place_id, $idcup) {
        $cuponns = array();
        $dbh = Conectar::con();
        $fa = date('Y-m-d');
        $cs = "SELECT c.id_cupon as coupon_id, c.id_imagen_vista_previa as preview_img_id, c.titulo as title, c.descripcion_corta as short_description,
c.descripcion_larga as long_description, c.id_imagen_extra as extra_img_id,date_format(c.vigencia_inicio, '%d/%m/%Y') as life_from, 
date_format(c.vigencia_fin, '%d/%m/%Y') as life_to, c.terminos_y_condiciones as terms_and_conditions,'$qr_string' as qr_string,s.nombre 
as place_name from sitio s inner join empresa e on e.id_empresa = s.id_empresa inner join revision_objeto r 
on e.id_empresa = r.id_empresa inner join cupon c on r.id_revision_objeto = c.id_revision_objeto  
where r.status = 'A' and c.vigencia_inicio <= '$fa' and c.vigencia_fin >= '$fa' and s.id_sitio = '$place_id' and c.id_cupon = '$idcup' group by c.id_cupon;";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        foreach ($result as $res) {
            $cuponns = $res;
        }
        return $cuponns;
    }

    public static function get_cuponsofaturist($qr_string, $idcup) {
        $cuponns = array();
        $dbh = Conectar::con();
        $fa = date('Y-m-d');
        $cs = "SELECT c.id_cupon as coupon_id, c.id_imagen_vista_previa as preview_img_id, c.titulo as title, c.descripcion_corta as short_description,
c.descripcion_larga as long_description, c.id_imagen_extra as extra_img_id,date_format(c.vigencia_inicio, '%d/%m/%Y') as life_from, 
date_format(c.vigencia_fin, '%d/%m/%Y') as life_to, c.terminos_y_condiciones as terms_and_conditions,'$qr_string' as qr_string,s.nombre 
as place_name from sitio s inner join empresa e on e.id_empresa = s.id_empresa inner join revision_objeto r 
on e.id_empresa = r.id_empresa inner join cupon c on r.id_revision_objeto = c.id_revision_objeto  
where r.status = 'A' and c.vigencia_inicio <= '$fa' and c.vigencia_fin >= '$fa' and c.id_cupon = '$idcup' group by c.id_cupon;";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        foreach ($result as $res) {
            $cuponns = $res;
        }
        return $cuponns;
    }

    public static function search_cupons_ofasite() {
        if (isset($_GET["place_id"])) {
            $fa = date('Y-m-d');
            $place_id = $_GET["place_id"];
            $arr = apache_request_headers();
            $CTOKEN = $arr['Authorization'];
            $Cseparada = preg_split("/[\s,]+/", $CTOKEN, 4);
            $Stoken = $Cseparada[1];
            $idcupon = Cupones::get_idcupons($place_id);
            for ($i = 0; $i < count($idcupon); $i++) {
                $idcup = $idcupon[$i]["id_cupon"];
                $qr_string = Cupones::generate_cadenaqr($Stoken, $idcup);
                $cupones [] = Cupones::get_cupons($qr_string, $place_id, $idcup);
            }
            return $cupones;
        } else {
            header("HTTP/1.0 400 Bad Request");
            die();
        }
    }

    public static function search_cupons_ofaturist() {
        if (isset($_GET["only_from_user"])) {
            $fa = date('Y-m-d');
            $arr = apache_request_headers();
            $CTOKEN = $arr['Authorization'];
            $Cseparada = preg_split("/[\s,]+/", $CTOKEN, 4);
            $Stoken = $Cseparada[1];
            $idcupon = Cupones::get_idcuponssolicitud($Stoken);
            for ($i = 0; $i < count($idcupon); $i++) {
                $idcup = $idcupon[$i]["id_cupon"];
                $qr_string = Cupones::generate_cadenaqr($Stoken, $idcup);
                $cupones [] = Cupones::get_cuponsofaturist($qr_string, $idcup);
            }
            return $cupones;
        } else {
            header("HTTP/1.0 400 Bad Request");
            die();
        }
    }

    public static function select_area($p, $radio, $idioma) {
        
        
    }

    public static function search_cupons_near() {
        if (isset($_GET["latitude"]) && isset($_GET["longitude"])) {
            $lat = $_GET["latitude"];
            $lon = $_GET["longitude"];
            $p = $lat . "" . $lon;
            $radio = "2.0";
            $idioma = "ES";
            $selA = Cupones::select_area($p, $radio, $idioma);
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
    $cupones = Cupones::search_cupons_ofaturist();
} else if (isset($_GET["only_from_user"])) {
    $cupones = Cupones::search_cupons_ofaturist();
} else if (isset($_GET["latitude"]) && isset($_GET["longitude"])) {
    $cupones ;
}
echo json_encode($cupones);
