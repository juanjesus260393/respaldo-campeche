<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');

//Modelo que se encarga de obtener los cupones que seran visualizados en el dispositivo movil
class Cupones {

//Funcion que se encarga de obtener el nombre de usuario
    public static function getuser($Stoken) {
        $dbh = Conectar::con();
        $cs = "select t.username from token t where t.token = '$Stoken';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra un regitro que coincida con el token se envia el mensaje 404
        if (!$filas[0]) {
            header("HTTP/1.0 404 Not Found");
            exit();
        } else {
            //Si existe un registro se envia el nombre de usuario
            $username = $filas['username'];
        }
        return $username;
    }

//Funcion que se encarga de preparar la cadena que se encriptara
    public static function preparedqrstring($ic, $icqr) {
        $plaintext = $ic . "|" . $icqr;
        $encrypted = Cupones::openCypher('encrypt', $plaintext);
        return $encrypted;
    }

//Funcion que se encarga de encriptar y decriptar 
    public static function openCypher($action = 'encrypt', $string = false) {
        $action = trim($action);
        $output = false;
//Clave para realizar la encriptacion
        $myKey = 'oW%c76+jb2';
        $myIV = 'A)2!u467a^';
        //Metodo de encriptacion
        $encrypt_method = 'AES-256-CBC';

        $secret_key = hash('sha256', $myKey);
        $secret_iv = substr(hash('sha256', $myIV), 0, 16);
//Seleccion de la funcion ya sea encriptacion o desencriptacion de una cadena
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

//Funcion que se encarga de generar la cadena qr que se asociara a un cupon
    public static function generate_cadenaqr($Stoken, $idcupon) {
        $codigoqr = NULL;
        $dbh = Conectar::con();
        //Funcion que obtiene el nombre del turista en base al token
        $username = Cupones::getuser($Stoken);
        //Consulta que busca obtener el registro de un cupon registrado en base al nomre de usuario y el identificadod del cuppon
        $cs = "SELECT id_codigo_qr, id_cupon FROM codigo_qr where username = '$username' and id_cupon = '$idcupon';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        if ($result) {
            foreach ($result as $res) {
                $cqr = $res['id_codigo_qr'];
                $cupon = $res['id_cupon'];
                //Funcion que se encarga de generar cadena asociada a un codigo qr 
                $codigoqr = Cupones::preparedqrstring($cupon, $cqr);
            }
        }
        return $codigoqr;
    }

//Funcion que se encarga de obtener los identificadores de los cupones vigentes
    public static function get_idcupons($place_id) {
        $id_cupon = array();
        $dbh = Conectar::con();
        $fa = date('Y-m-d');
        //Consulta de los identificadores de los cupones que se encuentran vigentes
        $cs = "SELECT c.id_cupon from sitio s inner join empresa e on e.id_empresa = s.id_empresa inner join revision_objeto r 
on e.id_empresa = r.id_empresa inner join cupon c on r.id_revision_objeto = c.id_revision_objeto  
where r.status = 'A' and c.vigencia_inicio <= '$fa' and c.vigencia_fin >= '$fa' and s.id_sitio = '$place_id' group by c.id_cupon;";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        foreach ($result as $res) {
            $id_cupon[] = $res;
        }
        //Se regresa un areglo con estos identificadores en caso de que no exista ninguno  se regresa un arreglo vacio
        return $id_cupon;
    }

//Funcion que solicita el identificador de un cupon que hubiera solicitado
    public static function get_idcuponssolicitud($Stoken) {
        $id_cupon = array();
        $dbh = Conectar::con();
        $username = Cupones::getuser($Stoken);
        //Consulta de los identificadores de los cupones que se hayan solicitado
        $cs = "SELECT q.id_cupon FROM codigo_qr q where q.username = '$username';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        foreach ($result as $res) {
            $id_cupon[] = $res;
        }
        //Se regresa un areglo con estos identificadores en caso de que no exista ninguno se regresa un arreglo vacio
        return $id_cupon;
    }

