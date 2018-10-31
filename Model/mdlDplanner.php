<?php

/**
 * Description of mdlDplanner
 *
 * @author Pablo
 */
require_once('conexion.php');

class Dplanner {

    private $db;
    private $Evento;

    public function __construct() {
        $this->db = Conectar::con();
        $this->Evento = array();
    }

    public function getEventos() {
        include 'mdlSeguridad.php';
        $username = $usernamebd;
        if (isset($_GET['q'])) {
            $solicitud = $_GET['q'];
            //Eventos de Cartelera
            if ($solicitud == 'C') {
                Dplanner::getEventosCartelera($username);
            } elseif ($solicitud == 'P') {
                //Eventos personales
                Dplanner::getEventosPersonales($username);
            } elseif ($solicitud == 'agenda') {
                //Eventos de agenda
                Dplanner::getEventosAgenda($username);
            } else {
                Dplanner::getEventosFecha($username, $solicitud);
            }
        } else {
            header("HTTP/1.0 400 Bad Request");
        }
    }

    private function getEventosCartelera($username) {
        //$str = ("select e.id_evento, e.nombre as evento, e.imagen, e.descripcion, e.lugar, date_format(e.fecha, '%H:%I') as hora, date_format(e.fecha, '%Y-%m-%d')as finicio, ST_X(e.ubicacion) as latitude, ST_Y(e.ubicacion) as longitude from evento e INNER JOIN revision_evento r on e.id_revision_evento=r.id_revision_evento INNER JOIN sitio s on s.id_sitio = r.id_sitio INNER JOIN  actividad_cartelera c on e.id_evento=c.id_actividad  where r.status='A' and c.username='$username' ");         
        $str = ("select c.id_actividad_cartelera, e.nombre as evento, e.imagen, e.descripcion, e.lugar, date_format(e.fecha, '%H:%I') as hora, date_format(e.fecha, '%Y-%m-%d')as finicio, ST_X(e.ubicacion) as latitude, ST_Y(e.ubicacion) as longitude from evento e INNER JOIN revision_evento r on e.id_revision_evento=r.id_revision_evento INNER JOIN sitio s on s.id_sitio = r.id_sitio INNER JOIN  actividad_cartelera c on e.id_evento=c.id_evento  where r.status='A' and c.username='$username'");
        $resultado = $this->db->query($str);
        $response = array();
        if ($resultado) {
            while ($filas = $resultado->fetch_row()) {
                $response["id_actividad"] = $filas[0];
                $response["evento"] = $filas[1];
                $response["imagen"] = $filas[2];
                $response["descripcion"] = $filas[3];
                $response["lugar"] = $filas[4];
                $response["hora"] = $filas[5];
                $response["finicio"] = $filas[6];
                $response["latitude"] = $filas[7];
                $response["longitude"] = $filas[8];
                $response["tipoevento"] = "C";
                $this->Evento[] = $response;
            }
            $resultado->close();
        }
        echo json_encode($this->Evento);
    }

    private function getEventosPersonales($username) {
        $str = ("SELECT id, nombre as evento, descripcion, lugar, date_format(fecha_inicio, '%H:%I') as hora, date_format(fecha_inicio, '%Y-%m-%d')as finicio,date_format(fecha_fin, '%Y-%m-%d') as ffin from actividad where username='$username'");
        $resultado1 = $this->db->query($str);
        if ($resultado1) {
            while ($filas1 = $resultado1->fetch_row()) {
                $response["id_actividad"] = $filas1[0];
                $response["evento"] = $filas1[1];
                $response["descripcion"] = $filas1[2];
                $response["lugar"] = $filas1[3];
                $response["hora"] = $filas1[4];
                $response["finicio"] = $filas1[5];
                $response["ffin"] = $filas1[6];
                $response["tipoevento"] = "P";
                $this->Evento[] = $response;
            }
            $resultado1->close();
        }
        echo json_encode($this->Evento);
    }

    private function getEventosFecha($username, $fecha) {
        //Eventos de cartelera
        $str = ("select c.id_actividad, e.nombre as evento, e.descripcion from evento e INNER JOIN revision_evento r on e.id_revision_evento=r.id_revision_evento INNER JOIN sitio s on s.id_sitio = r.id_sitio INNER JOIN  actividad_cartelera c on e.id_evento=c.id_evento  where r.status='A' and c.username='$username' and  fecha BETWEEN '$fecha' and '$fecha" . " 23:59:59'");
        $resultado = $this->db->query($str);
        $response = array();
        if ($resultado) {
            while ($filas = $resultado->fetch_row()) {
                $response["id_actividad"] = $filas[0];
                $response["evento"] = $filas[1];
                $response["descripcion"] = $filas[2];
                $response["tipoevento"] = "C";
                $this->Evento[] = $response;
            }
            $resultado->close();
        }
        //eventos personales
        $sqlconsulta1 = ("SELECT id_actividad, nombre as evento, descripcion from actividad where fecha_inicio BETWEEN '$fecha' and '$fecha" . " 23:59:59' and username='$username' ");
        $resultado1 = $this->db->query($sqlconsulta1);
        if ($resultado1) {
            while ($filas1 = $resultado1->fetch_row()) {
                $response["id_actividad"] = $filas1[0];
                $response["evento"] = $filas1[1];
                $response["descripcion"] = $filas1[2];
                $response["tipoevento"] = "P";
                $this->Evento[] = $response;
            }
            $resultado1->close();
        }
        if (empty($this->Evento)) {
            echo json_encode($this->Evento);
        } else {
            header("HTTP/1.0 200 Ok");
            echo json_encode($this->Evento);
        }
    }

    private function getEventosAgenda($username) {
        //Eventos de cartelera
        $str = ("select c.id_actividad, e.nombre, e.descripcion,  date_format(e.fecha, '%Y-%m-%d')as finicio  from evento e INNER JOIN revision_evento r on e.id_revision_evento=r.id_revision_evento INNER JOIN sitio s on s.id_sitio = r.id_sitio INNER JOIN  actividad_cartelera c on e.id_evento=c.id_evento  where r.status='A' and c.username='$username' ");
        $resultado = $this->db->query($str);
        $response = array();
        if ($resultado) {
            while ($filas = $resultado->fetch_row()) {
                $response["id_actividad"] = $filas[0];
                $response["nombre"] = $filas[1];
                $response["descripcion"] = $filas[2];
                $response["fecha"] = $filas[3];
                $response["tipoevento"] = "C";
                $this->Evento[] = $response;
            }
            $resultado->close();
        }
        //eventos personales
        $sqlconsulta1 = ("SELECT id_actividad, nombre, descripcion, date_format(fecha_inicio, '%Y-%m-%d')as finicio from actividad where username='$username'");
        $resultado1 = $this->db->query($sqlconsulta1);
        if ($resultado1) {
            while ($filas1 = $resultado1->fetch_row()) {
                $response["id_actividad"] = $filas1[0];
                $response["nombre"] = $filas1[1];
                $response["descripcion"] = $filas1[2];
                $response["fecha"] = $filas1[3];
                $response["tipo"] = "P";
                $this->Evento[] = $response;
            }
            $resultado1->close();
        }
        if (empty($this->Evento)) {
            echo json_encode($this->Evento);
        } else {
            header("HTTP/1.0 200 Ok");
            echo json_encode($this->Evento);
        }
    }

}
