<?php

require_once('../db/db.php');

require_once( '../helpers/helpers.php' );
class model {

   public $columnas;
   public $NombreDeTabla;
   public $indices;
   public $LlavePrimaria;  //tiene el nombre de la(s) llaves(s) primaria(s)
   public $_LlavePrimaria; //valor(es) de la(s) llave(s) primaria(s)
   public $registrosEnCache;

   public function ActualizarVal($col, $NvoVal) {
      if (array_key_exists($col, $this->columnas) ){
         $this->columnas[$col] = $this->escaparDato($NvoVal);
         if( in_array($col,$this->LlavePrimaria) ){
            $this->_LlavePrimaria[$col] = $this->columnas[$col];
         }
         return 1;
      }

      return -1;
   }

   public function SeleccionarVistas( $opciones = null, $llaveforanea){
      $db = new DataBase;
      $mascaras = $llaveforanea;
      $joins = "";
      foreach( $this->columnas as $nombre=>$valor ){
        if(is_array($valor)){
          $mascaras .= $valor[0][0]."($this->NombreDeTabla.$nombre) as ".$valor[0][1].",";
          $mascaras .= $valor[1][0]."($this->NombreDeTabla.$nombre) as ".$valor[1][1].",";
        }else
          $mascaras .= "$this->NombreDeTabla.$nombre,";
      }
      if( isset($this->Mascaras) ){
        foreach( $this->Mascaras as $llaveForanea=>$campos ){
           $tablaForeanea = $campos["FROM"];
           $desde = $campos["FROM"] .".".$campos["llaveForanea"];
           $nvoVal = $campos["FROM"] .".".$campos["columna"];
           $contra = $this->NombreDeTabla .".".$campos["aliasForanea"];

           $joins .= " INNER JOIN $tablaForeanea ON $desde=$contra ";

           $mascaras .= "$nvoVal as ".$campos["as"].",";
        }
      }
      $mascaras = substr($mascaras,0,-1);
      $this->registrosEnCache = $db->SeleccionarVistas( $this->NombreDeTabla, $mascaras, $joins ,$this->indices, $opciones );

      return false;
   }

   public function Seleccionar($opc = null, $esMultitabla = null) {
      $db = new DataBase;
      foreach( $this->columnas as $nombre=>$valor ){
        if(is_array($valor)){
          $mascaras .= $valor[0]."($this->NombreDeTabla.$nombre) as $valor[0],";
          $mascaras .= $valor[1]."($this->NombreDeTabla.$nombre) as $valor[1],";
        }else
          $mascaras .= "$this->NombreDeTabla.$nombre,";
      }
      if( is_null($opc) )
         $this->registrosEnCache = $db->Seleccionar($this->NombreDeTabla);
      elseif( is_null($esMultitabla) )
         $this->registrosEnCache = $db->Seleccionar($this->NombreDeTabla, $this->indices, $opc);
      else
         $this->registrosEnCache = $db->Seleccionar( $this->NombreDeTabla, $this->indices, $opc, $esMultitabla );
      return $this->registrosEnCache;
   }

   public function Contar($campo = null ,$opc = null) {
      $db = new DataBase;
      return is_null($opc) ? $db->Contar($this->NombreDeTabla,$campo) : $db->Contar($this->NombreDeTabla,$campo, $opc);
   }

   public function ValorMaximo( $campo, $opc = null) {
      $db = new DataBase;
      return is_null($opc) ? $db->Maximo($this->NombreDeTabla,$campo) : $db->Maximo($this->NombreDeTabla,$campo, $opc);
   }

   public function Guardar() {
      $db = new DataBase;
      $_col = null;
      $_val = null;
      $this->escaparTodo();
      foreach ($this->columnas as $col => $val) {
         if (is_null($val)) {
            continue;
         }
         $_col[] = $col;
         $_val[] = $val;
      }
      return $db->Crear($this->NombreDeTabla, $_col, $_val);
   }

