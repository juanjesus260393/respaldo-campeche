<?php
    
if (isset($_GET["id"])) {
    if (strlen($_GET['id']) > 0) {
        $type = 'image/jpg';
        $end = "jpg";
        $file = '../Imagenes/Publicidad/' . $_GET['id'];
        header('Content-Type:' . $type);
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
} else {
    header("HTTP/1.0 400 Bad Request");
    die();
}