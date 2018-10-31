<?php
//Web services que se encarga de abrir y mostrar la carta (menu) asociada a un sitio
//Si se recibe el identificador del archivo de la carta vinculada a un sitio
if (isset($_GET['id'])) {
    if (strlen($_GET['id']) > 0) {
        //Ruta en la que se encuentran almacenadas las cartas (menus) de un sitio que sea restaurante
        $file = '../Imagenes/Sitios/carta/' . $_GET['id'] . '.pdf';
        $type = 'application/pdf';
        header('Content-Type:' . $type);
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
} else {
    //Encabezado 400 de mala solicitud en caso de que no reciba el identificador de la publicidad
    header("HTTP/1.0 400 Bad Request");
    die();
}