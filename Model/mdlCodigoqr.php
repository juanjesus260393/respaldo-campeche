<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');

class Codigos {

//Funcion para obtener el nombre de usuario en base al token recibido del encabezado
    public static function getuser($Stoken) {
        $dbh = Conectar::con();
        $cs = "select t.username from token t  inner join turista u on t.username = u.username where
 t.token = '$Stoken';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra un registro en la tabla token se envia el encabezado 404
        if (!$filas[0]) {
            header("HTTP/1.0 404 Not Found");
            exit();
        } else {
            //Si se encuentra un registro se envia el nombre de usuario del turista
            $username = $filas['username'];
        }
        return $username;
    }

//Se busca el nombre de usuario del cajero que accede por medio de la aplicacion para canjear un cupon
    public static function getusercashier($Etoken) {
        $dbh = Conectar::con();
        $cs = "select t.username from token t  inner join usuario_empresa e on t.username = e.username where
 t.token = '$Etoken';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        if (!$filas[0]) {
            //Si no se encuentra un registro en la tabla token se envia el encabezado 404
            header("HTTP/1.0 404 Not Found");
            exit();
        } else {
            //Si se encuentra un registro se envia el nombre de usuario del cajero
            $username = $filas['username'];
        }
        return $username;
    }

//Funcion que obtiene el limite de codigos registrados de un cupon
    public static function getlimitcodes($ic) {
        $dbh = Conectar::con();
        $cs = "select c.limite_codigos from cupon c where c.id_cupon = '$ic';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        if (!$filas[0]) {
            //Si no se encuentra un registro en la tabla token se envia el encabezado 404
            header("HTTP/1.0 404 Not Found");
            exit();
        } else {
            //Si se encuentra un registro se envia limite de codigos de un cupon en base a su identificador
            $lc = $filas['limite_codigos'];
        }
        return $lc;
    }

//Se obtiene la cantidad total de codigo de un cupon en base al identificiador del cupon
    public static function getcountofcodes($ic) {
        $dbh = Conectar::con();
        $cs = "select count(q.id_codigo_qr) as total from codigo_qr q where q.id_cupon = '$ic' and q.canjeado = '0';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra ningun codigo de cupones se envia el contador como cero
        if (!$filas[0]) {
            $lc = '0';
        } else {
            //Si se encuentra el contador se envia
            $lc = $filas['total'];
        }
        return $lc;
    }

//Se obtiene la cantidad total de codigos de un cupon en base al identificiador del cupon que ha sido canjeado
    public static function getcountofcodeschanged($ic) {
        $dbh = Conectar::con();
        $cs = "select count(q.id_codigo_qr) as total from codigo_qr q where q.id_cupon = '$ic' and q.canjeado = '1';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra ningun codigo de cupones se envia el contador como cero
        if (!$filas[0]) {
            $lc = '0';
        } else {
            //Si se encuentra el contador se envia
            $lc = $filas['total'];
        }
        return $lc;
    }

//Funcion que determina el estado del cupon en base al limite de codigo y el contador de cupones
    public static function determinate_cupon($lc, $ccc) {
        $determinate = '';
        //Si el limite de codigo es superior al contador se obtiene un valor falso
        if ($lc < $ccc) {
            $determinate = 'FALSE';
        } else if ($lc == $ccc) {
            //Si el limite de codigo es igual al contador se obtiene un valor falso
            $determinate = 'FALSE';
        } else if ($ccc < $lc) {
            //Si el limite de codigo es mayor al contador se obtiene un valor verdadero
            $determinate = 'TRUE';
        }
        return $determinate;
    }

//Funcion que se encarga de encriptar el identificador del codigo para generar el codigo qr
    public static function openCypher($action = 'encrypt', $string = false) {
        $action = trim($action);
        $output = false;
//Clave para encriptar
        $myKey = 'oW%c76+jb2';
        $myIV = 'A)2!u467a^';
        $encrypt_method = 'AES-256-CBC';
//Funcion hash que encripta la cadena definida previamente
        $secret_key = hash('sha256', $myKey);
        $secret_iv = substr(hash('sha256', $myIV), 0, 16);

        if ($action && ($action == 'encrypt' || $action == 'decrypt') && $string) {
            $string = trim(strval($string));
//Funcion que encripta la cadena
            if ($action == 'encrypt') {
                $output = openssl_encrypt($string, $encrypt_method, $secret_key, 0, $secret_iv);
            };
//Funcion que decripta la cadena encriptada
            if ($action == 'decrypt') {
                $output = openssl_decrypt($string, $encrypt_method, $secret_key, 0, $secret_iv);
            };
        };
        return $output;
    }