//Funcion que se encarga de obtener la informacion de un cupon en base al identificador del cupon y del sitio es para los sitios que tienen cupones asociados
    //La cadenaqr se obtiene de una funcion previa
    public static function get_cupons($qr_string, $place_id, $idcup) {
        $cuponns = array();
        $dbh = Conectar::con();
        $fa = date('Y-m-d');
        $cs = "SELECT c.id_cupon as coupon_id, c.id_imagen_vista_previa as preview_img_id, c.titulo as title, c.descripcion_corta as short_description,
c.descripcion_larga as long_description, c.id_imagen_extra as extra_img_id,date_format(c.vigencia_inicio, '%d/%m/%Y') as life_from, 
date_format(c.vigencia_fin, '%d/%m/%Y') as life_to, c.terminos_y_condiciones as terms_and_conditions,'$qr_string' as qr_string from sitio s inner join empresa e on e.id_empresa = s.id_empresa inner join revision_objeto r 
on e.id_empresa = r.id_empresa inner join cupon c on r.id_revision_objeto = c.id_revision_objeto  
where r.status = 'A' and c.vigencia_inicio <= '$fa' and c.vigencia_fin >= '$fa' and s.id_sitio = '$place_id' and c.id_cupon = '$idcup' group by c.id_cupon;";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        foreach ($result as $res) {
            $cuponns = $res;
        }
        //Se regresa un areglo con la informacion de los cupones en caso de que no exista un registro se regresa un arreglo vacio
        return $cuponns;
    }

//Funcion que se encarga de obtener los cupones de un turista
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
        //En caso de que no exista ningun registro que coincida con los parametros de la consulta regresa un arreglo vacio.
        return $cuponns;
    }

//Funcion que se encarga de obtener los cupones cercanos en un radio de 2 kilometros
    public static function get_cupons_near($distance, $qr_string, $idcup) {
        $cuponns = array();
        $dbh = Conectar::con();
        $fa = date('Y-m-d');
        //consulta de los cupones que se encuentran cerca asi como las distancia aproximada al sitio, la distancia puede variar dependiendo
        //Del comportamiento del dispositivo.
        $cs = "SELECT c.id_cupon as coupon_id, c.id_imagen_vista_previa as preview_img_id, c.titulo as title, c.descripcion_corta as short_description,
c.descripcion_larga as long_description, c.id_imagen_extra as extra_img_id,date_format(c.vigencia_inicio, '%d/%m/%Y') as life_from, 
date_format(c.vigencia_fin, '%d/%m/%Y') as life_to, c.terminos_y_condiciones as terms_and_conditions,'$qr_string' as qr_string,'$distance' as distance,s.nombre 
as place_name from sitio s inner join empresa e on e.id_empresa = s.id_empresa inner join revision_objeto r 
on e.id_empresa = r.id_empresa inner join cupon c on r.id_revision_objeto = c.id_revision_objeto  
where r.status = 'A' and c.vigencia_inicio <= '$fa' and c.vigencia_fin >= '$fa' and c.id_cupon = '$idcup' group by c.id_cupon;";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        foreach ($result as $res) {
            $cuponns = $res;
        }
//Si no existe ningun registro que coincida con la consulta se enviar un arreglo vacio
        return $cuponns;
    }

//Funcion que obtiene los cupones de un sitio
    public static function search_cupons_ofasite() {
        if (isset($_GET["place_id"])) {
            $cupones = array();
            $place_id = $_GET["place_id"];
            $arr = apache_request_headers();
            $CTOKEN = $arr['Authorization'];
            $Cseparada = preg_split("/[\s,]+/", $CTOKEN, 4);
            $Stoken = $Cseparada[1];
            //Funcion que obtiene los idenfificadores de los cupones
            $idcupon = Cupones::get_idcupons($place_id);
            for ($i = 0; $i < count($idcupon); $i++) {
                $idcup = $idcupon[$i]["id_cupon"];
                //Funcion que se encarga de generar las cadenas qr
                $qr_string = Cupones::generate_cadenaqr($Stoken, $idcup);
                //Funcion que obtiene los cupones de un sitio
                $cupones [] = Cupones::get_cupons($qr_string, $place_id, $idcup);
            }
            return $cupones;
        } else {
            //En caso de que no se obtenga el identificador del cupon y se quiera acceder a esta funcion envia el mensaje 400
            header("HTTP/1.0 400 Bad Request");
            die();
        }
    }

