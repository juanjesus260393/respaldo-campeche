<?php
session_start();
//Se llama al modelo de cupones
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlCupones.php");
//se referencia la clase obtener sitios
$ecupon = new obtener_cupon();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$rpd = $ecupon->eliminar_cupon();
?>