//Funcion que prepara la cadena del codigo qr
    public static function preparedqrstring($ic, $icqr) {
        //Se junta el identifiador del codigo y el codigo qr
        $plaintext = $ic . "|" . $icqr;
        //Se encripta la cadena codificada
        $encrypted = Codigos::openCypher('encrypt', $plaintext);
        return $encrypted;
    }

//Funcion que prepara el registro de la cadena del codigo qr de un codigo cambiado
    public static function preparedregister($ic, $token) {
        $rtn = array();
        $dbh = Conectar::con();
        $na = new validacion();
        $username = Codigos::getuser($token);
        $icqr = $na->generar_aleatorio();
        //Cuando s cambia un codigo qr de un cupon se define el codigo qr de ese cupon
        $sql2 = "INSERT INTO codigo_qr(id_codigo_qr,id_cupon,username,canjeado)
        VALUES('$icqr','$ic','$username','0')";
        if (!mysqli_query($dbh, $sql2)) {
            die('Error: ' . mysqli_error($dbh));
        } else {
            //Se regresa la cadena preparada del codigo canjeado
            $qr_string = Codigos::preparedqrstring($ic, $icqr);
            $rtn["qr_string"] = $qr_string;
        }
        return $rtn;
    }

//Funcion que registra el nuevo codigo qr
    public static function register_codigoqr() {
        $register = array();
        $stringvacia = '';
        $ic = $_GET["coupon_id"];
        //Se obtiene el limite de codigos de un cpon
        $lc = Codigos::getlimitcodes($ic);
        //Se obtiene el contador de los codigos que han sido registrados
        $ccc = Codigos::getcountofcodes($ic);
        //Se determina el estado del cupon
        $determinate = Codigos::determinate_cupon($lc, $ccc);
        if ($determinate === 'TRUE') {
            //Si el estado es verdadero se genera el registro del cupon
            $arr = apache_request_headers();
            $CTOKEN = $arr['Authorization'];
            $Cseparada = preg_split("/[\s,]+/", $CTOKEN, 4);
            $Stoken = $Cseparada[1];
            $register = Codigos::preparedregister($ic, $Stoken);
            header("HTTP/1.0 200 OK");
        } else {
            //Si el estado es falso se envia el emcabezado 484
            //header("HTTP/1.0 484 Limite de cupones alcanzado");
            $register["qr_string"] = $stringvacia;
        }
        return $register;
    }

//Funcion que decripta la cadena del codigo qr
    public static function regenerate_string($qrs) {
        $desencrypted = Codigos::openCypher('decrypt', $qrs);
        return $desencrypted;
    }

//Funcion que se encarga de decriptar la cadena encriptada del codigo qr
    public static function get_id_cupon($decrypt) {
        $ids = array();
        $array = explode("|", $decrypt);
        $ids["id_cupon"] = $array[0];
        $ids["id_codigo_qr"] = $array[1];
        return $ids;
    }

//Funcion que verirfica el estado del cupon
    public static function verify_e_c($une, $idc) {
        $id_cupon = array();
        $fa = date('Y-m-d');
        $dbh = Conectar::con();
        //Consulta que obtiene el estado del cupon
        $cs = "SELECT r.id_revision_objeto FROM usuario_empresa u inner join empresa e on u.id_empresa = e.id_empresa inner join revision_objeto r 
on e.id_empresa = r.id_empresa inner join cupon c on r.id_revision_objeto = c.id_revision_objeto where u.username = '$une' 
and c.id_cupon = '$idc' and r.status = 'A' and c.vigencia_inicio <= '$fa' and c.vigencia_fin >= '$fa' 
group by r.id_revision_objeto;";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        foreach ($result as $res) {
            $id_cupon[] = $res;
        }
        return $id_cupon;
    }

