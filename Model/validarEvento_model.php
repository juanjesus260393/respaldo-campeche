<?php

class validarEvento_model{
    private $db;
    private $eventos;
    private $ievento;
 
    public function __construct(){
        $this->db=Conectar::con();
        $this->eventos=array();
        $this->ievento=array();
    }
    
    
    
    
    
     public function get_eventos() {

        $selectEventos = ("SELECT e.id_evento, e.id_evento_categoria, e.nombre, e.descripcion, e.fecha, e.lugar, e.costo, e.beneficiario, e.imagen, ST_X(e.ubicacion), ST_Y(e.ubicacion), e.id_revision_evento, c.nombre, r.id_sitio, s.nombre, r.status "
                . " from evento e, evento_categoria c, revision_evento r, sitio s where e.id_revision_evento=r.id_revision_evento and e.id_evento_categoria=c.id_evento_categoria and s.id_sitio =r.id_sitio and (r.status='C' OR r.status='P')");
        
       $reseven=$this->db->query($selectEventos);
        
            while($filas=$reseven->fetch_row()){
            $this->eventos[]=$filas;
            
        }
        
        $reseven->close();
               
        return $this->eventos;
     }
           
    
    
    
    
    
    
        public function get_info($idvac){
            
            
        $infoEvento = ("SELECT C.id_evento, C.id_revision_evento, C.nombre, C.lugar, C.descripcion, DATE(C.fecha), C.costo, C.beneficiario"
                . "FROM evento C "
                . "WHERE C.id_evento=".$idvac."");
        
        $ireseven=$this->db->query($infoEvento);
        

       
        while($filas2=$iresvac->fetch_row()){
            $this->ievento[]=$filas2;
            
        }
        
        $iresvac->close();
       // $this->db->close();
        
        return $this->ievento;
 
    }
    
    
 
    
    public function acepta_evento($evento, $revision) {
         date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
        
        if(isset($revision)){
        $sqlupdate=("UPDATE revision_evento Ro INNER JOIN evento C ON Ro.id_revision_evento=C.id_revision_evento SET Ro.status = 'A' , Ro.fecha_actualizacion='".$hoy."' WHERE C.id_evento='".$evento."'");
        $update=$this->db->query($sqlupdate); 
        if($update){

         echo ("<script> alert('Evento Aceptado'); location.href ='../Controller/validarEvento_controller.php';</script>");
         sendmailComentario($_SESSION['username'], $coment, 'C');
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
    
     public function rechaza_evento($evento, $coment, $revision) {
        
        if(isset($revision)){
        $sqlupdate=("UPDATE revision_evento Ro INNER JOIN evento C ON Ro.id_revision_evento=C.id_revision_evento SET Ro.status = 'R' WHERE C.id_evento='".$evento."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
            
            date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
            
            $sqlinsertcoment=("INSERT INTO comentario_rechazo_evento "
                    . "(id_revision_evento, comentario, fecha_creacion) "
                    . "VALUES (".$revision.",'".$coment."','".$hoy."')");
            
            $insertcomnt=$this->db->query($sqlinsertcoment); 
            
        if($insertcomnt){
            
            
        echo ("<script> alert('Evento Rechazado'); location.href ='../Controller/validarEvento_controller.php';</script>");
        sendmailComentario($_SESSION['username'], $coment, 'C');
        }
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
}
