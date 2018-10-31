<?php
session_start();
//Se llama al modelo de videos
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlVideos.php");
//se referencia la clase videos
$evideo = new Videos();
//se llama el metodo eliminar video
$rpd = $evideo->eliminar_video();
?>
