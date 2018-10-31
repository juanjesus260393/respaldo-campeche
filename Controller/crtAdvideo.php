<?php

session_start();
//Se llama al modelo de videos
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlVideos.php");
//se referencia la clase videos
$rvideo = new Videos();
//se llama el metodo registrar_videos encargado de registrar la informacion de los videos que sube una empresa
$rvideo = $rvideo->registrar_videos();
?>

