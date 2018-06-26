<?php
require_once('model.php');

/**
 *
 */
class Usuarios extends model{
   function __construct(){
      $this->LlavePrimaria = ['idUsuario'];
      $this->NombreDeTabla = 'usuario';
      $this->indices  = [];
      $this->columnas = array(
                       'idUsuario' => null,
                       'correoElectronico' => null,
                       'idEstado' => null,
                       'token' => null,
                       'tipoDevice' => null );
   }

   public function existe( $idUsuario, $token ){
      $usuarioEsc = $this->escaparDato( $idUsuario );
      $tokenEsc = $this->escaparDato( $token );
      $str = "idUSuario='$usuarioEsc' AND token = '$tokenEsc'";

      return $this->Contar( "*", $str ) > 0 ? true:false;

   }

   public function Guardar(){
      /*TO DO: aqui deberían ir las validaciones y reglas de negocio */
      parent::Guardar();
   }

   public function Actualizar(){
      /*TO DO: aqui deberían ir las validaciones y reglas de negocio */
      parent::Actualizar( "Id_administrador=".$this->columnas['Id_administrador'] );
   }

   public function Borrar(){
      /*TO DO: aqui deberían ir las validaciones y reglas de negocio */
      parent::Borrar( "Id_Legisladores=".$this->columnas['Id_Legisladores'] );
   }

}


?>
