<?php
require_once ('../vendor/autoload.php');

use \Statickidz\GoogleTranslate;

class setSitios_model{
    private $db;
    private $sitios;
     private $isitio;
 
    public function __construct(){
        $this->db=Conectar::con();
        $this->sitios=array();
        $this->sitiofinal=array();
        $this->isitio=array();
        $this->municipo = array();
    }
    public function get_sitios(){
        
        $selectSitios = ("SELECT S.id_municipio, S.id_sitio, S.nombre, S.direccion, S.horario, RI.url_sitio_web, RI.status , M.nombre, "
                . "S.telefono1, S.telefono2, S.capacidad, DATE(RI.fecha_creacion), DATE(RI.fecha_actualizacion), RI.id_imagen_perfil, "
                . "RI.id_carta, ST_X(RI.ubicacionGIS), ST_Y(RI.ubicacionGIS), RI.id_revision_informacion, M.id_municipio "
                . "FROM sitio S INNER JOIN revision_informacion RI ON S.id_sitio=RI.id_sitio INNER JOIN municipio M ON S.id_municipio=M.id_municipio WHERE RI.status='C' OR RI.status='P'");
        
        $ressit=$this->db->query($selectSitios);
        
       
     $a=0;
        while($filas=$ressit->fetch_row()){
            $this->sitios[]=$filas;
            $a++;
        }
       
        $this->sitiofinal= self::getdescripciones($this->sitios, $a);
        
        $ressit->close();
       // $this->db->close();
        
        return $this->sitiofinal;
 
    }
    
    public function getdescripciones($sitioaux, $a){
        
       for($i=0; $i<$a;$i++){
            $sqldesc="SELECT descripcion_corta, descripcion_larga FROM descripcion_idioma WHERE id_revision_informacion=".$sitioaux[$i][17]." ORDER BY lang_code";
            $ressitaux=$this->db->query($sqldesc);
            while($filass=$ressitaux->fetch_row()){
                
  
                array_push($sitioaux[$i], $filass[0]);
                 array_push($sitioaux[$i], $filass[1]);
                
        }
       }
       return $sitioaux;
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
         $idsitio=$_POST['idsitioo'];
         $idrev=$_POST['idrev'];
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
        $hora = $_POST['horario'];
        $descCortaES = $_POST['descripcion_cortaES'];
        $descLargaES = htmlspecialchars($_POST['descripcion_largaES']);
        
        $imageP=$_POST['idperfilaux'];
        $imageL=$_POST['idlogoaux'];
        $cartaC=$_POST['idcartaaux'];

        $pathperfil = "../Imagenes/Sitios/img/";
        $pathlogo = "../Imagenes/Sitios/logo/";
        $pathcarta = "../Imagenes/Sitios/carta/";
        $valid_formatsimg = array("jpg"); //extensiones permitidas para imagenes
        $valid_formatscarta = array("pdf"); //extensiones permitidas para cartas

        if($_FILES['idperfilSet']['error']===4){
       
        $actual_image_name=$imageP;
        
        }
        
        else{
            
             $id_perfil = $_FILES['idperfilSet']['name']; //input file name in this code is file1
        $fileInfoPerfil = pathinfo($id_perfil);
        $extPerfil = $fileInfoPerfil['extension'];
        
             if (in_array($extPerfil, $valid_formatsimg)) {

            $actual_image_name = 0;

            $aux = $id_perfil . uniqid();
            $a = str_split($aux);

            $i = 0;
            for ($i; $i < count($a); $i++) {
                $actual_image_name += ord($a[$i]);
            }
            $tmp1 = $_FILES['idperfilSet']['tmp_name'];

            if (move_uploaded_file($tmp1, $pathperfil . $actual_image_name . "." . $extPerfil)) {
                 $actual_image_name=$actual_image_name.'.'.$extPerfil;
            } else {
                echo "failed";
            }
        }
        }
        
        if($_FILES['idlogoSet']['error']===4){
                $actual_logo_name=$imageL;
        }else{
            
                    $id_logo = $_FILES['idlogoSet']['name'];
         $fileInfoLogo = pathinfo($id_logo);
        $extLogo = $fileInfoLogo['extension'];
        
        if (in_array($extLogo, $valid_formatsimg)) {

            $actual_logo_name = 0;

            $aux = $id_logo . uniqid();
            $a = str_split($aux);

            $i = 0;
            for ($i; $i < count($a); $i++) {
                $actual_logo_name += ord($a[$i]);
            }
            $tmp2 = $_FILES['idlogoSet']['tmp_name'];

            if (move_uploaded_file($tmp2, $pathlogo . $actual_logo_name . "." . $extLogo)) {
                $actual_logo_name=$actual_logo_name.'.'.$extLogo;
                
                
                
            } else {
                echo "failed Logo";
            }
        }
        }
        
         if($_FILES['idcartaSet']['error']===4){
                $actual_carta_name=$cartaC;
         }else{
            
               $id_carta = $_FILES['idcartaSet']['name'];
         $fileInfoCarta = pathinfo($id_carta);
         $extCarta = $fileInfoCarta['extension'];
         
         if (in_array($extCarta, $valid_formatscarta)) {

            $actual_carta_name = 0;

            $aux = $id_carta . uniqid();
            $a = str_split($aux);

            $i = 0;
            for ($i; $i < count($a); $i++) {
                $actual_carta_name += ord($a[$i]);
            }
            $tmp3 = $_FILES['idcartaSet']['tmp_name'];

            if (move_uploaded_file($tmp3, $pathcarta . $actual_carta_name . "." . $extCarta)) {
                $actual_carta_name=$actual_carta_name.'.'.$extCarta;
            } else {
                echo "failed carta";
            }
        }
        }
        
        //$size = $_FILES['id_perfil']['size'];

        
       
       

   

        

        





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


        $sqlinsert = ("UPDATE sitio SET id_municipio='".$municipios."', nombre='".$nombre."', direccion='".$dir."', telefono1=".$tel1
                .", telefono2=".$tel2.", capacidad=".$capacidad.", horario='".$hora."' WHERE id_sitio=".$idsitio." ");
        $agregado = $this->db->query($sqlinsert);
        
        //AQUI ME QUEDE !!! -----  descomentar EN CONTROLLER
        if ($agregado) {
            $sqlinsert2 = ("UPDATE revision_informacion SET status='C', url_sitio_web='".$url."', id_imagen_perfil='" . $actual_image_name . "', id_logo='" . $actual_logo_name . "'"
                    . ", id_carta='" . $actual_carta_name . "', ubicacionGIS=" . $point . " WHERE id_revision_informacion=".$idrev."");
            $revagregada = $this->db->query($sqlinsert2);
            if ($revagregada) {
                $sqlinsertES = ("UPDATE descripcion_idioma SET descripcion_larga='" . $descLargaES . "', descripcion_corta='" . $descCortaES . "'"
                        . "WHERE id_revision_informacion='".$idrev."' AND lang_code='ES'");
                $agregadoEsp = $this->db->query($sqlinsertES);
                $sqlinsertEn = ("UPDATE descripcion_idioma SET descripcion_larga='" . $descLargaIngles2 . "', descripcion_corta='" . $descCortaIngles2 . "'"
                        . "WHERE id_revision_informacion='".$idrev."' AND lang_code='EN'");
                $agregadoIng = $this->db->query($sqlinsertEn);
                $sqlinsertFr = ("UPDATE descripcion_idioma SET descripcion_larga='" . $descLargaFrances2 . "', descripcion_corta='" . $descCortaFrances2 . "'"
                        . "WHERE id_revision_informacion='".$idrev."' AND lang_code='FR'");
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
