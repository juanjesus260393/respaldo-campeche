<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');

//Clase comentario que se encarga de obtener los comentario de un sitio en base al usuario
class Comentario {

//Funcion que se encarga de obtener el nombre de usuario en base a un token
    public static function get_username($Stoken) {
        $dbh = Conectar::con();
        $cs = "select t.username from token t where t.token = '$Stoken';";
        $result = mysqli_query($dbh, $cs) or die(mysqli_error());
        $filas = mysqli_fetch_array($result);
        if (!$filas[0]) {
            //Si no se obtiene un registro de la consulta se envia mensaje 404
            header("HTTP/1.0 404 Not Found");
            exit();
        } else {
            //Si la consulta es exitosa se regresa el nombre de usuario
            $username = $filas['username'];
        }
        return $username;
    }

//Funcion que se encarga de buscar los comentarios de un sitio
    public static function sears_coments() {
        if (isset($_GET["place_id"])) {
            $id = $_GET["place_id"];
            $dbh = Conectar::con();
            $cs = "SELECT c.comentario as comment, c.calificacion as score, date_format(c.fecha_creacion, '%Y-%m-%d') as creation_date FROM calificacion c inner join sitio_has_calificacion h
 on c.id_calificacion = h.id_calificacion inner join sitio s on s.id_sitio = h.id_sitio where s.id_sitio = '$id';";
            $result = mysqli_query($dbh, $cs) or die(mysqli_error());
            $comentarios = array();
            $comentarios2 = array();
            foreach ($result as $res) {
                //Si la consulta es exitosa se regresa un arreglo con los comentario de un sitio
                $comentarios[] = $res;
            }
            if ($comentarios == null) {
                //Si se tienen comentario se regresa un arreglo vacio
                $comentarios = $comentarios2;
            }
            return $comentarios;
        } else {
            header("HTTP/1.0 400 Bad Request");
            die();
        }
    }

//Funcion que registra el comentario de un sitio
    public static function register_coment($user) {
        $coments = array();
        $_POST = json_decode(file_get_contents("php://input"), true);
        if (isset($_POST['comment']) && isset($_POST['score'])) {
            $comment = $_POST['comment'];
            $score = $_POST['score'];
            //Se obtiene el identidicador de un sitio
            if (isset($_GET["place_id"])) {
                $pd = Conectar::con();
                $id = $_GET["place_id"];
                $na = new validacion();
                $fa = $na->fecha_actual();
                //Si se obtiene el identificador de un sitio se registra el comentario y su calificacion
                $idro = $na->generar_aleatorio();
                $coments ['comment'] = $comment;
                $coments ['score'] = $score;
                $coments['creation_date'] = $fa;
                $sql2 = "INSERT INTO calificacion(id_calificacion,username,comentario,calificacion,fecha_creacion)
        VALUES('$idro','$user','$comment','$score','$fa')";
                if (!mysqli_query($pd, $sql2)) {
                    die('Error: ' . mysqli_error($pd));
                }
                $sql = "INSERT INTO sitio_has_calificacion(id_calificacion,id_sitio)
        VALUES('$idro','$id')";
                if (!mysqli_query($pd, $sql)) {
                    die('Error: ' . mysqli_error($pd));
                }
                mysqli_close($pd);
                //Si el registro se realiza exitosamente se envia el mensaje 200
                header("HTTP/1.0 200 OK");
                return $coments;
                exit();
            } else {
                //Si no se realiza el registro se envia el mensaje 400
                header("HTTP/1.0 400 Bad Request");
                die();
            }
        }
    }

}

include 'mdlSeguridad.php';
$coments;
if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $coments = Comentario::sears_coments();
} else if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $arr = apache_request_headers();
    $CTOKEN = $arr['Authorization'];
    $Cseparada = preg_split("/[\s,]+/", $CTOKEN, 4);
    $Stoken = $Cseparada[1];
    $user = Comentario::get_username($Stoken);
    $coments = Comentario::register_coment($user);
} else {
    header("HTTP/1.0 400 Bad Request");
}
echo json_encode($coments);
