<?php

//Se llama al modelo turista
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlTurista.php");
//se referencia la clase turista
$turista = new Turista();
//se llama el metodo logout para cerra la sesion de un dispositivo
$cs = $turista->logout_movil();
?>
