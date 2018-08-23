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

}
$sec = Sector::search_sector();
echo json_encode($sec);