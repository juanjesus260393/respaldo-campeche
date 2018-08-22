<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');

class Sectores {

    private $dbh;

    public static function search_sitio() {
        $dbh = Conectar::con();
        $sector_id = $_GET['id'];
        $cs = "SELECT s.id_sitio  AS place_id, 
s.nombre as name, t.nombre as sector, d.descripcion_corta as short_description,
d.descripcion_larga as long_description, s.direccion as address, s.telefono1 as first_telephone, s.telefono2 as second_telephone,
i.url_sitio_web as web_url, s.horario as schedule,s.capacidad as capacity, i.id_carta as menu_id, i.id_imagen_perfil as profile_img_id,
e.id_logo as logo_id, '19.83466' as latitude,'-90.55410' as longitude, '5.0' as score, 'true' as rated, e.facebook,
e.twitter, e.instagram, e.youtube, e.googleplus FROM empresa e inner join sitio s on e.id_empresa = s.id_empresa 
inner join sector t on e.id_sector = t.id_sector inner join sitio_has_calificacion h on s.id_sitio = h.id_sitio inner join 
calificacion c on h.id_calificacion = c.id_calificacion inner join revision_informacion i on s.id_sitio = i.id_sitio 
inner join descripcion_idioma d on i.id_revision_informacion= d.id_revision_informacion where d.lang_code = 'ES' and s.id_sitio = '$sector_id' order by s.id_sitio;";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        foreach ($result as $res) {
            $sectores[] = $res;
        }
        return $sectores;
    }

}

$sec2 = Sectores::search_sitio();
//print_r($sec2);
echo json_encode($sec2);
