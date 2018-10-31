<?php

class validarFlyers_model{
    private $db;
    private $flyers;

 
    public function __construct(){
        $this->db=Conectar::con();
        $this->flyers=array();
        
    }
    public function get_Flyers(){
        
        $selectFlyers = ("SELECT Ad.tipo, Ad.id_img, E.nombre, Ad.id_ad, rO.id_revision_objeto, rO.status FROM ad Ad INNER JOIN revision_objeto rO ON Ad.id_revision_objeto=rO.id_revision_objeto INNER JOIN empresa E ON rO.id_empresa=E.id_empresa WHERE rO.status='C' OR rO.status='R'" );
        
        $resFly=$this->db->query($selectFlyers);
       
        while($filas=$resFly->fetch_row()){
            $this->flyers[]=$filas; 
        }
        
        $resFly->close();
       // $this->db->close();
        
        return $this->flyers;
 
    }
    
   public function acepta_FoB($FoB, $coment) {
         date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
        
        if(isset($FoB)){
        $sqlupdate=("UPDATE revision_objeto Ro INNER JOIN ad C ON Ro.id_revision_objeto=C.id_revision_objeto SET Ro.status = 'A' , Ro.fecha_actualizacion='".$hoy."' WHERE C.id_ad='".$FoB."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
            sendmailAdd($_SESSION['username'], $coment, 'S');
                 echo ("<script> alert('Publicidad Aceptada'); location.href ='../Controller/validarFlyers_controller.php';</script>");
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
    
     public function rechaza_FoB($FoB, $coment, $revision) {
        
        if(isset($FoB)){
        $sqlupdate=("UPDATE revision_objeto Ro INNER JOIN ad C ON Ro.id_revision_objeto=C.id_revision_objeto SET Ro.status = 'R' WHERE C.id_ad='".$FoB."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
            
            date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
            
            $sqlinsertcoment=("INSERT INTO comentario_rechazo_objeto"
                    . "(id_revision_objeto, comentario, fecha_creacion) "
                    . "VALUES (".$revision.",'".$coment."','".$hoy."')");
            
            $insertcomnt=$this->db->query($sqlinsertcoment); 
        if($insertcomnt){
            sendmailAdd($_SESSION['username'], $coment, 'C');
        echo ("<script> alert('Publicidad  Rechazada'); location.href ='../Controller/validarFlyers_controller.php';</script>");}
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
}
