<?php

require_once ('../vendor/autoload.php');

class add_Eventos_model {

    private $db;
    private $pas;
    private $resu;

    public function __construct() {
        $this->db = Conectar::con();
        $this->categorias = array();
        $this->id = array();
    }

    public function get_categorias() {

        $sqlconsulta = ("SELECT e.id_evento_categoria, e.nombre FROM evento_categoria e order by e.id_evento_categoria");

        $resultado = $this->db->query($sqlconsulta);
        while ($filas = $resultado->fetch_row()) {
            $this->categorias[] = $filas;
        }

        $resultado->close();
//$this->db->close();

        return $this->categorias;
    }

    public function get_sitios() {

        $sqlconsulta = ("SELECT s.id_sitio, s.nombre, m.nombre FROM sitio s INNER JOIN municipio m ON s.id_municipio=m.id_municipio WHERE id_empresa=" . $_SESSION['idemp']);

        $resultado = $this->db->query($sqlconsulta);
        while ($filas = $resultado->fetch_row()) {
            $this->sitios[] = $filas;
        }

        $resultado->close();
//$this->db->close();

        return $this->sitios;
    }

    public function add_evento() {

        $nombre = $_POST['nombre'];
        $categorias = (int) $_POST['categorias'];
        $descripcion = $_POST['descripcion'];
        $fecha = $_POST['fecha'];
        $lugar = $_POST['lugar'];
        $idsitio = $_POST['sitios'];
        $costo = htmlspecialchars($_POST['costo']);
        $beneficiario = $_POST['beneficiario'];

        $posx = $_POST['cordx'];
        $posy = $_POST['cordy'];
        $point = "PointFromText('POINT(" . $posx . " " . $posy . ")')";

        $pathimagen = "../Imagenes/eventos/img/";



        $valid_formatsimg = array("jpg"); //extensiones permitidas para imagenes
        $id_imagen = $_FILES['idimagen']['name']; //input file name in this code is file1

              
        
        
if($_FILES['idimagen']['error']===0) 
{
    
    $fileInfoPerfil = pathinfo($id_imagen);
    $extPerfil = $fileInfoPerfil['extension'];
        
    if (in_array($extPerfil, $valid_formatsimg)) {
            
        $auxp= random_bytes(12);

        $actual_image_name1 = substr(bin2hex( $auxp), 0, 12);

           
        $tmp1 = $_FILES['idimagen']['tmp_name'];

        if (move_uploaded_file($tmp1, $pathimagen . $actual_image_name1 . "." . $extPerfil)) {
                
        } else {
                echo "failed";


      

            }
}}

        $hoy = date("Y-m-d");
        $idunicoRev = 0;
        $idunicositio = 0;

        $sql = ("select max(id_revision_evento) from revision_evento");
        $resu = $this->db->query($sql);

        $id_sig = $resu->fetch_row();
        if (is_null($id_sig[0])) {
            $idunicoRev = 1;
        } else {
            $idunicoRev = $id_sig[0] + 1;
        }

       $sql = ("select max(id_evento) from evento");
        $resu = $this->db->query($sql);
        $id_sig = $resu->fetch_row();
        if (is_null($id_sig[0])) {
            $idunicositio = 1;
        } else {
            $idunicositio = $id_sig[0] + 1;
        }
        $sqlinsert = ("INSERT INTO revision_evento (id_revision_evento,fecha_creacion, fecha_actualizacion, id_sitio,status) VALUES" . "(" . $idunicoRev . ",'" . $hoy . "','0000-00-00'," . $idsitio . ",'C')");
        $agregado = $this->db->query($sqlinsert);
        if ($agregado) {

            $sqlinsert2 = ("INSERT INTO evento (id_evento, id_evento_categoria, nombre, descripcion, fecha, lugar, costo, beneficiario,imagen,ubicacion, id_revision_evento) VALUES (" . $idunicositio . "," . $categorias . ",'" . $nombre . "','" . $descripcion . "','" . $fecha . "','" . $lugar . "'," . $costo . ",' " . $beneficiario . "','" . $actual_image_name1 . "'," . $point . "," . $idunicoRev . ")");

            $revagregada = $this->db->query($sqlinsert2);
            if ($revagregada) {
                echo ("<script> alert('Nuevo Evento agregado a la Cartelera'); </script>");
                header("Location:https://localhost/campeche-web2/Controller/setEventos_controller.php");
            } else {
                printf("Errormessage: %s\n", $this->db->error);
            }
        } else {
            printf("Errormessage: %s\n", $this->db->error);
        }
    }

}
