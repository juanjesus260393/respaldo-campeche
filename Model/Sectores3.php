<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');

class Sector {

    public static function getubicacion($id_sitio) {
        $dbh = Conectar::con();
        //Funcion para realizar la consulta de la ubicacion y regresar la laptitud y la longitud
        $cs = "SELECT ST_X(r.ubicacionGIS) as latitude, ST_Y(r.ubicacionGIS) as longitude FROM sitio s inner join revision_informacion r on s.id_sitio = r.id_sitio where s.id_sitio = '$id_sitio';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra en la tabla empresa ni en la tabla authorities
        if (!$filas[0]) {
            $latitude = '0.0';
            $longitude = '0.0';
        } else {
            $latitude = $filas['latitude'];
            $longitude = $filas['longitude'];
        }
        return array($latitude, $longitude);
    }

    public static function getuser($Stoken) {
        $dbh = Conectar::con();
        //Funcion para realizar la consulta de la ubicacion y regresar la laptitud y la longitud
        $cs = "select t.username from token t where t.token = '$Stoken';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra en la tabla empresa ni en la tabla authorities
        if (!$filas[0]) {
            header("HTTP/1.0 404 Not Found");
            exit();
        } else {
            $username = $filas['username'];
        }
        return $username;
    }

    public static function getrated($user, $id_sitio) {
        $dbh = Conectar::con();
        //Funcion para realizar la consulta de la ubicacion y regresar la laptitud y la longitud
        $cs = "select c.id_calificacion from empresa e inner join sitio s on e.id_empresa = s.id_empresa inner join sitio_has_calificacion h 
on s.id_sitio = h.id_sitio inner join calificacion c on h.id_calificacion = c.id_calificacion where s.id_sitio = '$id_sitio' 
and c.username = '$user';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        if (!$filas[0]) {
            $rated = 'false';
        } else {
            $rated = 'true';
        }
        return $rated;
    }

    public static function getscore($id_sitio) {
        $dbh = Conectar::con();
        $score = '0';
        //Funcion para realizar la consulta de la ubicacion y regresar la laptitud y la longitud
        $cs = "SELECT count(c.calificacion) as score  from sitio s inner join sitio_has_calificacion h on s.id_sitio = h.id_sitio 
inner join calificacion c on h.id_calificacion = c.id_calificacion where s.id_sitio = '$id_sitio';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        if (!$filas[0]) {
            $cantidade = '0';
        } else {
            $cs2 = "SELECT sum(c.calificacion) as score2  from sitio s inner join sitio_has_calificacion h on s.id_sitio = h.id_sitio 
inner join calificacion c on h.id_calificacion = c.id_calificacion where s.id_sitio = '$id_sitio';";
            $result2 = mysqli_query($dbh, $cs2) or die(mysqli_error());
            $filas2 = mysqli_fetch_array($result2);
            if (!$filas2[0]) {
                header("HTTP/1.0 404 Not Found");
                exit();
            } else {
                $cantidadc = $filas2['score2'];
            }
            $cantidade = $filas['score'];
            $score = $cantidadc / $cantidade;
        }
        return $score;
    }

    public static function search_sitio() {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $dbh = Conectar::con();
            $ubi = new Sector();
            list($lap, $lon) = $ubi->getubicacion($id);
            //enviar el nombre de usuario
            $arr = apache_request_headers();
            $CTOKEN = $arr['Authorization'];
            $Cseparada = preg_split("/[\s,]+/", $CTOKEN, 4);
            $Stoken = $Cseparada[1];
            $user = $ubi->getuser($Stoken);
            $rated = $ubi->getrated($user, $id);
            $score = $ubi->getscore($id);
            $score2 = round($score, 1);
            //Funcion para realizar la consulta de la ubicacion y regresar la laptitud y la longitud
            $cs = "SELECT s.id_sitio  AS place_id, 
s.nombre as name, t.nombre as sector, d.descripcion_corta as short_description,
d.descripcion_larga as long_description, s.direccion as address, s.telefono1 as first_telephone, s.telefono2 as second_telephone,
i.url_sitio_web as web_url, s.horario as schedule,s.capacidad as capacity, i.id_carta as menu_id, i.id_imagen_perfil as profile_img_id,
e.id_logo as logo_id, '$lap' as latitude,'$lon' as longitude, '$score2' as score, '$rated' as rated, e.facebook,
e.twitter, e.instagram, e.youtube, e.googleplus FROM empresa e inner join sitio s on e.id_empresa = s.id_empresa 
inner join sector t on e.id_sector = t.id_sector inner join revision_informacion i on s.id_sitio = i.id_sitio 
inner join descripcion_idioma d on i.id_revision_informacion= d.id_revision_informacion where d.lang_code = 'ES' and s.id_sitio = '$id' group by s.id_sitio;";
            $result = mysqli_query($dbh, $cs) or die(mysqli_error());
            $sitios = '';
            foreach ($result as $res) {
                $sitios = $res;
            }
            $sitios2 = NULL;
            if ($sitios == null) {
                $sitios = $sitios2;
            }
            return $sitios;
        } else {
            header("HTTP/1.0 400 Bad Request");
            die();
        }
    }

}
//Desde fuera de la clase definir el tipo de funcion
$sec = Sector::search_sitio();
echo json_encode($sec);
