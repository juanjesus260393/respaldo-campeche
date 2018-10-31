<?php
/*
 *          Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 10-10-2018
 *   Versión: 1.0
 *   Descripcion: Controlador de la funcion que agrega un nuevo sitio
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
// Si existe y es de tipo empresa, manda a llamadar a los archivos conexion.php y add_Sitios_model
else if($_SESSION['loggedin']==TRUE && $_SESSION['tipo']=='empresa'){
//Llamada al modelo
require_once ("../Model/conexion.php");
require_once("../Model/add_Sitios_model.php");
//crea los objetos necesarios de las clases ,

$Nuevo_sitio=new add_Sitios_model();
$municipio=$Nuevo_sitio->get_municipios();

 if(isset($_POST['submit'])){
   
   $b=$Nuevo_sitio->add_sitio();
   
 }

 //Llamada a la vista
require_once("../view/add_Sitios_view.php");
}