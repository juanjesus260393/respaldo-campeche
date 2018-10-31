<?php

//Web services que se encarga de abrir y mostrar la imagen del logo de una empresa
//Si se recibe el identificador del archivo del logo de una empresa registrada
if (isset($_GET['id'])) {
    if (strlen($_GET['id']) > 0) {
        $end = "jpg";
        //Ruta en la que se encuentran almacenadas las imagenes de los logos de una empresa
        $file = '../Imagenes/Sitios/logo/' . $_GET['id'] . '.' . $end;
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

