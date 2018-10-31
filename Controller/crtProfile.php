<?php

//Web services que se encarga de abrir imagen de perfil de un sitio
//Si se recibe el identificador de la imagen de perfil de un sitio
if (isset($_GET['id'])) {
    if (strlen($_GET['id']) > 0) {
        $end = "jpg";
        //Ruta en la que se encuentran almacenadas las imagenes de perfil de un sitio
        $file = '../Imagenes/Sitios/img/' . $_GET['id'] . '.' . $end;
        $type = 'image/jpg';
        header('Content-Type:' . $type);
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
} else {
    //Encabezado 400 de mala solicitud en caso de que no reciba el identificador de la publicidad
    header("HTTP/1.0 400 Bad Request");
    die();
}