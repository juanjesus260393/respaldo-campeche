<?php

//Web services que se encarga de abrir y mostrar la imagen en la publicidad que se muestra en el dispositivo movil
//Si se recibe el identificador del archivo de la imagen de publicidad
if (isset($_GET["id"])) {
    if (strlen($_GET['id']) > 0) {
        $type = 'image/jpg';
        $end = "jpg";
        //Ruta en la que se almacena las imagenes de la publicidad
        $file = '../Imagenes/Publicidad/' . $_GET['id'] . '.' . $end;
        header('Content-Type:' . $type);
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
} else {
    //Encabezado 400 de mala solicitud en caso de que no reciba el identificador de la publicidad
    header("HTTP/1.0 400 Bad Request");
    die();
}