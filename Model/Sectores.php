<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');

class Sector {

    private $id;
    private $name;

    public static function search_sector() {
        $dbh = Conectar::con();
        $cs = "SELECT id_sector as sector_id, nombre as name  from campeche.sector";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        foreach ($result as $res) {
            $sectores[] = $res;
        }
        return $sectores;
    }

    public static function search_sectorwithid() {
        $sector_id = $_GET['sector_id'];
        $dbh = Conectar::con();
        $cs = "SELECT s.id_sitio, s.nombre,d.descripcion_corta ,e.id_logo from empresa e inner join sitio s on e.id_empresa = s.id_empresa inner join revision_informacion i on s.id_sitio = i.id_sitio
inner join descripcion_idioma d on i.id_revision_informacion= d.id_revision_informacion where d.lang_code = 'ES' and e.id_sector = '$sector_id' order by s.id_sitio;";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        foreach ($result as $res) {
            $sectores[] = $res;
        }
        return $sectores;
    }

}
$sec = Sector::search_sector();
echo json_encode($sec);