<?php
session_start();
//Se llama al modelo de cupones
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlVideos.php");
//se referencia la clase obtener sitios
$evideo = new Videos();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$rpd = $evideo->eliminar_video();
?>
