<?php

//require_once('Conexion.php');
Class repvideo {

    public static function get_vistas($id_video_archivo) {
        $conexion = mysqli_connect("localhost", "root", "P4SSW0RD", "campeche");
        //Consulta que busca la cantida dde visualizacion de un video en base a un identificador previamente obtenido
        $cs = "SELECT v.id_video,v.visualizaciones from video v where v.id_video_archivo = '$id_video_archivo';";
        $result = mysqli_query($conexion, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        if (!$filas[0]) {
            //Si no existe un retgistro que coincida se envia el ecmabezado 401 y se terminan las operaciones en php
            header("HTTP/1.0 401 Unauthorized");
            exit();
        } else {
            //Si existe un registro se envia a la funcion set-new-vistas las visualizaciones, y el identificador del video
            $visualizaciones = $filas['visualizaciones'];
            $id_video = $filas['id_video'];
            repvideo::set_new_vistas($visualizaciones, $id_video);
        }
    }

//Funcion que actualiza la cantida de visualizaciones de un video
    public static function set_new_vistas($visualizaciones, $id_video) {
        $conexion = mysqli_connect("localhost", "root", "P4SSW0RD", "campeche");
        $new_visualzacion = $visualizaciones + 1;
        $sql = "UPDATE video SET visualizaciones = $new_visualzacion WHERE  id_video='$id_video';";
        if (!mysqli_query($conexion, $sql)) {
            //Si no se realiza la ctualizacion se envia el emcabezado 409
            header("HTTP/1.0 401 Unauthorized");
            exit();
        }
    }

}
