<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once( '../helpers/punto.php');
require_once('../helpers/helpers.php');
require_once('../scripts/Validaciones.php');
require_once( '../Model/revision.php' );

class sitios {

    public function CreatePolygonText($arr) {
        $rtn = "'POLYGON((";

        foreach ($arr as $coor) {
            $rtn .= " " . ( $coor->getLatitud() );
            $rtn .= " ";
            $rtn .= " " . ( $coor->getLongitud() );
            $rtn .= ", ";
        }
        $rtn .= " " . $arr[0]->getLatitud();
        $rtn .= " " . $arr[0]->getLongitud();
        $rtn .= "))'";
        return $rtn;
    }

    public static function rotaPunto($p, $angulo, $centro) {
        $x = $p->getLatitud() - $centro->getLatitud();
        $y = $p->getLongitud() - $centro->getLongitud();

        $teta = ($angulo);

        $nx = ( $x * cos($teta) - $y * sin($teta) ) + $centro->getLatitud();
        $ny = ( $x * sin($teta) + $y * cos($teta) ) + $centro->getLongitud();

        $ret = new Punto();
        $ret->setLatitud($nx)->setLongitud($ny);

        return $ret;
    }

    private function getArea($centro, $radio) {
        $lat = $centro->getLatitud();
        $lon = $centro->getLongitud();
        $p0 = new Punto();
        $p0->setLatitud($lat + $radio)->setLongitud($lon);
        $p1 = $this->rotaPunto($p0, 45, $centro);

        $p2 = new Punto();
        $p2->setLatitud($lat)->setLongitud($lon + $radio);
        $p3 = $this->rotaPunto($p2, 45, $centro);

        $p4 = new Punto();
        $p4->setLatitud($lat - $radio)->setLongitud($lon);
        $p5 = $this->rotaPunto($p4, 45, $centro);

        $p6 = new Punto();
        $p6->setLatitud($lat)->setLongitud($lon - $radio);
        $p7 = $this->rotaPunto($p6, 45, $centro);

        $ret[] = $p0;
        $ret[] = $p1;
        $ret[] = $p2;
        $ret[] = $p3;
        $ret[] = $p4;
        $ret[] = $p5;
        $ret[] = $p6;
        $ret[] = $p7;
        return $this->CreatePolygonText($ret);
    }

    public function SeleccionarArea($centro, $radio, $idioma) {
        $opt = $this->getArea($centro, $radio);
        $dbh = Conectar::con();
        echo $cs = "SELECT MBRContains(ST_GeomFromText('$opt'),i.ubicacionGIS) from revision_informacion i";
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
    }

    public function getSitios($latitud = 19.848611, $longitud = -90.525278, $radio = "2.0", $idioma) {
        $rev = new Revision();
    if( ! isset($idioma) ){
      $idioma = "es-es";
    }
    $p = new Punto();

    $p->setLatitud( $latitud )->setLongitud( $longitud );

    $res = $rev->SeleccionarArea( $p, $radio, $idioma );
    $res = utf8ize( $res );

    print_r( json_encode($res,JSON_UNESCAPED_UNICODE) );
    }

}

$sites = array();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $test = new sitios ();
    $test->getSitios(floatval($_GET['latitud']), floatval($_GET['longitud']), floatval($_GET['radio']), $_GET['idioma']);
}
