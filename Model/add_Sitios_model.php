<?php
/*
 *   Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 24-10-2018
 *   Versión: 1.0
 *   Descripcion: Modelo donde se encuentran todas las funciones necesarias
 *   para  mostrar las empresas activas
 * 
 * por Fabrica de Software, CIC-IPN
 */

//Se llama la libreria getID para validar la resolucion de las imagenes
include_once('../Librerias/getID3-1.9.15/getid3/getid3.php');
require_once ('../vendor/autoload.php');
//Se llama a la API de google para hacer la traduccion de las descripciones
use \Statickidz\GoogleTranslate;
//Se declara  la clase add_Sitios_model
class add_Sitios_model {
//Se declaran las variables privadas necesarias
    private $db;
    private $municipio;
    private $pas;
//Se declara el constructor de a al clase
    public function __construct() {
        $this->db = Conectar::con();
        $this->municipo = array();
        $this->id = array();
    }
//se declara el metodo o funcion para obtener los municipios de la base de datos
    public function get_municipios() {
//Sentencia Sql para obtener los municipios
        $sqlconsulta = ("SELECT m.id_municipio, m.nombre FROM municipio m WHERE 1");

        $resultado = $this->db->query($sqlconsulta);
        while ($filas = $resultado->fetch_row()) {
            $this->municipio[] = $filas;
        }

        $resultado->close();
        //$this->db->close();
//Devuelve el resultado
        return $this->municipio;
    }
//Se delcara el metodo o función para agregar un Sitio a la BD
    
    public function add_sitio() {

        
        //se declaran las rutas y formatos donde se almacenaran las imagenes de perfil, carta, etc.
        
         $pathperfil = "../Imagenes/Sitios/img/";
        $pathGaleria='../Imagenes/Galeria/';
        
        $pathcarta = "../Imagenes/Sitios/carta/";
        $valid_formatsimg = array("jpg"); //extensiones permitidas para imagenes
        $valid_formatscarta = array("pdf"); //extensiones permitidas para cartas


        $id_perfil = $_FILES['idperfil']['name']; //input file name in this code is file1
        
        $id_carta = $_FILES['idcarta']['name'];

        //$size = $_FILES['id_perfil']['size'];

        
        
       //Se manejan las imagenes y se valida su resolucion y tamaño 

if($_FILES['idperfil']['error']===0){
    
    $fileInfoPerfil = pathinfo($id_perfil);
        $extPerfil = $fileInfoPerfil['extension'];
        
        if (in_array($extPerfil, $valid_formatsimg)) {
            
            $auxp= random_bytes(12);

            $actual_image_name = substr(bin2hex( $auxp), 0, 12);

           
            $tmp1 = $_FILES['idperfil']['tmp_name'];

            if (move_uploaded_file($tmp1, $pathperfil . $actual_image_name . "." . $extPerfil)) {
                $filename = "C:/xampp/htdocs/campeche-web2/Imagenes/Sitios/img/".$actual_image_name."." . $extPerfil;
            
                $getID3 = new getID3;
            $file = $getID3->analyze($filename);
            //Una ves que se yha subido se comprueba la resolucion del mismo
            if ($file['video']['resolution_x'] > 1281 && $file['video']['resolution_y'] > 401) {
                //Si la resolucion no es la indicada se elimina el video que se acaba de subir al servidor, y se regresa a la pagina anterior
                
                unlink($filename);
                echo '<script language = javascript> alert("El tamaño de la imagen no es el indicado seleciona otra o reduce su tamaño 1280x400") </script>';
                //Regresamos a la pagina anterior
                echo "<html><head></head>" .
                "<body onload=\"javascript:history.back()\">" .
                "</body></html>";
                exit;
            }
            } else {
                echo "failed";
            }
        }}
        
        //Se declaran y reciben todos los valores del formulario 
        
        $nombre = addslashes($_POST['nombreSitio']);
        $municipios = (int) $_POST['municipios'];
         if (isset($_POST['urlsitio'])) {
            $url =  $_POST['urlsitio'];
        } else {
            $url = "";
        }
        $tel1 = (int) $_POST['tel1'];
       
         if (isset($_POST['tel2'])) {
            $tel2 = (int) $_POST['tel2'];
        } else {
            $tel2 = "";
        }
        $dir = htmlspecialchars($_POST['dir']);
        if (isset($_POST['tam'])) {
            $capacidad = (int) $_POST['tam'];
        } else {
            $capacidad = "";
        }
        $posx = $_POST['cordx'];
        $posy = $_POST['cordy'];
        $point = "PointFromText('POINT(" . $posx . " " . $posy . ")')";
        $hora = ("De  " . $_POST['horaAbre'] . "  a  " . $_POST['horaCierra']);
        $descCortaES = $_POST['descripcion_corta'];
        $descLargaES = htmlspecialchars($_POST['descripcion_larga']);

       //Manejo de la carta
if($_FILES['idcarta']['error']===0){
      $fileInfoCarta = pathinfo($id_carta);
        $extCarta = $fileInfoCarta['extension'];

        if (in_array($extCarta, $valid_formatscarta)) {
            
             $auxc= random_bytes(12);

            $actual_carta_name=substr(bin2hex( $auxc), 0, 12);
            
            $tmp3 = $_FILES['idcarta']['tmp_name'];

            if (move_uploaded_file($tmp3, $pathcarta . $actual_carta_name . "." . $extCarta)) {
                
            } else {
               
                echo "failed carta";
            }
}}else{
     $actual_carta_name='';
}





        $source = 'ES';
        $target1 = 'EN';
        $target2 = 'FR';


        $trans = new GoogleTranslate();
        $descCortaIngles2 = addslashes($trans->translate($source, $target1, $descCortaES));
        $descCortaFrances2 = addslashes($trans->translate($source, $target2, $descCortaES));

        $descLargaIngles2 =addslashes( $trans->translate($source, $target1, $descLargaES));
        $descLargaFrances2 =addslashes( $trans->translate($source, $target2, $descLargaES));
        
        /*$descLargaFrances2= str_replace("'", "''", $descLargaFrances);
        $descCortaFrances2= str_replace("'", "''", $descCortaFrances);
        $descLargaIngles2= str_replace("'", "''", $descLargaIngles);
        $descCortaIngles2= str_replace("'", "''", $descCortaIngles);*/
        
       



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

//Se agrega la informacion del sitio a la base de datos
        
        $sqlinsert = ("INSERT INTO sitio (id_sitio, id_empresa, id_municipio , nombre, direccion, telefono1, telefono2, capacidad, horario) VALUES (" . $idunicositio . "," . $_SESSION['idemp'] . "," . $municipios . ",'" . $nombre . "', '" . $dir . "'," . $tel1 . "," . $tel2 . "," . $capacidad . ",'" . $hora . "')");
        $agregado = $this->db->query($sqlinsert);
        if ($agregado) {
            $sqlinsert2 = ("INSERT INTO revision_informacion (id_revision_informacion, id_sitio"
                    . ", fecha_creacion, status, url_sitio_web, id_imagen_perfil, id_carta, ubicacionGIS) VALUES"
                    . "(" . $idunicoRev . "," . $idunicositio . ",'" . $hoy . "','C','" . $url . "','" . $actual_image_name . "','" . $actual_carta_name . "'"
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
        
      //Se manejan todas las imagenes de la galeria  
        
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
