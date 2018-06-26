<?php
require_once('model.php');
require_once('../helpers/punto.php' );
/*
+--------------+-------------+------+----+
| Campo        | Tipo        | Null | Key|
+--------------+-------------+------+----+
| id           | int(11)     | NO   | PRI|
| fecha        | varchar(45) | YES  |    |
| path         | varchar(45) | YES  |    |
| status       | varchar(45) | YES  |    |
| titulo       | varchar(45) | YES  |    |
| descripcion  | varchar(45) | YES  |    |
| idtipo       | int(11)     | NO   | PRI|
| idurl        | int(11)     | NO   | PRI|
| ubicacionGIS | point       | YES  |    |
+--------------+-------------+------+----+

 */
class Revision extends model{
   function __construct(){
      $this->LlavePrimaria = ['id'];
      $this->NombreDeTabla = 'revision';
      $this->indices  = [];
      $this->columnas = array(
                       'id' => null,
                       'fecha' => null,
                       'path' => null,
                       'status' => null,
                       'titulo' => null,
                       'descripcion' => null,
                       'idtipo' => "nombre",
                       'idurl' => "url",
                       'ubicacionGIS' => array('ST_Y','ST_X') );
      $this->Mascaras = array(
                          array( 'FROM' => 'tipo', 'columna'=>'nombre', 'as'=>'nombre', 'aliasForanea'=>'idtipo', 'llaveForanea'=>'id' ),
                          array( 'FROM' => 'url', 'columna'=>'url', 'as'=>'url',        'aliasForanea'=>'idurl', 'llaveForanea'=>'id' ) );
   }

    public function SeleccionarArea( $centro, $radio ){
      $opt = $this->getArea( $centro, $radio );
      $opt = " MBRContains(ST_GeomFromText(".$opt."),ubicacionGIS);";
      /*TO DO: aqui deberían ir las validaciones y reglas de negocio */
      parent::SeleccionarVistas( $opt, false  );
      return $this->registrosEnCache;
    }

   public function Guardar(){
      /*TO DO: aqui deberían ir las validaciones y reglas de negocio */
      parent::Guardar();
   }

   // public function Actualizar(){
   //    /*TO DO: aqui deberían ir las validaciones y reglas de negocio */
   //    parent::Actualizar( "" );
   // }
   //
   // public function Borrar(){
   //    /*TO DO: aqui deberían ir las validaciones y reglas de negocio */
   //    parent::Borrar( "" );
   // }

   private function rotaPunto( $p, $angulo, $centro){
    $x = $p->getLatitud() - $centro->getLatitud();
    $y = $p->getLongitud()- $centro->getLongitud();

    $teta = ($angulo);

    $nx = ( $x * cos($teta) - $y * sin($teta) ) + $centro->getLatitud();
    $ny = ( $x * sin($teta) + $y * cos($teta) ) + $centro->getLongitud();

    $ret = new Punto();
    $ret->setLatitud( $nx )->setLongitud( $ny );

    return $ret;
  }


  // assert to
  //POLYGON((0 0,10 0,10 10,0 10,0 0))
  //  ArrayList<Punto> arr
  public function CreatePolygonText( $arr ){
    $rtn = "'POLYGON((";

    foreach( $arr as $coor ){
      $rtn.= " ".( $coor->getLatitud() );
      $rtn.= " ";
      $rtn.= " ".( $coor->getLongitud() );
      $rtn.= ", ";
    }
    $rtn .= " ".$arr[0]->getLatitud() ;
    $rtn .= " ".$arr[0]->getLongitud() ;
    $rtn .= "))'" ;
    return $rtn;
  }

  private function getArea( $centro, $radio ) {
    $lat = $centro->getLatitud();
    $lon = $centro->getLongitud();
    $p0 = new Punto();
    $p0->setLatitud( $lat + $radio )->setLongitud( $lon );
    $p1 = $this->rotaPunto( $p0, 45, $centro );

    $p2 = new Punto();
    $p2->setLatitud( $lat )->setLongitud( $lon + $radio );
    $p3 = $this->rotaPunto( $p2, 45, $centro );

    $p4 = new Punto();
    $p4->setLatitud( $lat - $radio )->setLongitud( $lon );
    $p5 = $this->rotaPunto( $p4, 45, $centro );

    $p6 = new Punto();
    $p6->setLatitud( $lat )->setLongitud( $lon - $radio );
    $p7 = $this->rotaPunto( $p6, 45, $centro );

    $ret[]=$p0;
    $ret[]=$p1;
    $ret[]=$p2;
    $ret[]=$p3;
    $ret[]=$p4;
    $ret[]=$p5;
    $ret[]=$p6;
    $ret[]=$p7;
    return $this->CreatePolygonText( $ret );
  }

}


?>