   /*
   * Metodos agregados para evitar inyeccion sql y html
   */
   public function escaparDato( $str , $esHtml = NULL ) {

      $db = new DataBase();

      return isset( $esHtml ) ? $db->escaparCadena( $str ) : $db->escaparCadena( strip_tags( $str ) );
   }
   public function escaparTodo() {
      foreach ( $this->columnas as $clave=>$valor ) {
         if( !is_null( $valor ) ) {
            $this->columnas[$clave] = isset( $this->camposHtml[$clave] ) ? $this->escaparDato( $valor , true ) : $this->escaparDato( $valor );
         }
      }
   }
   /**
   * Un método público.
   * Método para guardar datos por lotes.
   * @param $valores Nombre de tabla a la que se le realizará la inserción.
   * @throw Si la cantidad de datos en $valores no coincide con la cantidad de columnas del modelo, levanta una excepción.
   */
   public function GuardarMultiple( $valores ){
      $db = new DataBase;
      $_col = [];
      foreach ($this->columnas as $col => $val) {
         $_col[] = $col;
      }
      if( count($valores) == 0 || count($valores[0]) != count( $_col ) )
         throw new Exception('Cantidad inválida de argumentos. $valores es de tamaño '.
                              count($valores[0]).' y $col de tamaño'.count( $_col ) );
      $db->InsercionPorLotes( $this->NombreDeTabla, $_col, $valores );
   }

   public function GuardarBatch( $lotesDeColumnas ){
      $db = new DataBase;
      if( count($lotesDeColumnas) === 0 ){
         return -1;
      }

      $_val = [];
      $_col = array_keys( $lotesDeColumnas );
      $_val = arr::CruzarArray2D($lotesDeColumnas);
      $idInit = $db->CrearBatch($this->NombreDeTabla, $_col, $_val, $this->LlavePrimaria);
      reset($lotesDeColumnas);
      $llaves = array_keys(current($lotesDeColumnas));
      $idInit = $idInit[0]["LAST_INSERT_ID()"];
      for( $i=$idInit; $i < $idInit + count($_val); $i++) {
         $lotesDeColumnas["id"][$llaves[$i-$idInit]] =$i;
      }
      return arr::CruzarArrayPorHash($lotesDeColumnas);
   }

   public function Actualizar($opc){
      $db = new DataBase;
      $_val = '';

      $this->escaparTodo();

      foreach ($this->columnas as $col => $val) {
         if( in_array($col,$this->LlavePrimaria) || is_null($val) )
            continue;
         $_val = $_val . ", $col='$val' ";
      }

      $_val = substr($_val, 1, -1); //con esto quita la primer coma
      return $db->Actualizar($this->NombreDeTabla, $_val, $opc);
   }

   public function Encripta($val, $opc) {
      $db = new DataBase;
      return $db->Actualizar($this->NombreDeTabla, $val, $opc);
   }

   public function Borrar($opc) {
      $db = new DataBase;
      return $db->Borrar($this->NombreDeTabla, $opc);
   }

   public function ObtenerLlaveConsecutiva($nomLlave) { // Cambio para llave de 1 a n columnas
      $db = new DataBase;
      $this->_LlavePrimaria[$nomLlave] = $db->idAutoIncremental($this->NombreDeTabla, $this->LlavePrimaria[$nomLlave]);
      $this->ActualizarVal($this->LlavePrimaria[$nomLlave], $this->_LlavePrimaria[$nomLlave]);
   }
   public function Instanciar(){
      $query = "";
      foreach( $this->columnas as $col => $val) {
         if( is_null($val) ){
            continue;
         }
         $query= $query." AND $col='$val' ";
      }
      if( strlen($query) == 0 ) return 1;
      $query = substr( $query, 4, -1 );
      $tabla = $this->Seleccionar( $query );
      if( !is_array($tabla) || count($tabla) == 0  ){
         return 1;
      }
      foreach( $tabla as $key => $row ){
         foreach( $row as $nombreColumna => $valorColumna) {
            $this->ActualizarVal($nombreColumna,$valorColumna );
         }
      }
      return 0;
   }
   public function obtenerHash( $cadena ) {
      $db = new DataBase;
      return $db->obtenerHash( $cadena );
   }

}
