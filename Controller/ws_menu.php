<?php

if (isset($_GET['id'])) {
    if (strlen($_GET['id']) > 0) {
        $file = '../Imagenes/Sitios/carta/' . $_GET['id'] . '.pdf';
        $type = 'application/pdf';
        header('Content-Type:' . $type);
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
} else {
    header("HTTP/1.0 400 Bad Request");
    die();
}