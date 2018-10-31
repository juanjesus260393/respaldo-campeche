<?php

/**
 * Description of mdlActualizar_contrasena
 *
 * @author Pablo
 */
require_once('Conexion.php');

class Actualizar_contrasena {

    public function CambiarPassword() {
        include 'mdlSeguridad.php';
        $_POST = json_decode(file_get_contents("php://input"), true);
        if (isset($_POST ['pass'])) {
            $password = $_POST ['pass'];
            $username = $usernamebd;
            Actualizar_contrasena::Actualizar($username, $password);
        } else {
            header(" HTTP/1.1 401 Bad Request:");
        }
    }

    private static function Actualizar($username, $password) {
        $conn = new Conectar();
        $pd = $conn->con();
        $pwd = Actualizar_contrasena::hash_Password($password);
        $sql = "UPDATE Users  SET password='$pwd' where  username='$username'";
        if (!mysqli_query($pd, $sql)) {
            header("HTTP/1.0 409 Conflict");
            exit();
        } else {
            header("HTTP/1.0 200 Ok");
            exit;
        }
        mysqli_close($pd);
    }

    private static function hash_Password($password) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        return $password_hash;
    }

}
