<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');

//Modulo que se encarga de gestionar la informacion de los ectores en base a los parametrs que recibe 
class Sector {

    private $id;
    private $name;

//Funcion que se encarga de obtener los sectores que se encuentrnan registrados en la base de datos
    public static function search_sector() {
        $sectores = array();
        $dbh = Conectar::con();
        $cs = "SELECT id_sector as sector_id, nombre as name  from campeche.sector";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        foreach ($result as $res) {
            $sectores[] = $res;
        }
        return $sectores;
    }

//Funcion que se encaga de obtener la informacion de secotres que tiene cupobnes asociados
    public static function search_sector_with_coupons() {
        $dbh = Conectar::con();
        $cs = "SELECT s.id_sector as sector_id, s.nombre as name from sector s inner join empresa e on s.id_sector = e.id_sector inner join
 revision_objeto r on e.id_empresa = r.id_empresa inner join cupon c on r.id_revision_objeto = c.id_revision_objeto inner join sitio t on
 e.id_empresa = t.id_empresa inner join revision_informacion i on t.id_sitio = i.id_sitio where i.status = 'A'
group by s.id_sector;";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $sectores = array();
        foreach ($result as $res) {
            $sectores[] = $res;
        }
        return $sectores;
    }

}

include 'mdlSeguridad.php';
$sectors = array();
if (!isset($_GET["only_with_coupons"])) {
    $sectors = Sector::search_sector();
} else {
    $sectors = Sector::search_sector_with_coupons();
}
echo json_encode($sectors);

