<?php
session_start();
//Se llama al modelo de videos
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlVideos.php");
//se referencia la clase videos
$cvideo = new Videos();
//se llama el metodo actualizar videos
$av = $cvideo ->actualizar_video();
?>
