<?php

session_start();
//Se llama al modelo de cupones
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlVacantes.php");
//se referencia la clase obtener sitios
$rvacante = new Vacantes();
$rvacante = $rvacante->registrar_vacantes();

?>

