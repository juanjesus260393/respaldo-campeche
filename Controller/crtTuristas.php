<?php
//Se llama al modelo turista
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlTurista.php");
//se referencia la clase turista
$username = "Turista123";
$password = "1234";
$turista = new Turista();
//se llama el metodo login para verirficar el inicio de sesion
$lg = $turista->login($username,$password);
 require_once("C:/xampp/htdocs/campeche-web2/view/Pruebas.php");
?>