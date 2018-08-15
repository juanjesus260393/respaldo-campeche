<?php

date_default_timezone_set('America/Mexico_City');
require_once("videos_db.php");
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');

Class videosturista {

    public static function search_video($limite) {
//Se llama a la case conectar del archivo conexion.php
        $dbh = Conectar::con();
        $sql = "select v.titulo, v.descripcion, date_format(v.fecha_subida, '%d/%m/%Y') as fecha_subida, sector.nombre as sector, empresa.nombre as empresa, v.precio,v.visualizaciones,v.id_img_preview as id_imagen_vista_previa, v.id_video_archivo as id_video from video v inner join revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join empresa on
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

    public function indetificacion() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            header("HTTP/1.0 405 Method Not Allowed");
            exit();
        }
        //verifica si el token del usuario existe
        isset($_GET['limit']);
        $Limite = $_GET["limit"];
        $limit = "limit=" . $Limite;
        $headers = getallheaders();
        $HEADER = $headers['Authorization'];
        $Cseparada = preg_split("/[\s,]+/", $HEADER, 4);
        $CTOKEN = $Cseparada[1];
        $CAHASH = $Cseparada[2];
        //Buscar al usuario primero 
        Turista::searchparams($CTOKEN);
        //Regenerar token para comprobar que la solicitud si procede del dispositivo
        $HASHCA = Turista::gethash($limit, $CTOKEN);
        if ($CAHASH == $HASHCA) {
            //Busquedad de los videos en la base de datos
            echo json_encode(videosturista::search_video($Limite));
        } else {
            header("HTTP/1.0 401 Unauthorized");
            exit();
        }
    }

}
