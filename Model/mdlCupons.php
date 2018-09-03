<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');

class Cupones {
    
    public static function generate_cadenaqr() {
        if (isset($_GET["sector_id"])) {
            $fa = date('Y-m-d');
            $sector_id = $_GET["sector_id"];
            $dbh = Conectar::con();
            //Funcion para realizar la consulta de la ubicacion y regresar la laptitud y la longitud
            $cs = "SELECT c.id_revision_objeto FROM cupon c inner join revision_objeto r inner join empresa e on r.id_empresa = e.id_empresa 
inner join sector s on e.id_sector = s.id_sector where s.id_sector = '$sector_id ' and  r.status = 'A' and c.vigencia_inicio <= '$fa' 
and c.vigencia_fin >= '$fa' group by id_revision_objeto limit 1;";
            $result = mysqli_query($dbh, $cs) or die(mysqli_error());
            $filas = mysqli_fetch_array($result);
            //Si no se encuentra en la tabla empresa ni en la tabla authorities
            if (!$filas[0]) {
                header("HTTP/1.0 404 Not Found");
                exit();
            } else {
                $id_revision_objeto = $filas['id_revision_objeto'];
            }
            return $id_revision_objeto;
        } else {
            header("HTTP/1.0 400 Bad Request");
            die();
        }
    }

    public static function search_cupons_ofasite() {
        if (isset($_GET["place_id"])) {
            $cupones = array();
            $fa = date('Y-m-d');
            $place_id = $_GET["place_id"];
            $dbh = Conectar::con();
            $cs = "SELECT c.id_cupon as coupon_id, c.id_imagen_vista_previa as preview_img_id, c.titulo as title, c.descripcion_corta as short_description,
c.descripcion_larga as long_description, c.id_imagen_extra as extra_img_id,date_format(c.vigencia_inicio, '%d/%m/%Y') as life_from, 
date_format(c.vigencia_fin, '%d/%m/%Y') as life_to, c.terminos_y_condiciones as terms_and_conditions, '' as qr_string,s.nombre 
as place_name from sitio s inner join empresa e on e.id_empresa = s.id_empresa inner join revision_objeto r 
on e.id_empresa = r.id_empresa inner join cupon c on r.id_revision_objeto = c.id_revision_objeto  
where r.status = 'A' and c.vigencia_inicio <= '$fa' and c.vigencia_fin >= '$fa' and s.id_sitio = '$place_id' group by c.id_cupon;";
            $result = mysqli_query($dbh, $cs) or die(mysqli_error());
            foreach ($result as $res) {
                $cupones[] = $res;
            }
            return $cupones;
        } else {
            header("HTTP/1.0 400 Bad Request");
            die();
        }
    }

}

$cupones = array();
if (isset($_GET["place_id"])) {
    $cupones = Cupones::search_cupons_ofasite();
} else if (isset($_GET["only_from_user"])) {
    
}
echo json_encode($cupones);
