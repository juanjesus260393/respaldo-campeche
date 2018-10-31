<?php
session_start();
//Se llama al modelo de flyers y banners
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlFlyersyBanners.php");
//se referencia la clase FlyeryBanner
$acpublicidad = new FlyeryBanner();
//se llama el metodo actualizar publicidad
$apu = $acpublicidad->actualizar_publicidad();
?>

