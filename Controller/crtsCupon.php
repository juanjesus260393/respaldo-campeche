<?php
session_start();

if($_SESSION['loggedin']==NULL || $_SESSION['loggedin']==FALSE){
 unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';

}
else if($_SESSION['loggedin']==TRUE&&$_SESSION['tipo']=='empresa'){
require_once("../Model/mdlCupones.php");
//se referencia la clase obtener sesiones
$scupon = new obtener_cupon();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$secupon = $scupon->buscar_cupon();
//Se llama a la vista vista sitios
require_once("../view/actualizarCupon.php");
}
