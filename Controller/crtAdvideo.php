<?php

session_start();
//Se llama al modelo de cupones
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlVideos.php");
//se referencia la clase obtener sitios
$rvideo = new Videos();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$rvideo = $rvideo->registrar_videos();
//Se llama a la vista de contenido
?>

