<?php
//Se llama al modelo de menu de inicio de sesion
require_once("C:/xampp/htdocs/campeche-web2/Model/Miniciodesesion.php");
//se referencia la clase obtener cupones
$rpass = new obtener_usuario ();
//se llama el metodo registrar cupones
$rp = $rpass ->reset_pass();
