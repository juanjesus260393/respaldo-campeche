<?php

if (isset($_GET['id'])) {
    if (strlen($_GET['id']) > 0) {
        $end = "jpg";
        $file = '../Imagenes/Sitios/logo/' . $_GET['id'] . '.' . $end;
        $type = 'image/jpg';
        header('Content-Type:' . $type);
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
}

