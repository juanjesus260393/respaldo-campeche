<?php
/**
 * Description of mdlPromociones
 *
 * @author Pablo
 */
require_once('Conexion.php');
class Promociones {
     public function getPromociones(){
  if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header("HTTP/1.0 405 Method Not Allowed");
    exit();
    }
        if (isset($_GET['limit']) && isset($_GET['last_id'])) {
            $limite = $_GET['limit'];
            $ultimoId = $_GET['last_id'];
            Promociones::listPromocionesLimit($ultimoId, $limite);
        }elseif (isset($_GET['limit'])) {
            $limite = $_GET['limit'];
            Promociones::listPromociones($limite);
        }else{
          header("HTTP/1.0 400 Bad Request");
        }
     } 
    private static function listPromociones($limite) {   
        $Paquete = array();
        $dbh = Conectar::con();
        $str = "select p.id_paquete, e.idempresa, p.nombre, e.descripcion, p.descripcion_corta, p.descripcion_larga, p.imagen_vista_previa as img, p.fecha_inicio, fecha_fin, e.info_contacto, e.costo from paquete p INNER JOIN empresa_paquete e ON p.id_paquete=e.idpaquete where p.status = 'A' order by p.nombre desc limit $limite;";
        $resultado = mysqli_query($dbh, $str) or die(mysqli_error());
        foreach ($resultado as $res) {
           $Paquete[]= $res;
        }
            mysqli_close($dbh);
            echo json_encode($Paquete);
        }
    private  function listPromocionesLimit($contador, $limite) {        
        $new_limit = $limite + $contador;
        $Paquete = array();
        $dbh = Conectar::con();
        $str = "select p.id_paquete, e.idempresa, p.nombre, e.descripcion, p.descripcion_corta, p.descripcion_larga, p.imagen_vista_previa as img, p.fecha_inicio, fecha_fin, e.info_contacto, e.costo from paquete p INNER JOIN empresa_paquete e ON p.id_paquete=e.idpaquete where p.status = 'A' order by p.nombre desc limit $contador, $new_limit;";
        $resultado = mysqli_query($dbh, $str) or die(mysqli_error());
        foreach ($resultado as $res) {
              $Paquete[]= $res;
        }
        mysqli_close($dbh);
        echo json_encode($Paquete);
        }
   } 
