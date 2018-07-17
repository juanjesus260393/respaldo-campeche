<?php
require_once("../Model/mdlCupones.php");
//se referencia la clase obtener sesiones
$scupon = new obtener_cupon ();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$secupon = $scupon->buscar_cupon();
//Se llama a la vista vista sitios
require_once("../view/actualizarCupon.php");

