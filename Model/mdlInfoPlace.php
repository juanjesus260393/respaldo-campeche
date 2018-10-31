<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');

class Sector {
//Modulo que se encarga de gestionar la informacion de un sitio
    public static function getubicacion($id_sitio) {
        $dbh = Conectar::con();
        //Funcion para realizar la consulta de la ubicacion y regresar la laptitud y la longitud
        $cs = "SELECT ST_X(r.ubicacionGIS) as latitude, ST_Y(r.ubicacionGIS) as longitude FROM sitio s inner join revision_informacion r on s.id_sitio = r.id_sitio where s.id_sitio = '$id_sitio';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra un registro que coincida con la condicion de la consulta se regresas ambos parametros con los valores 0.0
        if (!$filas[0]) {
            $latitude = '0.0';
            $longitude = '0.0';
        } else {
            $latitude = $filas['latitude'];
            $longitude = $filas['longitude'];
        }
        return array($latitude, $longitude);
    }
//Funcion que se encarga de obtener el nombre de usuario en base a un token
    public static function getuser($Stoken) {
        $dbh = Conectar::con();
        $cs = "select t.username from token t where t.token = '$Stoken';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra un registro asociado a ese token se envia el emcabezado 404
        if (!$filas[0]) {
            header("HTTP/1.0 404 Not Found");
            exit();
        } else {
            $username = $filas['username'];
        }
        return $username;
    }
//Funcion que se encarga de obtener la calificacion de un sitio y el nombre de usuario
    public static function getrated($user, $id_sitio) {
        $dbh = Conectar::con();
        //Funcion para realizar la consulta de la ubicacion y regresar la laptitud y la longitud
        $cs = "select c.id_calificacion from empresa e inner join sitio s on e.id_empresa = s.id_empresa inner join sitio_has_calificacion h 
on s.id_sitio = h.id_sitio inner join calificacion c on h.id_calificacion = c.id_calificacion where s.id_sitio = '$id_sitio' 
and c.username = '$user';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra un registro se regresa una variable con un valor false
        if (!$filas[0]) {
            $rated = 'false';
        } else {
            //Si se encuentra un valor asociado a ese registro se regresa un valor true
            $rated = 'true';
        }
        return $rated;
    }
//Funcion que se enccarga de obtener las calificaciones que se han realizado a cada sitio
    public static function getscore($id_sitio) {
        $dbh = Conectar::con();
        $score = '0';
        //Consulta para obtener el total de las calidaciones de un sitio
        $cs = "SELECT count(c.calificacion) as score  from sitio s inner join sitio_has_calificacion h on s.id_sitio = h.id_sitio 
inner join calificacion c on h.id_calificacion = c.id_calificacion where s.id_sitio = '$id_sitio';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        if (!$filas[0]) {
            $cantidade = '0';
        } else {
            //Consulta para obtener la suma de las calidaciones de un sitio
            $cs2 = "SELECT sum(c.calificacion) as score2  from sitio s inner join sitio_has_calificacion h on s.id_sitio = h.id_sitio 
inner join calificacion c on h.id_calificacion = c.id_calificacion where s.id_sitio = '$id_sitio';";
            $result2 = mysqli_query($dbh, $cs2) or die(mysqli_error());
            $filas2 = mysqli_fetch_array($result2);
            if (!$filas2[0]) {
                header("HTTP/1.0 404 Not Found");
                exit();
            } else {
                //Suma total de las calficaciones
                $cantidadc = $filas2['score2'];
            }
            $cantidade = $filas['score'];
            //Promedio de las califaciones
            $score = $cantidadc / $cantidade;
        }
        return $score;
    }
//Funcion que se encarga de obtener la informacion de un sitio en base a su identificador
    public static function search_sitio() {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $dbh = Conectar::con();
            $ubi = new Sector();
            //Se obtiene la laptotud y longitud de un sitio
            list($lap, $lon) = $ubi->getubicacion($id);
            //enviar el nombre de usuario
            $arr = apache_request_headers();
            $CTOKEN = $arr['Authorization'];
            $Cseparada = preg_split("/[\s,]+/", $CTOKEN, 4);
            $Stoken = $Cseparada[1];
            //Se obtiene el nombre de usuario en base al token
            $user = $ubi->getuser($Stoken);
            //Se obtiene la calificacion proporcionada por un usuario en especifico
            $rated = $ubi->getrated($user, $id);
            //Se obtienen el promedio de calificaciones de un sitio
            $score = $ubi->getscore($id);
            //Calificacion redondeada
            $score2 = round($score, 1);
            //Consulta que regresa la informacion de un sitio al ws
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
include 'mdlSeguridad.php';
//Desde fuera de la clase definir el tipo de funcion
$sec = Sector::search_sitio();
echo json_encode($sec);
