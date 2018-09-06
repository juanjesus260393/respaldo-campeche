<?php
require_once('model.php');
require_once('../helpers/punto.php' );
/*
describe sitio_info;
+-------------------+--------------+------+-----+---------+-------+
| Field             | Type         | Null | Key | Default | Extra |
+-------------------+--------------+------+-----+---------+-------+
| id_sitio          | int(11)      | NO   |     | 0       |       |
| id_empresa        | int(11)      | NO   |     | NULL    |       |
| municipios_id     | int(11)      | NO   |     | NULL    |       |
| nombre            | varchar(100) | NO   |     | NULL    |       |
| direccion         | varchar(200) | YES  |     | NULL    |       |
| telefono1         | varchar(15)  | YES  |     | NULL    |       |
| telefono2         | varchar(15)  | YES  |     | NULL    |       |
| capacidad         | int(11)      | YES  |     | NULL    |       |
| horario           | varchar(50)  | YES  |     | NULL    |       |
| id_sector         | int(11)      | NO   |     | 0       |       |
| sector            | varchar(200) | YES  |     | NULL    |       |
| ubicacionGIS      | point        | YES  |     | NULL    |       |
| id_carta          | varchar(12)  | YES  |     | NULL    |       |
| lang_code         | char(5)      | NO   |     | NULL    |       |
| descripcion_larga | varchar(500) | NO   |     | NULL    |       |
| descripcion_corta | varchar(150) | NO   |     | NULL    |       |
+-------------------+--------------+------+-----+---------+-------+


 */
class Revision extends model{
   function __construct(){
      $this->LlavePrimaria = ['id_revision_informacion'];
      $this->NombreDeTabla = 'revision_informacion';
      $this->indices  = [];
      $this->columnas = array(
                      'id_sitio'  => null,
                      'ubicacionGIS' => array(['ST_Y','longitud'],['ST_X','latitud']) );
   }

    public function SeleccionarArea( $centro, $radio, $idioma ){
      $opt = $this->getArea( $centro, $radio );
      $opt = " MBRContains(ST_GeomFromText(".$opt."),ubicacionGIS) AND ";
      $opt.= "status='A'";
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
