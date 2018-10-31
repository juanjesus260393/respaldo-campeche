<?php

require_once ('../vendor/autoload.php');

use \Statickidz\GoogleTranslate;

class setEventos_model {

    private $db;
    private $sitios;
   

    public function __construct() {
        $this->db = Conectar::con();
        $this->eventos = array();
        $this->categorias = array();
       
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

    public function get_eventos() {

        $selectEventos = ("SELECT e.id_evento, e.id_evento_categoria, e.nombre, e.descripcion, e.fecha, e.lugar, e.costo, e.beneficiario, e.imagen, ST_X(e.ubicacion), ST_Y(e.ubicacion), e.id_revision_evento, c.nombre, r.id_sitio, s.nombre, r.status from evento e, evento_categoria c, revision_evento r, sitio s where e.id_revision_evento=r.id_revision_evento and e.id_evento_categoria=c.id_evento_categoria and s.id_sitio =r.id_sitio and id_empresa=" . $_SESSION['idemp']);


        $ressit = $this->db->query($selectEventos);
       
        while ($filas = $ressit->fetch_row()) {
            $this->eventos[] = $filas;
            
        }

        // $this->sitiofinal = self::getdescripciones($this->sitios, $a);
        // $this->sitiofinal = self::getGaleria($this->sitiofinal, $a);
        $ressit->close();
        // $this->db->close();
        return $this->eventos;
       
    }

public function eliminar_Evento() {
        //Se llama a la clase conectar y a la funcion conectar 
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Se obtienen los parametros de la vista del cupon
        $id_revision_evento = $_POST["id_revision_evento"];
        $id_evento = $_POST["id_evento"];
        if ($id_revision_evento == NULL && $id_evento == NULL) {
            echo '<script language = javascript> alert("No es un elemento valido en Cartelera") </script>';
            //Regresamos a la pagina anterior
            echo "<html><head></head>" .
            "<body onload=\"javascript:history.back()\">" .
            "</body></html>";
        }
                
        
        $Eliminar = "Delete from revision_evento where id_revision_evento = " . $id_revision_evento;
        $Eliminar2 = "Delete from evento where id_evento = " . $id_evento;
        if (!mysqli_query($pd, $Eliminar2)) {
            die('Error: ' . mysqli_error($pd));
        }
        if (!mysqli_query($pd, $Eliminar)) {
            die('Error: ' . mysqli_error($pd));
        }
       
    }


    public function update_Evento() {
        $idevento = $_POST['idevento'];
        $id_evento_categoria = $_POST['categorias'];
        $idrev = $_POST['idrev'];
        $nombre = $_POST['nombre'];
        $descripcion=$_POST['descripcion'];
        $fecha=$_POST['fecha'];
        $lugar=$_POST['lugar'];
        $costo=(int) $_POST['costo'];
        $beneficiario=$_POST['beneficiario'];
        $imageP = $_POST['idperfilaux'];

        $posx = $_POST['cordx'];
        $posy = $_POST['cordy'];
        $point = "PointFromText('POINT(" . $posx . " " . $posy . ")')";
       
         $idsitio = $_POST['sitios'];
//Fecha actual
        $año_actual = date("Y");
        $mes_actual = date("m");
        $dia_actual = date("d");
        $hora_actual = date("h");
        $minuto_actual = date("i");
        $segundo_actual = date("s");
        $fecha_actual = $año_actual . "" . $mes_actual . "" . $dia_actual . "" . $hora_actual . "" . $minuto_actual . "" . $segundo_actual;

      

        $pathperfil = "../Imagenes/eventos/img/";
        $valid_formatsimg = array("jpg"); //extensiones permitidas para imagenes
        


        if ($_FILES['idperfilSet']['error'] === 4) {

            $actual_image_name = $imageP;
        } else {

            $id_perfil = $_FILES['idperfilSet']['name']; //input file name in this code is file1
            $fileInfoPerfil = pathinfo($id_perfil);
            $extPerfil = $fileInfoPerfil['extension'];

            if (in_array($extPerfil, $valid_formatsimg)) {

                $auxp = random_bytes(12);

                $actual_image_name = substr(bin2hex($auxp), 0, 12);

                $tmp1 = $_FILES['idperfilSet']['tmp_name'];

                if (move_uploaded_file($tmp1, $pathperfil . $actual_image_name . "." . $extPerfil)) {
                    $actual_image_name = $actual_image_name . '.' . $extPerfil;
                } else {
                    echo "failed";
                }
            }
        }

        
        $sqlinsert = ("UPDATE evento SET id_evento_categoria=" . $id_evento_categoria . ",nombre='" . $nombre . "', descripcion='" . $descripcion . "', fecha='" . $fecha . "', lugar='" . $lugar . "', costo=" . $costo . ", beneficiario='" . $beneficiario . "', imagen='" . $actual_image_name . "', ubicacion=" . $point . " WHERE id_evento=" . $idevento . " ");
        
        $agregado = $this->db->query($sqlinsert);

    
        if ($agregado) {
            $sqlinsert2 = ("UPDATE revision_evento SET status='C',id_sitio=" . $idsitio . ", fecha_actualizacion='" . $fecha_actual . "' WHERE id_revision_evento=" . $idrev);
            $revagregada = $this->db->query($sqlinsert2);
           

                if ($revagregada) {
                    echo ("<script> alert('Evento Actualizado con Exito'); </script>");
                } else {
                    printf("Errormessage: %s\n", $this->db->error);
                }
            } else {
                printf("Errormessage: %s\n", $this->db->error);
            }
        
     
}

}
