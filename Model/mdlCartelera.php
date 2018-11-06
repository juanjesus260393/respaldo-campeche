<?php

/**
 * Description of mdlCartelera
 *
 * @author Pablo
 */
require_once('conexion.php');

class Cartelera {

    private $db;
    private $Evento;

    public function __construct() {
        $this->db = Conectar::con();
        $this->Evento = array();
    }

    public function get_Eventos() {
        include 'mdlSeguridad.php';
        $categoria = (isset($_GET['category'])) ? ' and c.id_evento_categoria =' . $_GET['category'] : '';
        $limite = (isset($_GET['limit'])) ? ' limit ' . $_GET['limit'] : '';
        $limit = $categoria . " " . $limite;
        $fecha1 = isset($_GET['date_start']) ? $_GET['date_start'] : null;
        $fecha2 = isset($_GET['date_end']) ? $_GET['date_end'] : null;
        $filas = null;
        $response = array();
        $aux = $this->db;
        $fecha_actual = date('Y-m-d') . " 00:00:00";
        if (isset($_GET['date_start']) || isset($_GET['date_end'])) {
            $fecha1_f = date_format(date_create($fecha1), 'Y-m-d');
            $fecha2_f = date_format(date_create($fecha2), 'Y-m-d');
            $buscarEvento = mysqli_prepare($aux, "select e.id_evento, e.nombre as evento, e.fecha, e.lugar, e.costo, e.imagen, e.descripcion, c.nombre as categoria, m.nombre as municipio, e.lugar as nombre_lugar, s.direccion, s.telefono1, s.telefono2, s.capacidad, date_format(e.fecha, '%H:%I') as hora, ST_X(e.ubicacion) as latitude, ST_Y(e.ubicacion) as longitude from evento e INNER JOIN revision_evento r on e.id_revision_evento=r.id_revision_evento INNER JOIN sitio s on s.id_sitio = r.id_sitio INNER JOIN  evento_categoria c on e.id_evento_categoria=c.id_evento_categoria INNER join municipio m on  s.id_municipio=m.id_municipio  where r.status='A' and  e.fecha BETWEEN ? and ? $limit;");
            mysqli_stmt_bind_param($buscarEvento, "ss", $fecha1_f, $fecha2_f);
            mysqli_stmt_execute($buscarEvento);
            mysqli_stmt_store_result($buscarEvento);
            mysqli_stmt_bind_result($buscarEvento, $id_evento, $evento, $fecha, $lugar, $costo, $imagen, $descripcion, $categoria, $municipio, $nombre_lugar, $direccion, $telefono1, $telefono2, $capacidad, $hora, $latitude, $longitude);
            $filas = mysqli_stmt_num_rows($buscarEvento);
            while (mysqli_stmt_fetch($buscarEvento)) {
                $response["id_evento"] = $id_evento;
                $response["evento"] = $evento;
                $response["fecha"] = $this->fechaEspniol($fecha);
                //$response["hora"] = $hora;
                $response["lugar"] = $lugar;
                $response["costo"] = $costo;
                $response["imagen"] = $imagen;
                $response["descripcion"] = $descripcion;
                $response["categoria"] = $categoria;
                $response["municipio"] = $municipio;
                $response["nombre_lugar"] = $nombre_lugar;
                $response["direccion"] = $direccion;
                $response["telefono1"] = $telefono1;
                $response["telefono2"] = $telefono2;
                $response["capacidad"] = $capacidad;
                $response["hora"] = $hora;
                $response["latitude"] = $latitude;
                $response["longitude"] = $longitude;
                $this->Evento[] = $response;
            }
        } else {
            $sqlconsulta = "select e.id_evento, e.nombre as evento, e.fecha, e.lugar, e.costo, e.imagen, e.descripcion, c.nombre as categoria, m.nombre as municipio, e.lugar as nombre_lugar, s.direccion, s.telefono1, s.telefono2, s.capacidad, date_format(e.fecha, '%H:%I') as hora, ST_X(e.ubicacion) as latitude, ST_Y(e.ubicacion) as longitude from evento e INNER JOIN revision_evento r on e.id_revision_evento=r.id_revision_evento INNER JOIN sitio s on s.id_sitio = r.id_sitio INNER JOIN  evento_categoria c on e.id_evento_categoria=c.id_evento_categoria INNER join municipio m on  s.id_municipio=m.id_municipio  where e.fecha>= '$fecha_actual' and r.status='A' $limit";
            $resultado = $this->db->query($sqlconsulta);
            while ($filas = $resultado->fetch_row()) {
                $response["id_evento"] = $filas[0];
                $response["evento"] = $filas[1];
                $response["fecha"] = $this->fechaEspniol($filas[2]);
                $response["lugar"] = $filas[3];
                $response["costo"] = $filas[4];
                $response["imagen"] = $filas[5];
                $response["descripcion"] = $filas[6];
                $response["categoria"] = $filas[7];
                $response["municipio"] = $filas[8];
                $response["nombre_lugar"] = $filas[9];
                $response["direccion"] = $filas[10];
                $response["telefono1"] = $filas[11];
                $response["telefono2"] = $filas[12];
                $response["capacidad"] = $filas[13];
                $response["hora"] = $filas[14];
                $response["latitude"] = $filas[15];
                $response["longitude"] = $filas[16];

                $this->Evento[] = $response;
            }
            $filas = $resultado->num_rows;
            $resultado->close();
        }

        echo json_encode($this->Evento);
    }

    private function fechaEspniol($fecha) {
        setlocale(LC_ALL, "es_ES.utf8", "es_ES", "esp");
        $diaSemana = strftime("%A", strtotime($fecha));
        $diaNumero = strftime("%d", strtotime($fecha));
        $mes = strftime("%B", strtotime($fecha));
        $restoFecha = strftime(" de " . ucfirst($mes) . " de %Y", strtotime($fecha));
        return ucfirst($diaSemana) . " " . $diaNumero . $restoFecha;
    }

}
