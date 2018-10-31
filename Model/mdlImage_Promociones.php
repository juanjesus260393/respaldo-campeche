<?php
/**
 * Description of mdlImage_Promociones
 *
 * @author Pablo
 */
require_once('Conexion.php');
class Image_Promociones {
    public function image() {
       // include 'mdlSeguridad.php';
        if (isset($_GET['id'])) {
    if (strlen($_GET['id']) > 0) {
        $end = "jpg";
        //Ruta en la que se encuentran almacenadas la vista previa de los Paquetes
        $file = '../Imagenes/paquetes/' . $_GET['id'] . '.' . $end;
        $type = 'image/jpg';
        header('Content-Type:' . $type);
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }
} else {
    header("HTTP/1.0 400 Bad Request");
    die();
}
    }
    
    public  function search_galery() {
       // include 'mdlSeguridad.php';
        if (isset($_GET["event_id"])) {
            $id = $_GET["event_id"];
            $dbh = Conectar::con();
            //Consulta que se encarga de obtener los identicadores de las imagenes
            $str = "SELECT g.id_imagen as image_id FROM paquete p inner join galeria_paquete g on p.id_paquete = g.id_paquete where p.status='A' and  p.id_paquete = $id;";
            $result = mysqli_query($dbh, $str) or die(mysqli_error());
            $imagenes = array();          
            foreach ($result as $res) {
                $imagenes[] = $res;
            }
            echo json_encode($imagenes);
        } else {
            header("HTTP/1.0 400 Bad Request");
            die();
        }
    }
}
