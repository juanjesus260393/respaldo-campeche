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
//Se llama al modelo de cupones
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlCupones.php");
//se referencia la clase obtener sitios
$accupon = new obtener_cupon();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$rpd = $accupon->actualizar_cupon();
}
?>
