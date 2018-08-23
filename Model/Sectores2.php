<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');

class Sector {

    public static function search_sectorwithid() {
        if (isset($_GET["sector_id"])) {
            $sectores = array();
            $sectores2 = array();
            $sector_id = $_GET["sector_id"];
            $dbh = Conectar::con();
            $cs = "SELECT s.id_sitio as place_id, s.nombre as name,d.descripcion_corta as short_description ,e.id_logo as logo_id from empresa e inner join sitio s on e.id_empresa = s.id_empresa inner join revision_informacion i on s.id_sitio = i.id_sitio
inner join descripcion_idioma d on i.id_revision_informacion= d.id_revision_informacion where d.lang_code = 'ES' and e.id_sector = '$sector_id' order by s.id_sitio;";
            $result = mysqli_query($dbh, $cs) or die(mysqli_error());
            foreach ($result as $res) {
                $sectores[] = $res;
            }
            if ($sectores == null) {
                $sectores = $sectores2;
            }
            return $sectores;
        } else {
            header("HTTP/1.0 400 Bad Request");
            die();
        }
    }

}

$sec = Sector::search_sectorwithid();
echo json_encode($sec);
