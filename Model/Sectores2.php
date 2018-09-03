<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');

class Lugares {

    public static function search_places() {
        if (isset($_GET["sector_id"])) {
            $sectores = array();
            $sectores2 = array();
            $sector_id = $_GET["sector_id"];
            $dbh = Conectar::con();
            $cs = "SELECT s.id_sitio as place_id, s.nombre as name,d.descripcion_corta as short_description ,e.id_logo as logo_id from empresa e inner join sitio s on e.id_empresa = s.id_empresa inner join revision_informacion i on s.id_sitio = i.id_sitio
inner join descripcion_idioma d on i.id_revision_informacion= d.id_revision_informacion where d.lang_code = 'ES' and e.id_sector = '$sector_id' and i.status = 'A' order by s.id_sitio;";
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


    public static function search_places_with_cupons() {
        if (isset($_GET["sector_id"])) {
            $sectores = array();
            $sector_id = $_GET["sector_id"];
            $dbh = Conectar::con();
            $fa = date('Y-m-d');
            $cs = "SELECT s.id_sitio as place_id,s.nombre as name, d.descripcion_corta as short_description , e.id_logo as logo_id   
FROM  empresa e inner join sitio s on e.id_empresa= s.id_empresa inner join sector t on e.id_sector = t.id_sector 
inner join revision_objeto r on e.id_empresa =r.id_empresa inner join cupon c on r.id_revision_objeto = c.id_revision_objeto inner join
revision_informacion i on s.id_sitio = i.id_sitio inner join descripcion_idioma d on i.id_revision_informacion= d.id_revision_informacion
where  t.id_sector = '$sector_id' and i.status = 'A' and c.vigencia_inicio <= '$fa' and c.vigencia_fin >= '$fa' and d.lang_code = 'ES' 
group by s.id_sitio;";
            $result = mysqli_query($dbh, $cs) or die(mysqli_error());
            foreach ($result as $res) {
                $sectores[] = $res;
            }
            return $sectores;
        } else {
            header("HTTP/1.0 400 Bad Request");
            die();
        }
    }

}

$sectors = array();
if (!isset($_GET["only_with_coupons"])) {
    $sectors = Lugares::search_places();
} else {
    $sectors = Lugares::search_places_with_cupons();
}
echo json_encode($sectors);
