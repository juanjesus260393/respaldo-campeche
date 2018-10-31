<?php
session_start();
//Se llama al modelo de los videos esto para la consulta y demas operaciones
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlVacantes.php");
//se referencia la clase obtener sitios
$vacantes = new Vacantes();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$lvacantes = $vacantes->lista_vacantes();
//Se llama a la vista vista sitios     
 require_once("C:/xampp/htdocs/campeche-web2/view/vVacantes.php");
?>

