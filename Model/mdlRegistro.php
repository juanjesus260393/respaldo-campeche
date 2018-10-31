<?php

//Pablo Moreno integracion
//require_once('model.php');
require_once('Conexion.php');

class Registro {

    function __construct() {
        $db = Conectar::con();
    }

    public function Insert_Registro() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.0 405 Method Not Allowed");
            exit();
        }
        $_POST = json_decode(file_get_contents("php://input"), true);
        $nombre = $_POST ['nombre'];
        $ciudad = $_POST ['ciudad'];
        $user_mail = $_POST ['user_mail'];
        $pwd = $_POST ['pwd'];
        $pais = $_POST ['pais'];
        $edad = $_POST ['edad'];
        $sexo = $_POST ['sexo'];
        $tel = $_POST ['tel'];
        $dias = $_POST ['dias'];
        $p_vez = $_POST ['p_vez'];
        if (isset($nombre) && isset($ciudad) && isset($user_mail) && isset($pwd) && isset($pais) && isset($edad) && isset($sexo) && isset($tel) && isset($dias) && isset($p_vez)) {
            $respuesta = Registro::validarCorreo($user_mail);
            if ($respuesta) {
                $respuestaUser = Registro::GuardarUser($user_mail, $pwd);
                if ($respuestaUser) {
                    $respuestaTurist = Registro::GuardarTurista($user_mail, $pais, $nombre, $ciudad, $p_vez, $dias, $edad, $sexo, $tel);
                    if ($respuestaTurist) {
                        header("HTTP/1.0 201 Created");
                    } else {
                        header("HTTP/1.0 422 Unprocessable Entity");
                    }
                } else {
                    header("HTTP/1.0 423 Unprocessable Entity");
                }
            } else {
                header("HTTP/1.0 401 Unauthorized");
                echo json_encode(array("msg" => "Correo existente"));
            }
        } else {
            header("HTTP/1.0 400 Bad Request");
        }
    }

    public static function validarCorreo($username) {
        $conn = new Conectar();
        $pd = $conn->con();
        $str = "SELECT u.username from users u  where u.username = '" . $username . "'";
        $resultado = mysqli_query($pd, $str) or die(mysqli_error());
        $registro = mysqli_fetch_array($resultado);
        if (!$registro[0]) {
            //no existe correo
            return TRUE;
        } else {
            // existe el correo
            return FALSE;
        }
    }

    public static function GuardarUser($username, $password) {
        $conn = new Conectar();
        $pd = $conn->con();
        $pwd = password_hash($password, PASSWORD_DEFAULT);
        $str = ("INSERT INTO users (username, password, enabled) VALUES ('" . $username . "','" . $pwd . "', 1)");
        $resultado = $pd->query($str);
        if ($resultado) {
            //gaurdado con exito
            return TRUE;
        } else {
            //no existe el correo
            return FALSE;
        }
    }

    public static function GuardarTurista($username, $pais, $nombre, $ciudad, $primera_visita, $dias, $edad, $sexo, $tel) {
        $conn = new Conectar();
        $pd = $conn->con();
        $str = ("INSERT INTO turista (username, id_pais, nombre, ciudad_procedencia, primera_visita, dias_en_el_estado, edad, sexo, tel) "
                . "VALUES ('" . $username . "'," . $pais . ",'" . $nombre . "','" . $ciudad . "'," . $primera_visita . "," . $dias . "," . $edad . "," . $sexo . "," . $tel . ")");
        $resultado = $pd->query($str);
        if ($resultado) {
            //gaurdado con exito
            return TRUE;
        } else {
            //no existe el correo
            return FALSE;
        }
    }

}
