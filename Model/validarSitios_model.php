<?php
/*
 *   Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 24-10-2018
 *   Versión: 1.0
 *   Descripcion: Modelo donde se encuentran todas las funciones necesarias
 *   para  Validar Sitios (aceptar y rechazar)
 * 
 * por Fabrica de Software, CIC-IPN
 */


//Se declara la clase validarSitios_-model, donde se aceptara o rechazara un Sitio
class validarSitios_model{
    private $db;
    private $sitios;
     private $isitio;
 //Se declara el constructor de la clase
    public function __construct(){
        $this->db=Conectar::con();
        $this->sitios=array();
        $this->sitiofinal=array();
        $this->isitio=array();
    }
//Se declara el metodo o función get_sitios, donde se obtendra la lista de los sitios registrados en la base de datos    
    public function get_sitios(){
       //Sentencia Sql para obtener la informacion de los sitios 
        $selectSitios = ("SELECT S.id_municipio, S.id_sitio, S.nombre, S.direccion, S.horario, RI.url_sitio_web, RI.status , M.nombre, "
                . "S.telefono1, S.telefono2, S.capacidad, DATE(RI.fecha_creacion), DATE(RI.fecha_actualizacion), RI.id_imagen_perfil, "
                . "RI.id_carta, ST_X(RI.ubicacionGIS), ST_Y(RI.ubicacionGIS), RI.id_revision_informacion, M.id_municipio "
                . "FROM sitio S INNER JOIN revision_informacion RI ON S.id_sitio=RI.id_sitio INNER JOIN municipio M ON S.id_municipio=M.id_municipio WHERE RI.status='C' OR RI.status='R'");
        
        $ressit=$this->db->query($selectSitios);
        
       
     $a=0;
        while($filas=$ressit->fetch_row()){
            $this->sitios[]=$filas;
            $a++;
        }
       //Llama a la funcion para obtener las descripciones de los sitos
        $this->sitiofinal= self::getdescripciones($this->sitios, $a);
        
        $this->sitiofinal= self::getGaleria($this->sitiofinal, $a);
        
        $ressit->close();
       // $this->db->close();
        
        return $this->sitiofinal;
 
    }
//Se declara el metodo o función para obtener las descripciones de los sitos     
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
//Se declara el metodo o función para obneter las imagenes de galeria de los sitios
       public function getGaleria($sitioaux, $a){
       
       for($i=0; $i<$a;$i++){
            $x=0;
            $sqldesc="SELECT id_archivo_imagen FROM imagen_galeria WHERE id_revision_informacion=".$sitioaux[$i][17]." ";
            $ressitaux=$this->db->query($sqldesc);
            while($filass=$ressitaux->fetch_row()){
                
                array_push($sitioaux[$i], $filass[0].".jpg");
                $x++;
                
            } 
        while($x<6){
             array_push($sitioaux[$i], "sin.jpg");
             $x++;
            }
            
       }
      
       return $sitioaux;
    }
    
    
 
 //Se declara el metodo o función acepta_sitio, donde se aceptara un sitio para ser publicado  
    public function acepta_sitio($sitio, $revision, $coment) {
         date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
        //Se actualiza el status del sitio en la base de datos
        if(isset($revision)){
        $sqlupdate=("UPDATE revision_informacion RI SET RI.status='A', fecha_actualizacion='".$hoy."' WHERE RI.id_revision_informacion='".$revision."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
//Se envia un correo avisando al usuario que su sitio fue aceptado y un comentario del motivo si existiera            
            sendmailComentarioAS($_SESSION['username'], $coment, 'C');

                 echo ("<script> alert('Sitio Aceptado'); location.href ='../Controller/validarSitios_controller.php';</script>");
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
 //Se declara el metodo o función rechaza_sitio, donde se rechaza el sitio y se mantiene sin ser publicado y se envia un correo para avisarle al usuario   
     public function rechaza_sitio($sitio, $coment, $revision) {
         date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
//Se actualiza el status del sitio en la base de datos        
        if(isset($revision)){
       $sqlupdate=("UPDATE revision_informacion RI SET RI.status='R', fecha_actualizacion='".$hoy."' WHERE RI.id_revision_informacion='".$revision."'");
        $update=$this->db->query($sqlupdate); 
        if($update){          
            
            $sqlinsertcoment=("INSERT INTO comentario_rechazo "
                    . "(id_revision_informacion, comentario, fecha_publicacion) "
                    . "VALUES (".$revision.",'".$coment."','".$hoy."')");
            
            $insertcomnt=$this->db->query($sqlinsertcoment); 
        if($insertcomnt){
            //Se envia un correo avisando al usuario que su sitio fue rechazado y un comentario del motivo si existiera
            sendmailComentario($_SESSION['username'], $coment, 'S');
        echo ("<script> alert('Sitio Rechazado'); location.href ='../Controller/validarSitios_controller.php';</script>");}
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
}
