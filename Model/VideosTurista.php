<?php

date_default_timezone_set('America/Mexico_City');
require_once("videos_db.php");
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');

Class videosturista {

    public static function search_video($limite) {
//Se llama a la case conectar del archivo conexion.php
        $dbh = Conectar::con();
        $sql = "select v.titulo, v.descripcion, v.fecha_subida, sector.nombre, empresa.nombre as nombree, v.precio,v.visualizaciones,v.id_video,v.id_img_preview, v.id_video_archivo from video v inner join revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa on
r.id_empresa = empresa.id_empresa inner join sector on empresa.id_sector = sector.id_sector limit $limite";
        if ($dbh->query($sql) == NULL) {
            $videos_obj[] = NULL;
        } else {
            foreach ($dbh->query($sql) as $video) {
               
                $videos_obj[] = $video;
            }
        }
        return $videos_obj;
    }

    public static function get_encodedata($videos) {
        //Se obtienen los elementos de cada video con un for
        for ($i = 0; $i < count($videos); $i++) {
            $t = $videos[$i]["titulo"];
            $dc = $videos[$i]["descripcion"];
            $fs = $videos[$i]["fecha_subida"];
            $ns = $videos[$i]["nombre"];
            $ne = $videos[$i]["nombree"];
            $pr = $videos[$i]["precio"];
            $vs = $videos[$i]["visualizaciones"];
            $iv = $videos[$i]["id_video"];
            $iip = $videos[$i]["id_img_preview"];
            $iva = $videos[$i]["id_video_archivo"];
            $array = array('titulo' => $t,
                'descripcion' => $dc,
                'fecha_subida' => $fs,
                'sector' => $ns,
                'empresa' => $ne,
                'precio' => $pr,
                'vistas' => $vs,
                'id_video' => $iv,
                'id_video_archivo' => $iip,
                'id_img_preview' => $iva);
            return $array;
        }
    }

    public function indetificacion() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header("HTTP/1.0 405 Method Not Allowed");
            exit();
        }
        //verificar si los hash coinciden
        $headers = getallheaders();
        $CTOKEN = $headers['Authorization'];
        isset($_GET['limit']);
        $Limit = $_GET["limit"];
        $Cseparada = preg_split("/[\s,]+/", $CTOKEN, 4);
        $Stoken = $Cseparada[1];
        $CAHASH = $Cseparada[2];
        //$HASH = "hash=" . $CHASHCU;
        //Se verifica si el has del encabezado coincide
        // $CHASHCA = Turista::gethash($HASH, $Stoken);
        $videos = videosturista::search_video($Limit);
        //Se envia el arreglo de los elementos y se asigna un identificador
       echo json_encode(videosturista::search_video($Limit));
    }

}