//Funcion que verifica el estado del registro
    public static function verify_status_registro($idcr) {
        $canjeado = array();
        $dbh = Conectar::con();
        //Se obtiene el estado del cupon en base a un identificador del codigo qr
        $cs = "SELECT canjeado FROM codigo_qr where id_codigo_qr = '$idcr';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        foreach ($result as $res) {
            $canjeado [] = $res;
        }
        return $canjeado;
    }

//Funcion que actualiza el registro del cupon
    public static function update_register_cupon($idc, $idcr) {
        $pd = Conectar::con();
        //Cuando un cupon se canjea se cambia el estado por 1
        $actulizacion1 = "UPDATE codigo_qr SET canjeado ='1' WHERE id_codigo_qr ='$idcr' and id_cupon = '$idc';";
        if (!mysqli_query($pd, $actulizacion1)) {
            die('Error: ' . mysqli_error($pd));
        }
        mysqli_close($pd);
    }

//Funcion que selecioan el mensaje en base al estado del cupon
    public static function select_msg($iro, $idc, $idcr) {
        $response = array();
        if ($iro == NULL) {
            //Si el cupon no se actualiza constantemente se envia un mensaje de cupon no valido
            $code = "483";
            $msg = "Código no válido";
        } else {
            //Si el cupon se actualiza constantemente se envia un mensaje de cupon valido
            Codigos::update_register_cupon($idc, $idcr);
            $code = "200";
            $msg = "El cupón se canjeó exitosamente";
        }
        $response["code"] = $code;
        $response["msg"] = $msg;
        //print_r($response);
        return $response;
    }

    public static function select_msg_string_void() {
        $response = array();
        $code = "485";
        $msg = "Codigo no reconocible";
        $response["code"] = $code;
        $response["msg"] = $msg;
        return $response;
    }

    public static function select_msg_cupon_changed() {
        $response = array();
        $code = "485";
        $msg = "Cupon Canjeado";
        $response["code"] = $code;
        $response["msg"] = $msg;
        return $response;
    }

    public static function select_msg_limit_codes() {
        $response = array();
        $code = "485";
        $msg = "Limite de codigos alcanzado";
        $response["code"] = $code;
        $response["msg"] = $msg;
        return $response;
    }

//Funcion que envia mensaje el base al codigo recibido al cajero cuando esa empresa no ha emitido ese mensaje
    public static function select_msg_user() {
        $response = array();
        $code = "482";
        $msg = "La empresa no emitio este cupon";
        $response["code"] = $code;
        $response["msg"] = $msg;
        return $response;
    }

//Funcion encargada de canjear el cupon
    public static function change_cupon($usernamebd) {
        $response = array();
        //Si se recibe la cadena del codigo qr
        if (isset($_GET["qr_string"])) {
            $qrs = $_GET["qr_string"];
            if ($qrs == NULL) {
                Codigos::select_msg_string_void();
            } else {
                //Si no se recibe la cadena del codigo qr se genera una nueva cadena y se registra en la base de datos
                $decrypt = Codigos::regenerate_string($qrs);
                $ids = Codigos::get_id_cupon($decrypt);
                $idc = $ids["id_cupon"];
                $lc = Codigos::getlimitcodes($idc);
                $ccc = Codigos::getcountofcodeschanged($idc);
                $determinate = Codigos::determinate_cupon($lc, $ccc);
                if ($determinate == 'FALSE') {
                    $response = Codigos::select_msg_limit_codes();
                } else {
                    $idcr = $ids["id_codigo_qr"];
                    $status = Codigos::verify_status_registro($idcr);
                    $stat = $status [0]["canjeado"];
                    if ($stat == '0') {
                        $register = Codigos::verify_e_c($usernamebd, $idc);
                        if (empty($register)) {
                            $response = Codigos::select_msg_user();
                        } else {
                            $iro = $register[0]["id_revision_objeto"];
                            $response = Codigos::select_msg($iro, $idc, $idcr);
                        }
                    } else {
                        $response = Codigos::select_msg_cupon_changed();
                    }
                }
            }
        } else {
            $response = Codigos::select_msg_string_void();
        }
        return $response;
    }
}

include 'mdlSeguridad.php';
$usernamebd;
$Codigos = array();
if (isset($_GET["coupon_id"])) {
    $Codigos = Codigos::register_codigoqr();
} else if (isset($_GET["qr_string"])) {
    $Codigos = Codigos::change_cupon($usernamebd);
}
echo json_encode($Codigos);
