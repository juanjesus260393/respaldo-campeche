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
//Se llama al modelo de cupones
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlCupones.php");
//se referencia la clase obtener cupones
$rcupon = new obtener_cupon();
//se llama el metodo registrar cupones
$rpd = $rcupon->registrar_cupon();
}
?>

