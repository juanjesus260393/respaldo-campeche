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
//Se llama al modelo de flyers y banners
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlFlyersyBanners.php");
//se referencia la clase FlyeryBanner
$rpublicidad = new FlyeryBanner();
//se llama el metodo registrar publicidad
$rpu = $rpublicidad->registrar_publicidad();
}
?>

