<?php
session_start();
//Se llama al modelo de cupones
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlVacantes.php");
//se referencia la clase obtener sitios
$cvacante = new Vacantes();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$av = $cvacante ->actualizar_vacante();
?>
