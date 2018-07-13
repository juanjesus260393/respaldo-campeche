<?php

require_once("../Model/mdlVideos.php");
//se referencia la clase obtener sesiones
$dvideo = new Videos();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$video = $dvideo-> buscar_video();
//Se llama a la vista vista sitios
require_once("../view/actualizarVideo.php");

