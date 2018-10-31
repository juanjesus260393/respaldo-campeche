<?php
/**
 * Description of ws_img_vacante
 *
 * @author Pablo
 */
if (isset($_GET['id'])) {
    if (strlen($_GET['id']) > 0) {
        $end = "jpg";
        $file = '../Imagenes/eventos/img/'. $_GET['id'].'.' . $end;
        $type = 'image/jpg';
        header('Content-Type:' . $type);
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
}
