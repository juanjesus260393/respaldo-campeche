<?php
session_start();
//Se llama al modelo de flyers y banners
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlFlyersyBanners.php");
//se referencia la clase flyerybanner
$cflyerybanner = new FlyeryBanner();
//se llama el metodo lista de flyerybanners
$lflyerybanners = $cflyerybanner->lista_flyersybanners();
//Se llama a la vista de flyers y banners
require_once("C:/xampp/htdocs/campeche-web2/view/vFlyersyBanners.php");
?>
