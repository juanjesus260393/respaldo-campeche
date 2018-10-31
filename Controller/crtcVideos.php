<?php
session_start();
//Se llama al modelo de los videos esto para la consulta y demas operaciones
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlVideos.php");
//se referencia la clase videos
$videos = new Videos();
//se llama el metodo lista de videos
$lvideos = $videos->lista_videos();
//Se llama a la vista vista de videos    
 require_once("C:/xampp/htdocs/campeche-web2/view/vVideos.php");
?>

