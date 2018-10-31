<?php

require_once('Conexion.php');

//Clase funciones se definen funciones especificas para algunos ws
Class Funcionnes {

    //Funcion que obtiene la informacion de los turistas en base al token
    public static function get_user_dates($Stoken) {
        $data = array();
        $dbh = Conectar::con();
        //Funcion para realizar la consulta de la ubicacion y regresar la laptitud y la longitud
        $cs = "select * from token t where t.token = '$Stoken';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        //Si no se encuentra en la tabla empresa ni en la tabla authorities
        if (!$filas[0]) {
            header("HTTP/1.0 401 Unauthorized");
            exit();
        } else {
            //Array que se regresa con los datos obtenidos de la tabla token
            $data ['username'] = $username = $filas['username'];
            $data ['token'] = $tokenbd = $filas['token'];
            $data ['id_dispositivo'] = $vigenciabd = $filas['id_dispositivo'];
        }
        return $data;
    }

    //Funcion que obtiene la cantidad de visualizaciones de los videos
    public static function get_vistas($id_video_archivo) {
        $dbh = Conectar::con();
        //Consulta que busca la cantida dde visualizacion de un video en base a un identificador previamente obtenido
        $cs = "SELECT v.id_video,v.visualizaciones from video v where v.id_video_archivo = '$id_video_archivo';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        if (!$filas[0]) {
            //Si no existe un retgistro que coincida se envia el ecmabezado 401 y se terminan las operaciones en php
            header("HTTP/1.0 401 Unauthorized");
            exit();
        } else {
            //Si existe un registro se envia a la funcion set-new-vistas las visualizaciones, y el identificador del video
            $visualizaciones = $filas['visualizaciones'];
            $id_video = $filas['id_video'];
            Funcionnes::set_new_vistas($visualizaciones, $id_video);
        }
    }

//Funcion que actualiza la cantida de visualizaciones de un video
    public static function set_new_vistas($visualizaciones, $id_video) {
        $dbh = Conectar::con();
        $new_visualzacion = $visualizaciones + 1;
        $sql = "UPDATE video SET visualizaciones = $new_visualzacion WHERE  id_video='$id_video';";
        if (!mysqli_query($dbh, $sql)) {
            //Si no se realiza la ctualizacion se envia el emcabezado 409
            header("HTTP/1.0 401 Unauthorized");
            exit();
        }
        
    }

//Funcion para veriricar la identidad de un turista
    public static function verify_identify($Stoken) {
        $data = array();
        $dbh = Conectar::con();
        //Se reliza una consulta en base al token obtenido del dispositivo en la tabla token
        $cs = "select * from token t where t.token = '$Stoken';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        if (!$filas[0]) {
            //Si no se encuentra un registro asociado a esa busqueda se arroja el encabezado 401
            header("HTTP/1.0 401 Unauthorized");
            exit();
        } else {
            //Si la busquedad es verdadera se obtiene el token
            $data ['token'] = $tokenbd = $filas['token'];
        }
        return $data;
    }

//Funcion para definir el tipo deusuario en base al username proporcionad
    public static function define_type_of_user($user_name) {
        $conn = new Conectar();
        $pd = $conn->con();
        //Primero se realiza una busquedad en la tabla turista
        $consultatoken = "SELECT u.username from turista u  where u.username = '" . $user_name . "'";
        $resultadoconsultatoken = mysqli_query($pd, $consultatoken) or die(mysqli_error());
        $fila1 = mysqli_fetch_array($resultadoconsultatoken);
        //Si no se encuentra un resultado que coincida se procede a buscar en la tabla usuario empresa
        if (!$fila1[0]) {
            $cuempresa = "SELECT u.username from users u inner join usuario_empresa e on u.username = e.username where e.username = '" . $user_name . "';";
            $rcempresa = mysqli_query($pd, $cuempresa) or die(mysqli_error());
            $fila2 = mysqli_fetch_array($rcempresa);
            if (!$fila2[0]) {
                //Si no coincide ninguna de las dos busqueda se regresa un encabezado
                exit();
            } else {
                //Si el resultado de la busqueda en la tabla usuario empresa  se obtiene un registro se define el usuario cajero
                $user_type = 'C';
            }
        } else {
            //Si el resultado de la busqueda en la tabla turista se obtiene un registro se define el usuario turista
            $user_type = 'T';
        }
        return $user_type;
    }

//Funcion para actualizar la vigencia del token
    public static function set_new_vigencia() {
        $dates = array();
        $fecha = date('Y-m-d H:i:s');
        $dt = new DateTime($fecha);
        $dt->modify('+ 1 year');
        //Se actualiza la vigencia del token por un añi aoartir de este dia
        $dates ['date_user'] = $new_vigencia_user = $dt->format("d/m/Y H:i:s");
        $dates ['date_bd'] = $cadena_fecha_vigenciadb = $dt->format("Y-m-d H:i:s");
        return $dates;
    }

//Funcion para obtener el primer dia de la semana
    public static function set_firts_day_of_week() {
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        //Se obtiene el primer dia de la semana en base a la semana actual
        $diaSemana = date("w", mktime(0, 0, 0, $month, $day, $year));
        if ($diaSemana == 0)
            $diaSemana = 7;
        $primerDia = date("Y-m-d 00:00:00", mktime(0, 0, 0, $month, $day - $diaSemana + 1, $year));
        return $primerDia;
    }

//Funcion que actualiza la vigencia del token del turista
    public static function update_tourist($user_name, $user_tok, $user_id, $vigencia_json, $vigencia_bd) {
        $conn = new Conectar();
        $pd = $conn->con();
        $user_r['token'] = $user_tok;
        $user_r['expire_at'] = $vigencia_json;
        $user_r['user_type'] = 'T';
        $sql = "UPDATE token SET vigencia='$vigencia_bd' WHERE username = '$user_name' and id_dispositivo = '$user_id' and token = '$user_tok';";
        if (!mysqli_query($pd, $sql)) {
            //Si la actualizacion no se puede realizar se envia un emcabezado 409
            header("HTTP/1.0 409 Conflict");
            exit();
        }
        mysqli_close($pd);
        return $user_r;
    }

//Funcion qu actualiza la vigencia de un cajero
    public static function update_cashier($user_name, $user_tok, $user_id, $vigencia_json, $vigencia_bd) {
        $conn = new Conectar();
        $pd = $conn->con();
        $user_r['token'] = $user_tok;
        $user_r['expire_at'] = $vigencia_json;
        $user_r['user_type'] = 'C';
        $sql = "UPDATE token SET vigencia='$vigencia_bd' WHERE username = '$user_name' and id_dispositivo = '$user_id' and token = '$user_tok';";
        if (!mysqli_query($pd, $sql)) {
            //Si la actualizacion no se puede realizar se envia un emcabezado 409
            header("HTTP/1.0 409 Conflict");
            exit();
        }
        mysqli_close($pd);
        return $user_r;
    }

}
