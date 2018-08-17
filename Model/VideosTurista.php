<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');

Class videosturista {

    private $titulo;
    private $descripcion;
    private $fecha_subida;
    private $sector;
    private $empresa;
    private $precio;
    private $duracion;
    private $views;
    private $id_video;
    private $id_imagen_vista_previa;
    private $id_logo_empresa;
    private $pagado;
    private $full_date;

    function __construct($titulo, $descripcion, $fecha_subida, $sector, $empresa, $precio, $duracion, $views, $id_video, $id_imagen_vista_previa, $id_logo_empresa) {
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->fecha_subida = $fecha_subida;
        $this->sector = $sector;
        $this->empresa = $empresa;
        $this->precio = $precio;
        $this->duracion = $duracion;
        $this->views = $views;
        $this->id_video = $id_video;
        $this->id_imagen_vista_previa = $id_imagen_vista_previa;
        $this->id_logo_empresa = $id_logo_empresa;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDateUpload($fecha_subida) {
        $this->fecha_subida = $fecha_subida;
    }

    public function getDateUpload() {
        return $this->fecha_subida;
    }

    public function setSector($sector) {
        $this->sector = $sector;
    }

    public function getSector() {
        return $this->sector;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setUrl_video($url_video) {
        $this->url_video = $url_video;
    }

    public function getUrl_video() {
        return $this->url_video;
    }

    public function setUrl_imagen_vista_previa($url_imagen_vista_previa) {
        $this->url_imagen_vista_previa = $url_imagen_vista_previa;
    }

    public function getUrl_imagen_vista_previa() {
        return $this->url_imagen_vista_previa;
    }

    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    public function getEmpresa() {
        return $this->empresa;
    }

    public static function search_video($limite) {
//Se llama a la case conectar del archivo conexion.php
        $dbh = Conectar::con();
        $consultaue = "select v.titulo, v.descripcion, date_format(v.fecha_subida, '%d/%m/%Y') as fecha_subida, sector.nombre as sector, empresa.nombre as empresa,
 v.precio,v.duracion,v.visualizaciones as vistas,v.id_video_archivo as id_video,v.id_img_preview as id_imagen_vista_previa,
empresa.id_logo as id_logo_empresa from video v inner join revision_objeto r on v.id_revision_objeto = r.id_revision_objeto inner join 
empresa on r.id_empresa = empresa.id_empresa inner join sector on empresa.id_sector = sector.id_sector limit $limite;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        foreach ($resultado2 as $res) {
            $videos[] = $res;
        }
        return $videos;
    }

}

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
//Busquedad de los videos en la base de datos
$Videos = videosturista::search_video($Limite);
$videos_obj = array();

foreach ($Videos as $video) {
    $videos_obj[] = new videosturista($video['titulo'], $video['descripcion'], $video['fecha_subida'], $video['sector'], $video['empresa'], $video['precio'], $video['duracion'], $video['vistas'], $video['id_video'], $video['id_imagen_vista_previa'], $video['id_logo_empresa']);
}

$count = 0;
foreach ($Videos as $video) {
    $count++;
    $valid = true;

    if (isset($_GET["last_id"])) {
        if ($_GET["last_id"] <= $count)
            continue;
    }

    $res_video = null;

    if (!isset($_GET['q'])) {
        $res_video = $video;
    } else {
        $q = $_GET['q'];
        if (strlen($q) > 0) {
            if (strpos(strtolower($video->getDescripcion()), strtolower($q)) !== false ||
                    strpos(strtolower($video->getTitulo()), strtolower($q)) !== false ||
                    strpos(strtolower($video->getSector()), strtolower($q)) !== false ||
                    strpos(strtolower($video->getEmpresa()), strtolower($q)) !== false) {
                $res_video = $video;
            }
        }
    }

    if (!isset($res_video))
        continue;

    if (isset($_GET["date_upload"])) {
        $cDate = new DateTime();
        $videoDate = $video;

        switch (strtolower($_GET["date_upload"])) {
            case "h":
                echo  $videoDate;
                if ($cDate->getTimeStamp() - 3600 > $videoDate->getTimeStamp()) {
                    $valid = false;
                }
                break;
            case "t":
                $today = $cDate->format("d/m/Y");
                $video_upload_day = $videoDate->format("d/m/Y");

                if (strcasecmp($today, $video_upload_day) != 0) {
                    $valid = false;
                }
                break;
            case "w":
                if ($cDate->getTimeStamp() - 604800 > $videoDate->getTimeStamp()) {
                    $valid = false;
                }
                break;
            case "m":
                $current_month = $cDate->format("m/Y");
                $video_upload_month = $videoDate;

                if ($video_upload_month != 0) {
                    $valid = false;
                }
                break;
            case "y":
                $current_year = $cDate->format("Y");
                $video_upload_year = $videoDate->format("Y");

                if (strcasecmp($current_year, $video_upload_year) != 0) {
                    $valid = false;
                }
                break;
        }
    }

    if (isset($_GET['sector'])) {
        if (strcasecmp($_GET['sector'], $video->getSector()) != 0) {
            $valid = false;
        }
    }

    if (isset($_GET['company'])) {
        if (strcasecmp($_GET['company'], $video->getEmpresa()) != 0) {
            $valid = false;
        }
    }

    $last_id = isset($_GET["last_id"]) ? $_GET["last_id"] : 0;
    if (isset($_GET["limit"])) {
        if ($count - $last_id > $_GET["limit"]) {
            break;
        }
    } else if ($count - $last_id > 15) {
        break;
    }

    if ($valid) {
        $response[] = $res_video;
    }
}
if (count($response) > 0) {
    if (isset($_GET["order_by"])) {
        switch (strtolower($_GET["order_by"])) {
            default:
            case "fecha":
                $response = order_by_date($response);
                break;
            case "sector":
                $response = order_by_sector($response);
                break;
            case "empresa":
                $response = order_by_company($response);
                break;
        }
    } else {
        $response = order_by_date($response);
    }

    if (isset($_GET["sort"])) {
        if (strcasecmp($_GET["sort"], "asc") == 0) {
            $response = invert_order($response);
        }
    }
}
$array_response = array();
foreach ($response as $video) {
    $array_response[] = $video;
}

//$responseR = array("res"=>$response);
echo json_encode($array_response);


/* -----------------------------
  Functions
  ------------------------------- */

function order_by_date($videos) {

    $size = count($videos);

    for ($i = 0; $i < $size; $i++) {
        for ($j = $i + 1; $j < $size; $j++) {
            $videoDate1 = $videos[$i];
            $videoDate2 = $videos[$j];

            if ($videoDate1 < $videoDate2) {
                $aux = $videos[$i];
                $videos[$i] = $videos[$j];
                $videos[$j] = $aux;
            }
        }
    }

    return $videos;
}

function order_by_sector($videos) {
    $size = count($videos);

    for ($i = 0; $i < $size; $i++) {
        for ($j = $i + 1; $j < $size; $j++) {
            if (strcasecmp($videos[$i]->getSector(), $videos[$j]->getSector()) < 0) {
                $aux = $videos[$i];
                $videos[$i] = $videos[$j];
                $videos[$j] = $aux;
            }
        }
    }

    return $videos;
}

function order_by_company($videos) {
    $size = count($videos);

    for ($i = 0; $i < $size; $i++) {
        for ($j = $i + 1; $j < $size; $j++) {
            if (strcasecmp($videos[$i]->getEmpresa(), $videos[$j]->getEmpresa()) < 0) {
                $aux = $videos[$i];
                $videos[$i] = $videos[$j];
                $videos[$j] = $aux;
            }
        }
    }

    return $videos;
}

function invert_order($videos) {
    $size = count($videos);

    $array = array();

    for ($i = $size - 1; $i >= 0; $i--) {
        $array[] = $videos[$i];
    }

    return $array;
}
