<?php
/*
 *          Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 10-10-2018
 *   Versión: 1.0
 *   Descripcion: Controlador de la funcion para cambiar contraseña
 * por Fabrica de Software, CIC-IPN
 */

//inicia variables de sesión
session_start();
// Verifica si al variable de sesión existe
if($_SESSION['loggedin']==NULL || $_SESSION['loggedin']==FALSE){
//si no existe o es nula, destruye la sesión y regresa al log in
 unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';

}
// Si existe y es de tipo administrador, manda a llamadar a los archivos conexion.php y cambiaPass_model
else if($_SESSION['loggedin']==TRUE){
require_once ("../Model/conexion.php");
require_once("../Model/cambiaPass_model.php");
require_once("../Model/Sendmail.php");
//crea los objetos necesarios de las clases ,
if(isset($_POST['si'])){
    $a=new cambiaPass_model();
    $nwp=$a->setPass();
    
    
}


require_once ("../view/cambiaPass_view.php");


}

