<?php

class validarSitios_model{
    private $db;
    private $sitios;
     private $isitio;
 
    public function __construct(){
        $this->db=Conectar::con();
        $this->sitios=array();
        $this->sitiofinal=array();
        $this->isitio=array();
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
        
        $this->sitiofinal= self::getGaleria($this->sitiofinal, $a);
        
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
    
    
 
    
    public function acepta_sitio($sitio, $revision, $coment) {
         date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
        
        if(isset($revision)){
        $sqlupdate=("UPDATE revision_informacion RI SET RI.status='A', fecha_actualizacion='".$hoy."' WHERE RI.id_revision_informacion='".$revision."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
            sendmailComentarioAS($_SESSION['username'], $coment, 'C');

                 echo ("<script> alert('Sitio Aceptado'); location.href ='../Controller/validarSitios_controller.php';</script>");
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
    
     public function rechaza_sitio($sitio, $coment, $revision) {
         date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
        
        if(isset($revision)){
       $sqlupdate=("UPDATE revision_informacion RI SET RI.status='P', fecha_actualizacion='".$hoy."' WHERE RI.id_revision_informacion='".$revision."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
            
            
            
            $sqlinsertcoment=("INSERT INTO comentario_rechazo"
                    . "(id_revision_informacion, comentario, fecha_publicacion) "
                    . "VALUES (".$revision.",'".$coment."','".$hoy."')");
            
            $insertcomnt=$this->db->query($sqlinsertcoment); 
        if($insertcomnt){
            sendmailComentario($_SESSION['username'], $coment, 'S');
        echo ("<script> alert('Cupon Rechazado'); location.href ='../Controller/validarSitios_controller.php';</script>");}
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
}
