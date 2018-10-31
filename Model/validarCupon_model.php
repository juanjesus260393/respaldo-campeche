<?php

class validarCupon_model{
    private $db;
    private $cupones;
     private $icupon;
 
    public function __construct(){
        $this->db=Conectar::con();
        $this->cupones=array();
        $this->icupon=array();
    }
    public function get_cupones(){
        
        $selectCupones = ("SELECT C.id_cupon, C.id_revision_objeto, C.titulo, C.descripcion_corta, C.descripcion_larga, "
                . "C.id_imagen_vista_previa, C.id_imagen_extra, DATE(C.vigencia_inicio), DATE(C.vigencia_fin), "
                . "C.terminos_y_condiciones, C.limite_codigos , rO.status FROM cupon C "
                . "INNER JOIN revision_objeto rO ON C.id_revision_objeto=rO.id_revision_objeto WHERE rO.status='C' OR rO.status='R'");
        
        $rescup=$this->db->query($selectCupones);
        

       
        while($filas=$rescup->fetch_row()){
            $this->cupones[]=$filas;
            
        }
        
        $rescup->close();
       // $this->db->close();
        
        return $this->cupones;
 
    }
    
        public function get_info($idcup){
            
            
        $infoCupon = ("SELECT C.id_cupon, C.id_revision_objeto, C.titulo, C.descripcion_corta, C.descripcion_larga, "
                . "C.id_imagen_vista_previa, C.id_imagen_extra, DATE(C.vigencia_inicio), DATE(C.vigencia_fin), "
                . "C.terminos_y_condiciones, C.limite_codigos FROM cupon C "
                . "WHERE C.id_cupon=".$idcup."");
        
        $irescup=$this->db->query($infoCupon);
        

       
        while($filas2=$irescup->fetch_row()){
            $this->icupon[]=$filas2;
            
        }
        
        $irescup->close();
       // $this->db->close();
        
        return $this->icupon;
 
    }
    
    
 
    
    public function acepta_cupon($cupon, $revision, $comenta) {
         date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
        
        if(isset($revision)){
        $sqlupdate=("UPDATE revision_objeto Ro INNER JOIN cupon C ON Ro.id_revision_objeto=C.id_revision_objeto SET Ro.status = 'A' , Ro.fecha_actualizacion='".$hoy."' WHERE C.id_cupon='".$cupon."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
 sendmailComentario($_SESSION['username'], $comenta, 'S');
                 echo ("<script> alert('Cupon Aceptado'); location.href ='../Controller/validarCupon_controller.php';</script>");
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
    
     public function rechaza_cupon($cupon, $coment, $revision) {
        
        if(isset($revision)){
        $sqlupdate=("UPDATE revision_objeto Ro INNER JOIN cupon C ON Ro.id_revision_objeto=C.id_revision_objeto SET Ro.status = 'R' WHERE C.id_cupon='".$cupon."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
            
            date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
            
            $sqlinsertcoment=("INSERT INTO comentario_rechazo_objeto"
                    . "(id_revision_objeto, comentario, fecha_creacion) "
                    . "VALUES (".$revision.",'".$coment."','".$hoy."')");
            
            $insertcomnt=$this->db->query($sqlinsertcoment); 
            
        if($insertcomnt){
            
            sendmailComentario($_SESSION['username'], $coment, 'C');
        echo ("<script> alert('Cupon Rechazado'); location.href ='../Controller/validarCupon_controller.php';</script>");}
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
}
