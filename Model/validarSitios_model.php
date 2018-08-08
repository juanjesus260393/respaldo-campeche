<?php

class validarSitios_model{
    private $db;
    private $sitios;
     private $isitio;
 
    public function __construct(){
        $this->db=Conectar::con();
        $this->sitios=array();
        $this->isitio=array();
    }
    public function get_sitios(){
        
        $selectSitios = ("SELECT RI.id_logo, S.id_sitio, S.nombre, S.direccion, S.horario, RI.url_sitio_web, RI.status , M.nombre, "
                . "S.telefono1, S.telefono2, S.capacidad, DATE(RI.fecha_creacion), DATE(RI.fecha_actualizacion), RI.id_imagen_perfil, "
                . "RI.id_carta, RI.ubicacionGIS "
                . "FROM sitio S INNER JOIN revision_informacion RI ON S.id_sitio=RI.id_sitio INNER JOIN municipios M ON S.municipios_id=M.id WHERE RI.status='C' OR RI.status='P'");
        
        $ressit=$this->db->query($selectSitios);
        

       
        while($filas=$ressit->fetch_row()){
            $this->sitios[]=$filas;
            
        }
        
        $ressit->close();
       // $this->db->close();
        
        return $this->sitios;
 
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
    
    
 
    
    public function acepta_cupon($cupon, $revision) {
        
        if(isset($revision)){
        $sqlupdate=("UPDATE revision_objeto Ro INNER JOIN cupon C ON Ro.id_revision_objeto=C.id_revision_objeto SET Ro.status = 'A' WHERE C.id_cupon='".$cupon."'");
        $update=$this->db->query($sqlupdate); 
        if($update){

                 echo ("<script> alert('Cupon Aceptado'); location.href ='../Controller/validarCupon_controller.php';</script>");
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
    
     public function rechaza_cupon($cupon, $coment, $revision) {
        
        if(isset($revision)){
        $sqlupdate=("UPDATE revision_objeto Ro INNER JOIN cupon C ON Ro.id_revision_objeto=C.id_revision_objeto SET Ro.status = 'P' WHERE C.id_cupon='".$cupon."'");
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
