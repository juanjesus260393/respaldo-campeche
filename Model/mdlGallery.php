<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');
//Clase que se encarga de gestionar la informacion de las imagenes asociadas a un sitio
class galeria {
//Funcion que ese encarga de obtener las imagenes de un sitio dado de alta y aprobado
    public static function search_galery() {
        if (isset($_GET["place_id"])) {
            $id = $_GET["place_id"];
            $dbh = Conectar::con();
            //Consulta que se encarga de obtener los identiicadores de las imagenes de la galeriaa sociadas aun sitio y los comentarios
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
include 'mdlSeguridad.php';
$sec = galeria::search_galery();
echo json_encode($sec);


