<?php
require_once( '../Model/revision.php' );
require_once( '../helpers/punto.php' );
require_once( '../helpers/helpers.php' );

class ctrSitios{
  public function getSitios( $latitud = 19.848611, $longitud = -90.525278, $radio = "2.0", $idioma ){
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
  public function seleccionarSitios(){
    $rev = new Revision();
    $rev->SeleccionarArea();
    $res = $rev->registrosEnCache;
    utf8ize( $res );
    // print_r($res);
    echo( json_encode($res,JSON_UNESCAPED_UNICODE) );
    echo "<br/>";
    echo "<br/>";
    echo "<br/>";
    echo json_last_error();
  }
}
?>

<?php

if( $_SERVER['REQUEST_METHOD'] == 'GET' ){
  $test = new ctrSitios();

  $test->getSitios( floatval($_GET['latitud']), floatval($_GET['longitud']), floatval($_GET['radio']), $_GET['idioma'] );

}

 ?>
