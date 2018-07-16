<?php
session_start();
//Se llama al modelo de los videos esto para la consulta y demas operaciones
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlPaquetes.php");
//se referencia la clase obtener sitios
$paquetes = new Paquetes();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$lpaquetes = $paquetes->lista_paquetes();
//Se llama a la vista vista sitios     
require_once("C:/xampp/htdocs/campeche-web2/view/vPaquete.php");
?>
