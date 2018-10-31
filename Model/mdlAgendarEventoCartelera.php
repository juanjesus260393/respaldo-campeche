<?php

/**
 * Description of mdlAgendarEventoCartelera
 *
 * @author Pablo
 */
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');

class AgendarEventoCartelera {

    public function AddEventoCartelera() {
        include 'mdlSeguridad.php';
        $_POST = json_decode(file_get_contents("php://input"), true);
        //campo llave id_actividad_cartelera 
        if (isset($_POST ['idevento'])) {
            //Parametros obtenidos del modulo de seguridad
            $tourist_username = $usernamebd;
            $tourist_token = $tokenbd;
            $idEvento = $_POST ['idevento'];
            if (AgendarEventoCartelera::ExisteEvento($tourist_username, $idEvento)) {
                header("HTTP/1.0 401 Unauthorized");
            } else {  //insertamos Evento cartelera
                AgendarEventoCartelera::InsertEvento($tourist_username, $idEvento);
            }
        } else {
            header("HTTP/1.0 400 Bad Request");
        }
    }

    public static function ExisteEvento($username, $idEvento) {
        $conn = new Conectar();
        $pd = $conn->con();
        $str = "SELECT a.username  from actividad_cartelera A where A.username = '" . $username . "' and  A.id_evento=" . $idEvento . "";
        $resultado = mysqli_query($pd, $str) or die(mysqli_error());
        $registro = mysqli_fetch_array($resultado);
        if (!$registro[0]) {
            //no existe evento de cartelera agregado
            return FALSE;
        } else {
            // Existe un evento igual ya registrado
            return TRUE;
        }
    }

    public static function InsertEvento($username, $idEvento) {
        $va = new validacion();
        $conn = new Conectar();
        $pd = $conn->con();
        $newId = $va->generar_aleatorio();
        $sql = "INSERT INTO actividad_cartelera(id_actividad_cartelera, username, id_evento)VALUES($newId, '$username', $idEvento)";
        if (!mysqli_query($pd, $sql)) {
            header("HTTP/1.0 409 Conflict");
            exit();
        } else {
            header("HTTP/1.0 200 Ok");
        }
        mysqli_close($pd);
    }

}
