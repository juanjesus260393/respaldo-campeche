<?php

/**
 * Description of mdlVacante
 *
 * @author Pablo
 */
require_once('Conexion.php');

class Vacante {

    private $db;
    private $vacantes;

    public function __construct() {
        $this->db = Conectar::con();
        $this->vacantes = array();
    }

    public function Search_Vacantes() {
        include 'mdlSeguridad.php';
        $buscar = (isset($_GET['q'])) ? $_GET['q'] : '';
        $limit = (isset($_GET['limit'])) ? ' limit ' . $_GET['limit'] : '';
        $tempo = (isset($_GET['temporal'])) ? "  V.tiempo=" . $_GET['temporal'] : '';
        $sector = (isset($_GET['sector'])) ? "  s.nombre='" . $_GET['sector'] . "'" : '';
        $orden = (isset($_GET['sort'])) ? " Order By V.nombre " . $_GET['sort'] : " Order By V.nombre " . "ASC";
        if (!empty($tempo) and ! empty($sector)) {
            $filter = " WHERE " . $tempo . " and " . $sector . "" . $orden . "" . $limit;
        } elseif (empty($tempo) and ! empty($sector)) {
            $filter = " WHERE " . $sector . " " . $orden . "" . $limit;
        } elseif (empty($sector) and ! empty($tempo)) {
            $filter = " WHERE " . $tempo . " " . $orden . "" . $limit;
        } elseif (isset($_GET['sort'])) {
            $filter = $orden . "" . $limit;
        } elseif (!empty($buscar)) {
            Vacante::search_vacante_by_word($buscar);
        }

        if (isset($filter)) {
            //echo "filter";
            Vacante::Filter_vacante($filter);
            // exit();
        } else {
            if (!isset($_GET['q'])) {
                //echo "load todo";
                Vacante::Search_texto('');
            } else {
                Vacante::Search_texto($buscar);
                // echo "buscar";
            }
        }
    }

    public static function Search_texto($textobuscar) {
        $conn = new Conectar;
        $aux = $conn->con();
        $buscarVacante = mysqli_prepare($aux, "SELECT V.nombre, V.salario, V.horario, V.escolaridad, V.habilidades, V.descripcion, V.tiempo as temporal, V.genero, V.rango_edad, V.experiencia, E.nombre as empresa, s.nombre as sector, E.direccion, e.telefono,  E.id_logo, date_format(v.fecha_creacion, '%Y-%m-%d') as fecha_creacion FROM vacante V INNER JOIN revision_objeto r_obj ON V.id_revision_objeto=r_obj.id_revision_objeto INNER JOIN empresa E ON E.id_empresa=r_obj.id_empresa INNER JOIN sector s ON e.id_sector=s.id_sector where r_obj.status='A' and V.nombre like CONCAT('', ? , '%')");
        mysqli_stmt_bind_param($buscarVacante, "s", $textobuscar);
        mysqli_stmt_execute($buscarVacante);
        mysqli_stmt_store_result($buscarVacante);
        mysqli_stmt_bind_result($buscarVacante, $nombre, $salario, $horario, $escolaridad, $habilidades, $descripcion, $tiempo, $genero, $rango_edad, $experiencia, $empresa, $sector, $direccion, $telefono, $logo, $vigencia);
        $response = array();
        $registro = array();
        $filas = mysqli_stmt_num_rows($buscarVacante);
        while (mysqli_stmt_fetch($buscarVacante)) {
            $response["nombre"] = $nombre;
            $response["salario"] = $salario;
            $response["horario"] = $horario;
            $response["escolaridad"] = $escolaridad;
            $response["habilidades"] = $habilidades;
            $response["descripcion"] = $descripcion;
            $response["temporal"] = $tiempo;
            $response["genero"] = $genero;
            $response["rango_edad"] = $rango_edad;
            $response["experiencia"] = $experiencia;
            $response["empresa"] = $empresa;
            $response["sector"] = $sector;
            $response["direccion"] = $direccion;
            $response["telefono"] = $telefono;
            $response["id_logo"] = $logo;
            $response["fecha"] = $vigencia;
            $registro[] = $response;
        }
        if ($filas != 0) {
            header("HTTP/1.1 200 ok");
            echo json_encode($registro);
        } elseif ($filas == 0) {
            echo json_encode($registro);
        }
    }

    public static function search_vacante_by_word($buscar) {
        $videos = array();
        $dbh = Conectar::con();
        $consultaue = "SELECT V.nombre, V.salario, V.horario, V.escolaridad, V.habilidades, V.descripcion, V.tiempo as temporal, "
                . "V.genero, V.rango_edad, V.experiencia, E.nombre as empresa, s.nombre as sector, E.direccion, E.telefono,"
                . " E.id_logo, date_format(v.fecha_creacion, '%Y-%m-%d') as fecha "
                . "FROM vacante V INNER JOIN revision_objeto r_obj ON V.id_revision_objeto=r_obj.id_revision_objeto "
                . "INNER JOIN empresa E ON E.id_empresa=r_obj.id_empresa INNER JOIN sector s "
                . "ON e.id_sector=s.id_sector  where r_obj.status='A' and V.nombre like '%$buscar%' limit 15;";
        $resultado2 = mysqli_query($dbh, $consultaue) or die(mysqli_error());
        if ($resultado2) {
            foreach ($resultado2 as $res) {
                $videos[] = $res;
            }
            header("HTTP/1.0 200 Ok");
            echo json_encode($videos);
        } else {
            header("HTTP/1.1 404 no found");
            echo json_encode($videos);
        }
    }

    public static function Filter_vacante($filter) {
        $conn = new Conectar;
        $aux = $conn->con();
        $registro = array();
        $str = "SELECT V.nombre, V.salario, V.horario, V.escolaridad, V.habilidades, V.descripcion, V.tiempo as temporal, V.genero, V.rango_edad, V.experiencia, E.nombre as empresa, s.nombre as sector, E.direccion, E.telefono, E.id_logo, date_format(v.fecha_creacion, '%Y-%m-%d') as fecha FROM vacante V INNER JOIN revision_objeto r_obj ON V.id_revision_objeto=r_obj.id_revision_objeto INNER JOIN empresa E ON E.id_empresa=r_obj.id_empresa INNER JOIN sector s ON e.id_sector=s.id_sector  where r_obj.status='A' and " . $filter;
        $resultado = mysqli_query($aux, $str);
        if ($resultado) {
            foreach ($resultado as $res) {
                $registro[] = $res;
            }
            header("HTTP/1.0 200 Ok");
            echo json_encode($registro);
        } else {
            echo $registro;
        }
    }

}
