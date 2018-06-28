<?php
require_once('mysql_login.php');

/** @brief Abastracción de la base de datos.
 *  Database necista de un archivo mysql_login dónde se especifiquen las contstantes para inicio de sesión. Éstas son:
 *  - HOSTNAME: Nombre del host.
 *  - DATABASE: Nombre de la base de datos.
 *  - USERNAME: Nombre del usuario.
 *  - PASSWORD: constraseña.
 */
class DataBase {
   /**
    * Una variable privada.
    * Es la conexión a la base de datos del tipo mysqli
    * @todo InterfazDB convertir esta variable en una interfaz para dar soporte a otros tipos de bases de datos.
    */
   private $db;

   /**
    * Un método privado.
    * Abre la conexión a la base de datos
    * @todo InterfazDB Utilizar éste método para manejar la interfaz.
    */
   private function AbrirConexion() {
      $this->db = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE, PORT);
   }
   /**
   * Un método privado.
   * Cierra la conexión
   * @todo InterfazDB Sustituir por interfaz.
   */
   private function cerrarConexion() {
      $this->db->close();
   }

   /**
   * Un método privado.
   * Transforma un array unidimensional a una cadena separada por comas, con cada elementos entrecomillado.
   * @param $arr un array unidimensional, cuyos elementos deben ser cadenas de texto.
   * @todo ReduceDB Sustituir por versión reduce.
   */
   private function SeperarPorComasEntrecomillado($arr) {
      $rtn = "'" . $arr[0];
      for ($i = 1; $i < count($arr); $i++) {
         $rtn = $rtn . "','" . $arr[$i];
      }
      return $rtn . "'";
   }

   /**
   * Un método privado.
   * Transforma un array unidimensional a una cadena separada por comas.
   * @param $arr un array unidimensional, cuyos elementos deben ser cadenas de texto.
   * @todo  Sustituir por versión reduce.
   */
   private function SepararPorComas($arr) {
      $rtn = '' . $arr[0];
      for ($i = 1; $i < count($arr); $i++) {
         $rtn = $rtn . ',' . $arr[$i];
      }
      return $rtn . '';
   }

   /**
   * Un método privado.
   * Revisa si no existe un aerror en la conexión a la base de datos. En caso de no haberlo,
   * ejecuta el query que se enviá como paramétro.
   * @param $query La cadena de un query sql válido.
   * @todo Válidar que $query sea válido y lanzar la excepción adecuada.
   */
   private function IntentarEjecutar($query) {
      if ($this->db->connect_errno) {
         printf("Algo  salio mal: %s\n", $this->db->connect_error);
         exit();
      }
      return $this->db->query($query);
   }

   /**
   * Un método privado.
   * Maneja y avisa del tipo devuelto por la conexión a la base de datos,
   * ejecuta el query que se enviá como paramétro.
   * @param $resultado El resultado de un query sql.
   * @todo - Excepciones Lanzar una excepción cuando haya un error en base de datos.
   *       - Mover a interfaz para otras bases de datos.
   */
   private function ResolverFormatoMsqli($resultado){
      $rows = array();
      if (!($resultado instanceof bool) && $resultado != true) {
         var_dump($resultado);
         echo "  Algo  salio mal <br>Error: " . $this->db->error . "<br>";
      }
      if ($resultado instanceof mysqli_result) {
         while ($row = $resultado->fetch_assoc()) {
            $rows[] = $row;
         }
      }
      return $resultado instanceof mysqli_result ? $rows : $resultado;
   }

   /**
   * Un método privado.
   * Método adhesivo para manejo de ejecución de scripts.
   * @param $query Cadena sql válida.
   */
   private function Ejecutar( $query ) {
      // print_r($query);
      $this->AbrirConexion();
      $resultado = null;

      try {
         $resultado = $this->IntentarEjecutar($query);
         $resultado = $this->ResolverFormatoMsqli($resultado);
         if( $this->EsInsert ){
            $resultado = $this->IntentarEjecutar($this->queryRetrieve);
            $resultado = $this->ResolverFormatoMsqli($resultado);
         }
      } catch (Exception $e) {
         var_dump($resultado);
         echo "Algo  salio mal <br>Error: " . $this->db->error . "<br>";
      }
      echo $this->db->error;
      $this->CerrarConexion();
      return $resultado;
   }
   /**
   * Un método privado.
   * Método para manejar inserciones de múltiples filas.
   * @param $tabla Nombre de tabla a la que se le realizará la inserción.
   * @param $col Array de cadenas con los nombres de las columnas que se ingresarán.
   * @param $valores Array bidimensional con los valores que se insertaran. Estos valores deben ordenarse de acuerdo a
   *        $col, y su tipo debe poder convertirse a una cadena.
   */
   public function InsercionPorLotes( $tabla, $col, $valores ){
      $this->EsInsert = false;
      $_col = $this->SepararPorComas($col);
      $_arrVal = [];
      foreach( $valores as $filaValores ){
         $_arrVal []= '('.$this->SeperarPorComasEntrecomillado($filaValores).')';
      }
      $_vals = $this->SepararPorComas($_arrVal);
      $sql  = "INSERT INTO $tabla ($_col) VALUES ".$_vals;
      return $this->Ejecutar($sql);
   }

   /**
   * Un método privado.
   * Método para manejar inserciones de múltiples filas.
   * @param $tabla Nombre de tabla a la que se le realizará la inserción.
   * @param $col Array de cadenas con los nombres de las columnas que se ingresarán.
   * @param $val Array bidimensional con los valores que se insertaran. Estos valores deben ordenarse de acuerdo a
   *        $col, y su tipo debe poder convertirse a una cadena.
   * @param $llavePrimaria Array de cadenas con los nombres de las llaves primarias.
   * @return integer devuelve el último Id insertado en la $tabla.
   */
   public function CrearBatch($tabla, $col, $val, $llavePrimaria ){
      $this->EsInsert = true;
      $_col = $this->SepararPorComas($col);
      $_vals = '';
      foreach( $val as $key => $value ){
         $_vals.= '('.$this->SeperarPorComasEntrecomillado(array_map("trim",$value)) .'),';
      }
      $_vals = substr($_vals,0,-1);
      $sql  = "INSERT INTO $tabla ($_col) VALUES $_vals ; ";
      foreach ($llavePrimaria as $key => $value) {
         $llaves = " LAST_INSERT_ID($value),";
      }
      $llaves  = substr($llaves, 0,-1);
      $this->queryRetrieve = "SELECT LAST_INSERT_ID()";
      return $this->Ejecutar($sql);
   }

   public function Crear($tabla, $col, $val) {
      $this->EsInsert = false;
      $_col = $this->SepararPorComas($col);
      $_val = $this->SeperarPorComasEntrecomillado($val);
      $sql = "INSERT INTO $tabla ($_col) VALUES ( $_val )";
      return $this->Ejecutar($sql);
   }

   public function Borrar($tabla, $opciones) {
      $this->EsInsert = false;
      $sql = "DELETE FROM $tabla WHERE {$opciones}";
      return $this->Ejecutar($sql);
   }

   public function Seleccionar( $tabla, $indices = [], $opciones = null, $esMultitabla = null){
      $this->EsInsert = false;
      $sql = "SELECT * FROM $tabla";
      $sql.= count($indices)>0?' USE INDEX ('.$this->SepararPorComas($indices).') ':' ';
      if ($opciones != null) {
         if ($esMultitabla != null) {
            $sql = $sql . " $opciones";
         } else {
            $sql = $sql . " WHERE $opciones";
         }
      }
      return $this->Ejecutar($sql);
   }

   public function SeleccionarVistas( $tabla, $mascaras, $joins, $indices = [], $opciones = null ){
      $this->EsInsert = false;
      $sql = "SELECT $mascaras FROM $tabla $joins";
      $sql.= count($indices)>0?' USE INDEX ('.$this->SepararPorComas($indices).') ':' ';
      if ($opciones != null) {
         $sql = $sql . " WHERE $opciones";
      }
      return $this->Ejecutar($sql);
   }

   public function Maximo($tabla, $columna, $opciones = null) {
      $this->EsInsert = false;
      $sql = "SELECT max($columna) FROM $tabla ";

      if ($opciones != null) {
         $sql = $sql . " WHERE $opciones";
      }
      $respuesta = $this->Ejecutar($sql);
      if (is_array($respuesta)) {
         return $respuesta[0]["max($columna)"];
      }
      return $respuesta;
   }

   public function Contar($tabla, $columna = null, $opciones = null) {
      $this->EsInsert = false;
      if( is_null( $columna ) ){
         $sql = "SELECT count($columna) FROM $tabla ";
      }else{
         $sql = "SELECT count(*) FROM $tabla ";
      }
      if ($opciones != null) {
         $sql = $sql . " WHERE $opciones";
      }
      $respuesta = $this->Ejecutar($sql);
      if (is_array($respuesta)) {
         return $respuesta[0]['count(*)'];
      }
      return $respuesta;
   }

   public function Actualizar($tabla, $val, $opciones = null) {
      $this->EsInsert = false;
      $sql = "UPDATE $tabla SET $val";
      if ($opciones != null) {
         $sql = $sql . " WHERE $opciones";
      }
      return $this->Ejecutar($sql);
   }

   public function idAutoIncremental($tabla, $llavePrimaria) {
      $this->EsInsert = false;
      $sql = "SELECT MAX($llavePrimaria)+1 as nvoId FROM $tabla";
      $res = $this->Ejecutar($sql);
      return isset($res[0]['nvoId']) ?$res[0]['nvoId']:1;
   }

   public function escaparCadena( $cadena ) {

      $this->AbrirConexion();

      $cadenaEscapada = $this->db->real_escape_string( $cadena );

      $this->cerrarConexion();

      return $cadenaEscapada;
   }

   public function obtenerHash( $cadena ) {
      $this->EsInsert = false;

      $query = "SELECT sha2( '$cadena' , 224 ) AS Enc;";
      $aux = $this->Ejecutar( $query );
      $hash = $aux[0];

      return $hash['Enc'];
   }

}
