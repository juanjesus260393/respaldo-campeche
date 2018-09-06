<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');

class Codigos {

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

    public static function getlimitcodes($ic) {
        $dbh = Conectar::con();
        //Funcion para realizar la consulta de la ubicacion y regresar la laptitud y la longitud
        $cs = "select c.limite_codigos from cupon c where c.id_cupon = '$ic';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra en la tabla empresa ni en la tabla authorities
        if (!$filas[0]) {
            header("HTTP/1.0 404 Not Found");
            exit();
        } else {
            $lc = $filas['limite_codigos'];
        }
        return $lc;
    }

    public static function getcountofcodes($ic) {
        $dbh = Conectar::con();
        //Funcion para realizar la consulta de la ubicacion y regresar la laptitud y la longitud
        $cs = "select count(q.id_codigo_qr) as total from codigo_qr q where q.id_cupon = '$ic' and q.canjeado = '0';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra en la tabla empresa ni en la tabla authorities
        if (!$filas[0]) {
            $lc = '0';
        } else {
            $lc = $filas['total'];
        }
        return $lc;
    }

    public static function determinate_cupon($lc, $ccc) {
        if ($lc < $ccc) {
            $determinate = 'FALSE';
        } else {
            $determinate = 'TRUE';
        }
        return $determinate;
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

    public static function preparedqrstring($ic, $icqr) {
        $plaintext = $ic . "|" . $icqr;
        $encrypted = Codigos::openCypher('encrypt', $plaintext);
        return $encrypted;
    }

    public static function preparedregister($ic, $token) {
        $rtn = array();
        $dbh = Conectar::con();
        $na = new validacion();
        $username = Codigos::getuser($token);
        $icqr = $na->generar_aleatorio();
        $sql2 = "INSERT INTO codigo_qr(id_codigo_qr,id_cupon,username,canjeado)
        VALUES('$icqr','$ic','$username','0')";
        if (!mysqli_query($dbh, $sql2)) {
            die('Error: ' . mysqli_error($dbh));
        } else {
            $qr_string = Codigos::preparedqrstring($ic, $icqr);
            $rtn["qr_string"] = $qr_string;
        }
        return $rtn;
    }

    public static function register_codigoqr() {
        $ic = $_GET["coupon_id"];
        $lc = Codigos::getlimitcodes($ic);
        $ccc = Codigos::getcountofcodes($ic);
        $determinate = Codigos::determinate_cupon($lc, $ccc);
        if ($determinate == TRUE) {
            $arr = apache_request_headers();
            $CTOKEN = $arr['Authorization'];
            $Cseparada = preg_split("/[\s,]+/", $CTOKEN, 4);
            $Stoken = $Cseparada[1];
            $register = Codigos::preparedregister($ic, $Stoken);
        } else {
            header("HTTP/1.0 404 Not Found");
            exit();
        }
        return $register;
    }

}

$Codigos = array();
if (isset($_GET["coupon_id"])) {
    $Codigos = Codigos::register_codigoqr();
} else if (isset($_GET["qr_string"])) {
    
}
echo json_encode($Codigos);
