<?php
session_start();
//Se llama al modelo de cupones
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlFlyersyBanners.php");
//se referencia la clase obtener sitios
$epublicidad =  new FlyeryBanner();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$epb = $epublicidad->eliminar_publicidad();
?>

