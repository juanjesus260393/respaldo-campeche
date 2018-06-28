<?php

//Se llama al modelo de inicios de sesion
require_once("C:/xampp/htdocs/campeche-web2/Model/Miniciodesesion.php");
//se referencia la clase obtener sesiones
$usuario = new obtener_usuario();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$user = $usuario->busquedad_usuario();
//Se llama a la vista vista sitios
require_once("C:/xampp/htdocs/campeche-web2/view/MenuPrincipal.php");
?>

