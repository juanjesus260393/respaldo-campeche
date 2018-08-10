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
//Se llama al modelo sitios
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlCupones.php");
//se referencia la clase obtener sitios
$cupon = new obtener_cupon();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$lcupones = $cupon->lista_cupones();
$lcupones2 = $cupon->lista_cupones2();
//Se llama a la vista vista sitios     
 require_once("C:/xampp/htdocs/campeche-web2/view/vCupon.php");
}
?>