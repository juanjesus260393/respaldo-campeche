<?php

require_once ('../vendor/autoload.php');

use \Statickidz\GoogleTranslate;

class add_Sitios_model {

    private $db;
    private $municipio;
    private $pas;

    public function __construct() {
        $this->db = Conectar::con();
        $this->municipo = array();
        $this->id = array();
    }

    public function get_municipios() {

        $sqlconsulta = ("SELECT m.id_municipio, m.nombre FROM municipio m WHERE 1");

        $resultado = $this->db->query($sqlconsulta);
        while ($filas = $resultado->fetch_row()) {
            $this->municipio[] = $filas;
        }

        $resultado->close();
        //$this->db->close();

        return $this->municipio;
    }

    public function add_sitio() {

        $nombre = $_POST['nombreSitio'];
        $municipios = (int) $_POST['municipios'];
        $url = $_POST['urlsitio'];
        $tel1 = (int) $_POST['tel1'];
        $tel2 = (int) $_POST['tel2'];
        $dir = htmlspecialchars($_POST['dir']);
        $capacidad = (int) $_POST['tam'];
        $posx = $_POST['cordx'];
        $posy = $_POST['cordy'];
        $point = "PointFromText('POINT(" . $posx . " " . $posy . ")')";
        $hora = ("De  " . $_POST['horaAbre'] . "  a  " . $_POST['horaCierra']);
        $descCortaES = $_POST['descripcion_corta'];
        $descLargaES = htmlspecialchars($_POST['descripcion_larga']);

        $pathperfil = "../Imagenes/Sitios/img/";
        
        $pathcarta = "../Imagenes/Sitios/carta/";
        $valid_formatsimg = array("jpg"); //extensiones permitidas para imagenes
        $valid_formatscarta = array("pdf"); //extensiones permitidas para cartas


        $id_perfil = $_FILES['idperfil']['name']; //input file name in this code is file1
        
        $id_carta = $_FILES['idcarta']['name'];

        //$size = $_FILES['id_perfil']['size'];

        $fileInfoPerfil = pathinfo($id_perfil);
        $extPerfil = $fileInfoPerfil['extension'];
        
        $fileInfoCarta = pathinfo($id_carta);
        $extCarta = $fileInfoCarta['extension'];

        if (in_array($extPerfil, $valid_formatsimg)) {

            $actual_image_name = 0;

            $aux = $id_perfil . uniqid();
            $a = str_split($aux);

            $i = 0;
            for ($i; $i < count($a); $i++) {
                $actual_image_name += ord($a[$i]);
            }
            $tmp1 = $_FILES['idperfil']['tmp_name'];

            if (move_uploaded_file($tmp1, $pathperfil . $actual_image_name . "." . $extPerfil)) {
                
            } else {
                echo "failed";
            }
        }

      

        if (in_array($extCarta, $valid_formatscarta)) {

            $actual_carta_name = 0;

            $aux = $id_carta . uniqid();
            $a = str_split($aux);

            $i = 0;
            for ($i; $i < count($a); $i++) {
                $actual_carta_name += ord($a[$i]);
            }
            $tmp3 = $_FILES['idcarta']['tmp_name'];

            if (move_uploaded_file($tmp3, $pathcarta . $actual_carta_name . "." . $extCarta)) {
                
            } else {
                echo "failed carta";
            }
        }





        $source = 'ES';
        $target1 = 'EN';
        $target2 = 'FR';


        $trans = new GoogleTranslate();
        $descCortaIngles = $trans->translate($source, $target1, $descCortaES);
        $descCortaFrances = $trans->translate($source, $target2, $descCortaES);

        $descLargaIngles = $trans->translate($source, $target1, $descLargaES);
        $descLargaFrances = $trans->translate($source, $target2, $descLargaES);
        
        $descLargaFrances2= str_replace("'", "''", $descLargaFrances);
        $descCortaFrances2= str_replace("'", "''", $descCortaFrances);
        $descLargaIngles2= str_replace("'", "''", $descLargaIngles);
        $descCortaIngles2= str_replace("'", "''", $descCortaIngles);
        
       



        $idunicositio = 0;
        $aux = $_SESSION['idemp'] . uniqid();
        $a = str_split($aux);

        $i = 0;
        for ($i; $i < count($a); $i++) {
            $idunicositio += ord($a[$i]);
        }

        $idunicoRev = $idunicositio + 5;

        date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");


        $sqlinsert = ("INSERT INTO sitio (id_sitio, id_empresa, id_municipio , nombre, direccion, telefono1, telefono2, capacidad, horario) VALUES (" . $idunicositio . "," . $_SESSION['idemp'] . "," . $municipios . ",'" . $nombre . "', '" . $dir . "'," . $tel1 . "," . $tel2 . "," . $capacidad . ",'" . $hora . "')");
        $agregado = $this->db->query($sqlinsert);
        if ($agregado) {
            $sqlinsert2 = ("INSERT INTO revision_informacion (id_revision_informacion, id_sitio"
                    . ", fecha_creacion, status, url_sitio_web, id_imagen_perfil, id_carta, ubicacionGIS) VALUES"
                    . "(" . $idunicoRev . "," . $idunicositio . ",'" . $hoy . "','C','" . $url . "','" . $actual_image_name . ".jpg','" . $actual_carta_name . ".pdf'"
                    . "," . $point . ")");
            $revagregada = $this->db->query($sqlinsert2);
            if ($revagregada) {
                $sqlinsertES = ("INSERT INTO descripcion_idioma (id_revision_informacion, lang_code, descripcion_larga, descripcion_corta) VALUES"
                        . " (" . $idunicoRev . ", 'ES', '" . $descLargaES . "', '" . $descCortaES . "')");
                $agregadoEsp = $this->db->query($sqlinsertES);
                $sqlinsertEn = ("INSERT INTO descripcion_idioma (id_revision_informacion, lang_code, descripcion_larga, descripcion_corta) VALUES"
                        . " (" . $idunicoRev . ", 'EN', '" . $descLargaIngles2 . "', '" . $descCortaIngles2 . "')");
                $agregadoIng = $this->db->query($sqlinsertEn);
                $sqlinsertFr = ("INSERT INTO descripcion_idioma (id_revision_informacion, lang_code, descripcion_larga, descripcion_corta) VALUES"
                        . " (" . $idunicoRev . ", 'FR', '" . $descLargaFrances2 . "', '" . $descCortaFrances2 . "' )");
                $agregadoFr = $this->db->query($sqlinsertFr);
                if ($agregadoEsp && $agregadoIng && $agregadoFr) {
                    echo ("<script> alert('Nuevo Sitio agregado'); </script>");
                } else {
                    printf("Errormessage: %s\n", $this->db->error);
                }
            } else {
                printf("Errormessage: %s\n", $this->db->error);
            }
        } else {
            printf("Errormessage: %s\n", $this->db->error);
        }
    }

}
