<?php

//Se llama al modelo de cupones
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlCupones.php");
//se referencia la clase obtener sitios
$rcupon = new obtener_cupon();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$rpd = $rcupon->registrar_cupon();
//Se llama a la vista de contenido
require_once("C:/xampp/htdocs/campeche-web2/index.php");
?>

