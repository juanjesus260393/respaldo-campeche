<?php
session_start();
//Se llama al modelo de cupones
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlPaquetes.php");
//se referencia la clase obtener sitios
$epaquetes = new Paquetes();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$epa = $epaquetes->eliminar_paquete();
?>
