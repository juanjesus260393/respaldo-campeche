<?php
session_start();
//Se llama al modelo de cupones
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlFlyersyBanners.php");
//se referencia la clase obtener sitios
$acpublicidad = new FlyeryBanner();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$apu = $acpublicidad->actualizar_publicidad();
?>

