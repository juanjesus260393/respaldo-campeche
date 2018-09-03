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

    public static function search_sector_with_coupons() {
        $dbh = Conectar::con();
        $cs = "SELECT s.id_sector as sector_id, s.nombre as name from sector s inner join empresa e on s.id_sector = e.id_sector inner join revision_objeto r 
on e.id_empresa = r.id_empresa inner join cupon c on r.id_revision_objeto = c.id_revision_objeto group by s.id_sector;";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $sectores = array();
        foreach ($result as $res) {
            $sectores[] = $res;
        }
        return $sectores;
    }

}

$sectors = array();
if (!isset($_GET["only_with_coupons"])) {
    $sectors = Sector::search_sector();
} else {
    $sectors = Sector::search_sector_with_coupons();
}
echo json_encode($sectors);

