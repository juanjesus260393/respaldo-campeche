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
//se referencia la clase obtener cupones
$scupon = new obtener_cupon();
//se llama el metodo buscar cupon
$secupon = $scupon->buscar_cupon();
//Se llama a la vista vista actualizar cupon
require_once("../view/actualizarCupon.php");
}
