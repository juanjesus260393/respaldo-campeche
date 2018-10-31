<?php
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlVacante.php");
//se referencia la clase turista
$vacante = new Vacante();
//se llama el metodo login para verirficar el inicio de sesion
$bl = $vacante->Search_Vacantes();
?>
