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

    public static function getTourist() {
        $fecha_vigencia = new DateTime();
        $fecha_vigencia->modify('+ 1 hour');
        $cadena_fecha_vigencia = $fecha_vigencia->format("d/m/Y H:i:s");

        $user_r['token'] = bin2hex(openssl_random_pseudo_bytes(64));
        $user_r['expire_at'] = $cadena_fecha_vigencia;
        $user_r['user_type'] = 'T';
        return json_encode($user_r);
    }

    public static function getEnterprise() {
        $fecha_vigencia = new DateTime();
        $fecha_vigencia->modify('+ 1 hour');
        $cadena_fecha_vigencia = $fecha_vigencia->format("d/m/Y H:i:s");

        $user_r['token'] = bin2hex(openssl_random_pseudo_bytes(64));
        $user_r['expire_at'] = $cadena_fecha_vigencia;
        $user_r['user_type'] = 'C';
        return json_encode($user_r);
    }

    public static function searchUpass($user, $pass) {
        $conn = new Conectar();
        $pd = $conn->con();
        $consultausers = "SELECT username FROM users WHERE username = '" . $user . "' and password = '" . $pass . "'";
        $resultadoconsultausers = mysqli_query($pd, $consultausers) or die(mysqli_error());
        $fila = mysqli_fetch_array($resultadoconsultausers);
        //opcion1: Si el usuario NO existe o los datos son INCORRRECTOS
        if (!$fila[0]) {
            header("HTTP/1.0 404 Not Found");
        } else {
            $passw = $fila['username'];
            echo Turista::defineUser($passw);
        }
    }

    public static function searchUser($user, $pass) {
        $conn = new Conectar();
        $pd = $conn->con();
        $consultausers = "SELECT username FROM users WHERE username = '" . $user . "' and  password = '" . $pass . "'";
        $resultadoconsultausers = mysqli_query($pd, $consultausers) or die(mysqli_error());
        $fila = mysqli_fetch_array($resultadoconsultausers);
        //opcion1: Si el usuario NO existe o los datos son INCORRRECTOS
        if (!$fila[0]) {
            header("HTTP/1.0 404 Not Found");
        } else {
            $nombredeusuario = $fila['username'];
            echo Turista::defineUser($nombredeusuario);
        }
    }

    public static function defineUser($user) {
        $conn = new Conectar();
        $pd = $conn->con();
        $consultatoken = "SELECT t.username, t.token from fullpass_user u inner join token t on u.username = t.username where t.username = '" . $user . "'";
        $resultadoconsultatoken = mysqli_query($pd, $consultatoken) or die(mysqli_error());
        $fila1 = mysqli_fetch_array($resultadoconsultatoken);
        //Si el nombre de usuario no existe en la tabla authorities
        if (!$fila1[0]) {
            //Se busca en la tabla usuario_empresa
            $consultausuarioempresa = "SELECT u.username from users u inner join usuario_empresa e on u.username = e.username where e.username = '" . $user . ";";
            $resultadoconsultausuarioempresa = mysqli_query($pd, $consultausuarioempresa) or die(mysqli_error());
            $fila2 = mysqli_fetch_array($resultadoconsultausuarioempresa);
            //Si no se encuentra en la tabla empresa ni en la tabla authorities
            if (!$fila2[0]) {
                header("HTTP/1.0 404 Not Found");
            } else {
                echo Turista::getEnterprise();
                exit();
            }
        } else {

            echo Turista::getTourist();
            exit();
        }
    }

    public function login_movil() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.0 406 Method Not Allowed");
            exit();
        }

        $_POST = json_decode(file_get_contents("php://input"), true);

        if (isset($_POST['user']) && isset($_POST['pass'])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            if (Turista::searchUser($user, $pass) == null) {
                
            }
            header("HTTP/1.0 401 Unauthorized");
            exit();
        }

        header("HTTP/1.0 400 Bad Request");
    }

    public function logout_movil() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.0 406 Method Not Allowed");
            exit();
        }

        $_POST = json_decode(file_get_contents("php://input"), true);

        if (isset($_POST['user']) && isset($_POST['pass'])) {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            if (Turista::searchUser($user, $pass) == null) {
                
            }
            //header("HTTP/1.0 401 Unauthorized");
            //exit();
        }

        header("HTTP/1.0 400 Bad Request");
    }

}
