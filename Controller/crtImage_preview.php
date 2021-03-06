<?php

//Web services que se encarga de abrir y mostrar la imagen de vista previa de un video
//Si se recibe el identificador del archivo de la imagen de la vista previa de un video
if (isset($_GET['id'])) {
    if (strlen($_GET['id']) > 0) {
        $end = "jpg";
        //Ruta en la que se encuentran almacenadas la vista previa de los videos
        $file = '../Imagenes/Videos/' . $_GET['id'] . '.' . $end;
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