<?php
session_start();

if($_SESSION['loggedin']==NULL || $_SESSION['loggedin']==FALSE){
 unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';

}
else if($_SESSION['loggedin']==TRUE){
//Se llama al modelo sitios
    require_once('../Model/Conexion.php');
require_once("../Model/Sitios.php");
//se referencia la clase obtener sitios
$sitio = new obtener_sitios();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$pd = $sitio->lista_sitios();
//Se llama a la vista vista sitios     
 require_once("../view/VistaSitios.php");
}
