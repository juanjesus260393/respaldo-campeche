<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');

class Comentario {

    public static function search_comentario() {
        if (isset($_GET["place_id"])) {
            $id = $_GET["place_id"];
            $dbh = Conectar::con();
            $cs = "SELECT c.comentario as comment, c.calificacion as score, c.fecha_creacion as creation_date FROM calificacion c inner join sitio_has_calificacion h
 on c.id_calificacion = h.id_calificacion inner join sitio s on s.id_sitio = h.id_sitio where s.id_sitio = '$id';";
            $result = mysqli_query($dbh, $cs) or die(mysqli_error());
            $comentarios = array();
            $comentarios2 = array();
            foreach ($result as $res) {
                $comentarios[] = $res;
            }
            if ($comentarios == null) {
                $comentarios = $comentarios2;
            }
            return $comentarios;
        } else {
            header("HTTP/1.0 400 Bad Request");
            die();
        }
    }

}

$sec = Comentario::search_comentario();
echo json_encode($sec);
