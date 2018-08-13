<?php
session_start();

if($_SESSION['loggedin']==NULL || $_SESSION['loggedin']==FALSE){
 unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';

}
else if($_SESSION['loggedin']==TRUE && $_SESSION['tipo']=='empresa'){
//Llamada al modelo
require_once ("../Model/conexion.php");
require_once("../Model/add_Sitios_model.php");


$Nuevo_sitio=new add_Sitios_model();
$municipio=$Nuevo_sitio->get_municipios();

 if(isset($_POST['submit'])){
   
   $b=$Nuevo_sitio->add_sitio();
   
 }

 //Llamada a la vista
require_once("../view/add_Sitios_view.php");
}