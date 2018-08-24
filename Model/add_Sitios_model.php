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
        $pathGaleria='../Imagenes/Galeria/';
        
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
        
        
        
        if($_FILES['file1']['error']===0){
   
    $fileInfofile1 = pathinfo($_FILES['file1']['name']);
    $extfile1 = $fileInfofile1['extension'];
    
    if (in_array($extfile1, $valid_formatsimg)) {
        
            $aux1= random_bytes(12);
            $actual_file1_name= substr(bin2hex( $aux1), 0, 12);
            
            $tmp1 = $_FILES['file1']['tmp_name'];
            if (move_uploaded_file($tmp1, $pathGaleria . $actual_file1_name . "." . $extfile1)) {
                $insertfile1 = ("INSERT INTO imagen_galeria (id_archivo_imagen, id_revision_informacion) VALUES ('" . $actual_file1_name . "'," .  $idunicoRev. ")");
                $agregado = $this->db->query($insertfile1);
                if($agregado){}
                else{printf("Errormessage: %s\n", $this->db->error);}
            } else {
                echo "failed file1";
            }
        }
}
        if($_FILES['file2']['error']===0){
   
    $fileInfofile2 = pathinfo($_FILES['file2']['name']);
    $extfile2 = $fileInfofile2['extension'];
    
    if (in_array($extfile2, $valid_formatsimg)) {
        
            $aux2= random_bytes(12);
            $actual_file2_name= substr(bin2hex( $aux2), 0, 12);
            
            $tmp2 = $_FILES['file2']['tmp_name'];
            if (move_uploaded_file($tmp2, $pathGaleria . $actual_file2_name . "." . $extfile2)) {
                $insertfile2 = ("INSERT INTO imagen_galeria (id_archivo_imagen, id_revision_informacion) VALUES ('" . $actual_file2_name . "'," .  $idunicoRev. ")");
                $agregado2 = $this->db->query($insertfile2);
                if($agregado2){}
                else{printf("Errormessage: %s\n", $this->db->error);}
            } else {
                echo "failed file1";
            }
        }
}

        if($_FILES['file3']['error']===0){
   
    $fileInfofile3 = pathinfo($_FILES['file3']['name']);
    $extfile3 = $fileInfofile3['extension'];
    
    if (in_array($extfile3, $valid_formatsimg)) {
        
            $aux3= random_bytes(12);
            $actual_file3_name= substr(bin2hex( $aux3), 0, 12);
            
            $tmp3 = $_FILES['file3']['tmp_name'];
            if (move_uploaded_file($tmp3, $pathGaleria . $actual_file3_name . "." . $extfile3)) {
                $insertfile3 = ("INSERT INTO imagen_galeria (id_archivo_imagen, id_revision_informacion) VALUES ('" . $actual_file3_name . "'," .  $idunicoRev. ")");
                $agregado3 = $this->db->query($insertfile3);
                if($agregado3){}
                else{printf("Errormessage: %s\n", $this->db->error);}
            } else {
                echo "failed file1";
            }
        }
}

        if($_FILES['file4']['error']===0){
   
    $fileInfofile4 = pathinfo($_FILES['file4']['name']);
    $extfile4 = $fileInfofile4['extension'];
    
    if (in_array($extfile4, $valid_formatsimg)) {
        
            $aux4= random_bytes(12);
            $actual_file4_name= substr(bin2hex( $aux4), 0, 12);
            
            $tmp4 = $_FILES['file4']['tmp_name'];
            if (move_uploaded_file($tmp4, $pathGaleria . $actual_file4_name . "." . $extfile4)) {
                $insertfile4= ("INSERT INTO imagen_galeria (id_archivo_imagen, id_revision_informacion) VALUES ('" . $actual_file4_name . "'," .  $idunicoRev. ")");
                $agregado4 = $this->db->query($insertfile4);
                if($agregado4){}
                else{printf("Errormessage: %s\n", $this->db->error);}
            } else {
                echo "failed file4";
            }
        }
}
        
         if($_FILES['file5']['error']===0){
   
    $fileInfofile5 = pathinfo($_FILES['file5']['name']);
    $extfile5 = $fileInfofile5['extension'];
    
    if (in_array($extfile5, $valid_formatsimg)) {
        
            $aux5= random_bytes(12);
            $actual_file5_name= substr(bin2hex( $aux5), 0, 12);
            
            $tmp5 = $_FILES['file5']['tmp_name'];
            if (move_uploaded_file($tmp5, $pathGaleria . $actual_file5_name . "." . $extfile5)) {
                $insertfile5 = ("INSERT INTO imagen_galeria (id_archivo_imagen, id_revision_informacion) VALUES ('" . $actual_file5_name . "'," .  $idunicoRev. ")");
                $agregado5 = $this->db->query($insertfile5);
                if($agregado5){}
                else{printf("Errormessage: %s\n", $this->db->error);}
            } else {
                echo "failed file1";
            }
        }
}
        
        
        
        
        
        
    }

}
