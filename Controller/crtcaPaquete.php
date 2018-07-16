<?php
session_start();
//Se llama al modelo de cupones
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlPaquetes.php");
//se referencia la clase obtener sitios
$rpaquetes = new Paquetes();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$rpa = $rpaquetes->registrar_paquete();
?>