//Funcion que obtiene los cupones de un turista
    public static function search_cupons_ofaturist() {
        if (isset($_GET["only_from_user"])) {
            $cupones = array();
            $arr = apache_request_headers();
            $CTOKEN = $arr['Authorization'];
            $Cseparada = preg_split("/[\s,]+/", $CTOKEN, 4);
            $Stoken = $Cseparada[1];
            //Funcion que busca los cupones que un turista haya solicitado previamente
            $idcupon = Cupones::get_idcuponssolicitud($Stoken);
            for ($i = 0; $i < count($idcupon); $i++) {
                $idcup = $idcupon[$i]["id_cupon"];
                //Funcion que se encarga de generar las cadenas qr
                $qr_string = Cupones::generate_cadenaqr($Stoken, $idcup);
                //Funcion que obtiene los cupones que haya solicitado un turista
                $cupones [] = Cupones::get_cuponsofaturist($qr_string, $idcup);
            }
            return $cupones;
        } else {
            header("HTTP/1.0 400 Bad Request");
            die();
        }
    }

//Funcion que se encarga de obtener la informacion
    public static function search_cupons_near() {
        if (isset($_GET["latitude"]) && isset($_GET["longitude"])) {
            $lat = $_GET["latitude"];
            $lon = $_GET["longitude"];
            $p = $lat . "" . $lon;
            $radio = "2.0";
            $idioma = "ES";
            //Funcion que obtiene el area del dispositivo
            $selA = Cupones::select_area($p, $radio, $idioma);
        } else {
            header("HTTP/1.0 400 Bad Request");
            die();
        }
    }

//Funcion que obtiene la ubicacion de un sitio  que tenga cupones asociados
    public static function getDistanceofsites() {
        $fa = date('Y-m-d');
        $ubicaciones = array();
        $dbh = Conectar::con();
        $cs = "SELECT ST_X(i.ubicacionGIS) as latitudeos, ST_Y(i.ubicacionGIS) as longitudeos, c.id_cupon FROM revision_informacion i 
inner join sitio s on s.id_sitio = i.id_sitio inner join empresa e on e.id_empresa = s.id_empresa inner join revision_objeto r 
on e.id_empresa = r.id_empresa inner join cupon c on r.id_revision_objeto = c.id_revision_objeto where i.status = 'A' and r.status = 'A' 
and c.vigencia_inicio <= '$fa' and c.vigencia_fin >= '$fa' group by c.id_cupon;";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        foreach ($result as $res) {
            $ubicaciones[] = $res;
        }
        return $ubicaciones;
    }

//Funcuion que se encarga de obtener la distancia de un sitio
    public static function getDistance($latitude, $longitude) {
        $cupons = array();
        $cupons2 = array();
        $lato = $latitude;
        $logo = $longitude;
        //Funcion encarga de obtener las ubicaciones de sitios que tienen cupones asociados
        $posiciones = Cupones::getDistanceofsites();
        if ($posiciones == NULL) {
            $cupons = $cupons2;
        } else {
            for ($i = 0; $i < count($posiciones); $i++) {
                $lat = $posiciones[$i]["latitudeos"];
                $lon = $posiciones[$i]["longitudeos"];
                $arr = apache_request_headers();
                $CTOKEN = $arr['Authorization'];
                $Cseparada = preg_split("/[\s,]+/", $CTOKEN, 4);
                $Stoken = $Cseparada[1];
                //Funcion encargada de obtener la distancia
                $distance = Cupones::vincentyGreatCircleDistance(floatval($latitude), floatval($longitude), floatval($lat), floatval($lon));
                if (Cupones::isNearby($distance)) {
                    $idcup = $posiciones[$i]["id_cupon"];
                    //Funcion encargada de genear la cadena del codigo qr
                    $qr_string = Cupones::generate_cadenaqr($Stoken, $idcup);
                    //Funcion que se encarga de obtener cupones cerca del dispositivo en un radio de unkilometro
                    $cupons [] = Cupones::get_cupons_near($distance, $qr_string, $idcup);
                }
            }
        }
        return $cupons;
    }

//Funcion que mide la distaancia
    public static function isNearby($distance) {
        if ($distance <= 1000 /* 1 km */) {
            return true;
        }
        return false;
    }

//Funcion que mide la distancia en base a la direccion del sitio y la direccion del dispositivo movil
    public static function vincentyGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
                pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
    }

}

include 'mdlSeguridad.php';
$cupones = array();
if (isset($_GET["place_id"])) {
    $cupones = Cupones::search_cupons_ofasite();
} else if (isset($_GET["only_from_user"])) {
    $cupones = Cupones::search_cupons_ofaturist();
} else if (isset($_GET["latitude"]) && isset($_GET["longitude"])) {
    $latitude = $_GET["latitude"];
    $longitude = $_GET["longitude"];
    $cupones = Cupones::getDistance($latitude, $longitude);
}
echo json_encode($cupones);
