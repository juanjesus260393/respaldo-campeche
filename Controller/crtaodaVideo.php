<?php

require_once("../Model/mdlVideos.php");
//se referencia la clase videos
$dvideo = new Videos();
//se llama el metodo buscar video
$video = $dvideo-> buscar_video();
//Se llama a la vista vista actualizar videos
require_once("../view/actualizarVideo.php");

