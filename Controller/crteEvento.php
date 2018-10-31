<?php
session_start();
//Se llama al modelo de cupones
require_once ("../Model/conexion.php");
require_once("C:/xampp/htdocs/campeche-web2/Model/setEventos_model.php");

//se referencia la clase obtener sitios
$eve = new setEventos_model();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
 $b = $eve->eliminar_Evento();
?>
