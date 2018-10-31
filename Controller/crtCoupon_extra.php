<?php

//Web services que se encarga de abrir y mostrar la imagen del cupon que se muestra en el dispositivo movil
//Si se recibe el identificador del archivo de la imagen del cupon
if (isset($_GET['id'])) {
    if (strlen($_GET['id']) > 0) {
        //Ruta en la que se encuentran almacenadas las imagenes del cupon
        $file = '../Imagenes/Cupones/' . $_GET['id'] . '.jpg';
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