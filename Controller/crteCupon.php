<?php
session_start();
//Se llama al modelo de cupones
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlCupones.php");
//se referencia la clase obtener cupon
$ecupon =  new obtener_cupon();
//se llama el metodo eliminar cupon
$epd = $ecupon->eliminar_cupon();
?>


