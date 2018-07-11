<?php
//Se llama al modelo turista
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlTurista.php");
//se referencia la clase turista
$turista = new Turista();
$username = "Juan04/07/2018";
$password = "juan123";
//se llama el metodo login para verirficar el inicio de sesion
$bl = $turista->login_movil($username,$password);
require_once("C:/xampp/htdocs/campeche-web2/view/Pruebas.php");
?>