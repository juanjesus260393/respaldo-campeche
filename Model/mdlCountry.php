<?php

require_once('Conexion.php');

class Country {

    private $db;
    private $pais;

    public function __construct() {
        $this->db = Conectar::con();
        $this->pais = array();
    }

    public function getCountry() {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            echo header("HTTP/1.0 405 Method Not Allowed");
            exit();
        }
        if (isset($_GET['q'])) {
            $sqlconsulta = ("SELECT p.id_pais, p.nombre FROM pais p");
            $resultado = $this->db->query($sqlconsulta);
            if ($resultado) {
                $response = array();
                while ($filas = $resultado->fetch_row()) {
                    $response["id_pais"] = $filas[0];
                    $response["nombre"] = $filas[1];
                    $this->pais[] = $response;
                }
                header("HTTP/1.1 200 Ok");
                $resultado->close();
                echo json_encode($this->pais);
            } else {
                echo header("HTTP/1.1 404 Not Found");
            }
        } else {
            header("HTTP/1.1 400 Bad Request");
        }
    }

}
