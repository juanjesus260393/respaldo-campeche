<?php
//Se llama al modelo flyer y banners
require_once("../Model/mdlFlyersyBanners.php");
//se referencia la clase flyer y banner
$spublicidad= new FlyeryBanner();
//se llama el metodo buscar publicidad
$sepub = $spublicidad->buscar_publicidad();
//Se llama a la vista actualizar publicidad
require_once("../view/actualizarPublicidad.php");
