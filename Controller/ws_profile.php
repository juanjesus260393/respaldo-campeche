<?php

if (isset($_GET['id'])) {
    if (strlen($_GET['id']) > 0) {
        $end = "jpg";
        $file = '../Imagenes/Sitios/img/' . $_GET['id'] . '.' . $end;
        $type = 'image/jpg';
        header('Content-Type:' . $type);
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
} else {
    header("HTTP/1.0 400 Bad Request");
    die();
}