<?php

if (isset($_GET['id'])) {
    if (strlen($_GET['id']) > 0) {
        //$file = "../Imgenes/Videos/$_GET['id']";
        $file = '../Imagenes/Videos/'.$_GET['id'];
        $type = 'image/jpg';
        header('Content-Type:' . $type);
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
}
