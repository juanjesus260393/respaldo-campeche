<?php

class validarVacante_model{
    private $db;
    private $vacantes;
    private $ivacante;
 
    public function __construct(){
        $this->db=Conectar::con();
        $this->vacantes=array();
        $this->ivacante=array();
    }
    public function get_vacantes(){
        
        $selectVacantes = ("SELECT C.id_vacante, C.id_revision_objeto, C.nombre, C.habilidades, C.descripcion, DATE(C.fecha_creacion), C.salario, C.horario, C.escolaridad, "
                . "rO.status, C.experiencia FROM vacante C "
                . "INNER JOIN revision_objeto rO ON C.id_revision_objeto=rO.id_revision_objeto WHERE rO.status='C' OR rO.status='P' ");
        
        $resvac=$this->db->query($selectVacantes);
        
            while($filas=$resvac->fetch_row()){
            $this->vacantes[]=$filas;
            
        }
        
        $resvac->close();
       // $this->db->close();
        
        return $this->vacantes;
 
    }
    
        public function get_info($idvac){
            
            
        $infoVacante = ("SELECT C.id_vacante, C.id_revision_objeto, C.nombre, C.habilidades, C.descripcion, DATE(C.fecha), C.salario, C.horario, C.escolaridad "
                . "FROM vacante C "
                . "WHERE C.id_vacante=".$idvac."");
        
        $iresvac=$this->db->query($infoVacante);
        

       
        while($filas2=$iresvac->fetch_row()){
            $this->ivacante[]=$filas2;
            
        }
        
        $iresvac->close();
       // $this->db->close();
        
        return $this->ivacante;
 
    }
    
    
 
    
    public function acepta_vacante($vacante, $revision) {
         date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
        
        if(isset($revision)){
        $sqlupdate=("UPDATE revision_objeto Ro INNER JOIN vacante C ON Ro.id_revision_objeto=C.id_revision_objeto SET Ro.status = 'A' , Ro.fecha_actualizacion='".$hoy."' WHERE C.id_vacante='".$vacante."'");
        $update=$this->db->query($sqlupdate); 
        if($update){

                 echo ("<script> alert('Vacante Aceptada'); location.href ='../Controller/validarVacante_controller.php';</script>");
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
    
     public function rechaza_vacante($vacante, $coment, $revision) {
        
        if(isset($revision)){
        $sqlupdate=("UPDATE revision_objeto Ro INNER JOIN vacante C ON Ro.id_revision_objeto=C.id_revision_objeto SET Ro.status = 'R' WHERE C.id_vacante='".$vacante."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
            
            date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
        $idcom=0;  
        $sql = ("select max(id_comentario_rechazo) from comentario_rechazo_objeto");
        $resu = $this->db->query($sql);

        $id_sig = $resu->fetch_row();
        if (is_null($id_sig[0])) {
            $idcom = 1;
        } else {
            $idcom = $id_sig[0] + 1;
        }
             
        
        
            $sqlinsertcoment=("INSERT INTO comentario_rechazo_objeto"
                    . "(id_comentario_rechazo,id_revision_objeto, comentario, fecha_creacion) "
                    . "VALUES (".$idcom . "," . $revision.",'".$coment."','".$hoy."')");
            
            $insertcomnt=$this->db->query($sqlinsertcoment); 
            
        if($insertcomnt){
            
            
        echo ("<script> alert('Vacante Rechazada'); location.href ='../Controller/validarVacante_controller.php';</script>");
        sendmailComentario($_SESSION['username'], $coment, 'C');
        
        }
        
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
}
