<?php
//Se llama al modelo turista
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlTurista.php");
//se referencia la clase turista
$turista = new Turista();
//se llama el metodo login para verirficar el inicio de sesion
$cs = $turista->logout_movil();
?>
