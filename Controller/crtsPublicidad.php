<?php
require_once("../Model/mdlFlyersyBanners.php");
//se referencia la clase obtener sesiones
$spublicidad= new FlyeryBanner();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$sepub = $spublicidad->buscar_publicidad();
//Se llama a la vista vista sitios
require_once("../view/actualizarPublicidad.php");
