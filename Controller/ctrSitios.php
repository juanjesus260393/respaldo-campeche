<?php
require_once("../Model/revision.php");
require_once( '../helpers/punto.php' );

class ctrSitios{
  public function getSitios( $latitud = 19.848611, $longitud = -90.525278, $radio = "2.0" ){
    $rev = new Revision();

    $p = new Punto();
    // 19.848611, -90.525278, campeche.
    // $p->setLatitud( 10.0 )->setLongitud( 10.0 );
    $p->setLatitud( $latitud )->setLongitud( $longitud );
    $res = $rev->SeleccionarArea( $p, $radio);
    // echo ":o";
    // print_r($rev->SeleccionarArea( $p, floatval("1") ));
    // print_r( json_encode($rev->SeleccionarArea( $p, floatval("1") )));
    // print_r($res);
    print_r( json_encode($res,JSON_UNESCAPED_UNICODE) );
    // echo json_encode($rev->Seleccionar());
  }
}
?>

<?php

if( $_SERVER['REQUEST_METHOD'] == 'GET' ){
  $test = new ctrSitios();

  $test->getSitios( floatval($_GET['latitud']), floatval($_GET['longitud']), floatval($_GET['radio']) );

}

 ?>
