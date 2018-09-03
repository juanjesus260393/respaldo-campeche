<?php

date_default_timezone_set('America/Mexico_City');

require_once('model.php');
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');

Class Turista extends model {

    function __construct() {
        $this->LlavePrimaria = ['token'];
        $this->NombreDeTabla = 'token';
        $this->indices = [];
        $this->columnas = array(
            'token' => null,
            'username' => null,
            'vigencia' => null);
    }

    public function login($username, $token) {
        $str = "token = '$token' AND username = '$username'";
        //Se imprime la consulta en la tabla token y se obtienen los elementos que necesitamos de esta tabla: token, username, vigencia.
        //$this->SeleccionarVistas($str,$username);
        print_r($this->SeleccionarVistas($str, $username));
        return count($this->Seleccionar($str)) > 0 ? true : false;
    }

    public static function getTourist($username) {
        $fecha_vigencia = new DateTime();
        $fecha_vigencia->modify('+ 1 hour');
        $cadena_fecha_vigencia = $fecha_vigencia->format("d/m/Y H:i:s");
        $cadena_fecha_vigenciadb = $fecha_vigencia->format("Y-m-d H:i:s");
        $token = $user_r['token'] = bin2hex(openssl_random_pseudo_bytes(32));
        $user_r['expire_at'] = $cadena_fecha_vigencia;
        $user_r['user_type'] = 'T';
        $conn = new Conectar();
        $pd = $conn->con();
        $idd = 'ABCDEFG123456';
        $sql = "INSERT INTO token (token,username,id_dispositivo,vigencia)
        VALUES('$token','$username','$idd','$cadena_fecha_vigenciadb')";
        if (!mysqli_query($pd, $sql)) {
           header("HTTP/1.0 409 Conflict");
           exit();
        }
        mysqli_close($pd);
        return json_encode($user_r);
    }

    public static function getEnterprise($username) {
        $fecha_vigencia = new DateTime();
        $fecha_vigencia->modify('+ 1 hour');
        $cadena_fecha_vigencia = $fecha_vigencia->format("d/m/Y H:i:s");
        $cadena_fecha_vigenciadb = $fecha_vigencia->format("Y-m-d H:i:s");
        $token = $user_r['token'] = bin2hex(openssl_random_pseudo_bytes(32));
        $user_r['expire_at'] = $cadena_fecha_vigencia;
        $user_r['user_type'] = 'T';
        $conn = new Conectar();
        $pd = $conn->con();
        $sql = "INSERT INTO token (token,username,vigencia)
        VALUES('$token','$username','$cadena_fecha_vigenciadb')";
        if (!mysqli_query($pd, $sql)) {
            header("HTTP/1.0 410 Conflict");
        }
        mysqli_close($pd);
        return json_encode($user_r);
    }

    public static function searchpass($user, $pass) {
        $conn = new Conectar();
        $pd = $conn->con();
        //Primero se obtiene la contraseña que sera comparada
        $cpass = "SELECT password from users WHERE username = '" . $user . "'";
        $rcpass = mysqli_query($pd, $cpass) or die(mysqli_error());
        $fila1 = mysqli_fetch_array($rcpass);
        //opcion1: Si el usuario NO existe o los datos son INCORRRECTOS
        if (!$fila1[0]) {
            header("HTTP/1.0 404 Not Found");
        } else {
            $passw = $fila1['password'];
            if (password_verify($pass, $passw)) {
                $cuser = "SELECT username FROM users WHERE username = '" . $user . "'";
                $rcuser = mysqli_query($pd, $cuser) or die(mysqli_error());
                $fila = mysqli_fetch_array($rcuser);
                //opcion1: Si el usuario NO existe o los datos son INCORRRECTOS
                if (!$fila[0]) {
                    header("HTTP/1.0 404 Not Found");
                } else {
                    $users = $fila['username'];
                    echo Turista::defineUser($users);
                }
            } else {
                header("HTTP/1.0 404 Not Found");
            }
        }
    }

    public static function deleteregister($token) {
        $conn = new Conectar();
        $pd = $conn->con();
        //Primero se obtiene la contraseña que sera comparada
        $dtoken = "delete from token where token = '" . $token . "'";
        $rdtoken = mysqli_query($pd, $dtoken) or die(mysqli_error());
        //opcion1: Si el usuario NO existe o los datos son INCORRRECTOS
        if ($rdtoken == FALSE) {
            header("HTTP/1.0 404 Not Found");
            exit();
        } else {
            header("HTTP/1.0 202 ACCEPTED");
            exit();
        }
    }

    public static function defineUser($user) {
        $conn = new Conectar();
        $pd = $conn->con();
        $consultatoken = "SELECT u.username from turista u  where u.username = '" . $user . "'";
        $resultadoconsultatoken = mysqli_query($pd, $consultatoken) or die(mysqli_error());
        $fila1 = mysqli_fetch_array($resultadoconsultatoken);
        //Si el nombre de usuario no existe en la tabla authorities
        if (!$fila1[0]) {
            //Se busca en la tabla usuario_empresa
            $cuempresa = "SELECT u.username from users u inner join usuario_empresa e on u.username = e.username where e.username = '" . $user . "';";
            $rcempresa = mysqli_query($pd, $cuempresa) or die(mysqli_error());
            $fila2 = mysqli_fetch_array($rcempresa);
            //Si no se encuentra en la tabla empresa ni en la tabla authorities
            if (!$fila2[0]) {
                header("HTTP/1.0 404 Not Found");
            } else {
                $usernmc = $fila2['username'];
                echo Turista::getEnterprise($usernmc);
                exit();
            }
        } else {
            $usernmt = $fila1['username'];
            echo Turista::getTourist($usernmt);
            exit();
        }
    }

    public static function generateStoken($user, $pass) {
        $un = "user=" . $user;
        $ps = "pass=" . $pass;
        $Ctoken = '391aa86cfb1bfadcb185476cd0f4b203174479c90090780528ffd4b55605f45c';
        $cadena = $un . "|" . $ps . "|" . $Ctoken;
        $hashs = hash('sha256', $cadena);
        $Base64 = base64_encode(hex2bin($hashs));
        return $Stoken = "C-TOKEN " . $Base64;
    }

    public function login_movil() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.0 405 Method Not Allowed");
            exit();
        }
        $_POST = json_decode(file_get_contents("php://input"), true);
        if (isset($_POST['user']) && isset($_POST['pass'])) {
            //obtener headers
            $arr = apache_request_headers();
            $CTOKEN = $arr['Authorization'];
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $STOKEN = Turista::generateStoken($user, $pass);
            if ($CTOKEN == $STOKEN) {
                if (Turista::searchpass($user, $pass) == null) {
                    
                }
            }
            header("HTTP/1.0 401 Unauthorized");
            exit();
        }
        header("HTTP/1.0 400 Bad Request");
    }

    public static function searchparams($tok) {
        $Claveprivada = '391aa86cfb1bfadcb185476cd0f4b203174479c90090780528ffd4b55605f45c';
        $conn = new Conectar();
        $pd = $conn->con();
        //Primero se obtiene la contraseña que sera comparada
        $cpass = "select u.username from users u inner join token t on u.username = t.username where t.token = '" . $tok . "';";
        $rcpass = mysqli_query($pd, $cpass) or die(mysqli_error());
        $fila1 = mysqli_fetch_array($rcpass);
        //opcion1: Si el usuario NO existe o los datos son INCORRRECTOS
        if (!$fila1[0]) {
            header("HTTP/1.0 404 Not Found");
            exit();
        } else {
            $username = $fila1['username'];
            $cadena = $username . "|" . $tok . "|" . $Claveprivada;
            $hashs = hash('sha256', $cadena);
            $Base64 = base64_encode(hex2bin($hashs));
            header("HTTP/1.0 202 OK");
            return $Shash = $Base64;
        }
    }

    public static function gethash($HASH, $token) {
        $Claveprivada = '391aa86cfb1bfadcb185476cd0f4b203174479c90090780528ffd4b55605f45c';
        $cadena = $HASH . "|" . $token . "|" . $Claveprivada;
        $hashs = hash('sha256', $cadena);
        $Base64 = base64_encode(hex2bin($hashs));
        return $Shash = $Base64;
    }

    public function logout_movil() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.0 405 Method Not Allowed");
            exit();
        }
        $_POST = json_decode(file_get_contents("php://input"), true);
        isset($_POST['hash']);
        $arr = apache_request_headers();
        if ($arr != NULL) {
            $CTOKEN = $arr['Authorization'];
            $CHASHCU = $_POST['hash'];
            $Cseparada = preg_split("/[\s,]+/", $CTOKEN, 4);
            $Stoken = $Cseparada[1];
            $CAHASH = $Cseparada[2];
            $HASH = "hash=" . $CHASHCU;
            //Se verifica si el has del encabezado coincide
            $CHASHCA = Turista::gethash($HASH, $Stoken);
            if ($CAHASH == $CHASHCA) {
                //Se verifica que el hash enviado por el cuerpo coincida
                $SHASHCU = Turista::searchparams($Stoken);
                if ($CHASHCU == $SHASHCU) {
                    Turista::deleteregister($Stoken);
                    exit();
                } else {
                    header("HTTP/1.0 401 Unauthorized");
                    exit();
                }
            } else {
                header("HTTP/1.0 401 Unauthorized");
                exit();
            }
        } else {
            header("HTTP/1.0 400 Bad Request");
        }
    }

}
