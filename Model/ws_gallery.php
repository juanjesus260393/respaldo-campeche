<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');

class galeria {

    public static function search_galery() {
        if (isset($_GET["place_id"])) {
            $id = $_GET["place_id"];
            $dbh = Conectar::con();
            $cs = "SELECT i.id_archivo_imagen as image_id FROM sitio s inner join revision_informacion r on s.id_sitio = r.id_sitio inner join imagen_galeria i on r.id_revision_informacion
= i.id_revision_informacion where s.id_sitio = '$id';";
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

$sec = galeria::search_galery();
echo json_encode($sec);


