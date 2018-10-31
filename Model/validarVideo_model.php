<?php

class validarVideo_model{
    private $db;
    private $videos;
 
 
    public function __construct(){
        $this->db=Conectar::con();
        $this->videos=array();
      
    }
    public function get_videos(){
        
        $selectvideos = ("SELECT V.id_video, V.titulo, V.descripcion, V.fecha_subida, V.id_img_preview, V.id_video_archivo, 
            rO.id_empresa, rO.fecha_creacion, rO.fecha_actualizacion, rO.status , rO.id_revision_objeto FROM video V 
            INNER JOIN revision_objeto rO ON V.id_revision_objeto=rO.id_revision_objeto WHERE rO.status='C' OR rO.status='R'");
        
        $rescup=$this->db->query($selectvideos);
        

       
        while($filas=$rescup->fetch_row()){
            $this->videos[]=$filas;
            
        }
        
        $rescup->close();
       // $this->db->close();
        
        return $this->videos;
 
    }
    
 
    
    public function acepta_video($video, $comentario, $nombre) {
         date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
        
        if(isset($video)){
        $sqlupdate=("UPDATE revision_objeto Ro INNER JOIN video V ON Ro.id_revision_objeto=V.id_revision_objeto SET Ro.status = 'A' "
                . ", Ro.fecha_actualizacion='".$hoy."' WHERE V.id_video='".$video."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
                sendmailCVid($_SESSION['username'], $comentario, 'S', $nombre);
                 echo ("<script> alert('Video Aceptado'); location.href ='../Controller/validarVideo_controller.php';</script>");
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
    
     public function rechaza_video($video, $comentario, $nombre, $revision) {
        date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
        
        if(isset($video)){
       $sqlupdate=("UPDATE revision_objeto Ro INNER JOIN video V ON Ro.id_revision_objeto=V.id_revision_objeto SET Ro.status = 'R' "
                . ", Ro.fecha_actualizacion='".$hoy."' WHERE V.id_video='".$video."'");

        $update=$this->db->query($sqlupdate); 
        if($update){
          
            
            $sqlinsertcoment=("INSERT INTO comentario_rechazo_objeto"
                    . "(id_revision_objeto, comentario, fecha_creacion) "
                    . "VALUES (".$revision.",'".$comentario."','".$hoy."')");
            
            $insertcomnt=$this->db->query($sqlinsertcoment); 
        if($insertcomnt){
            sendmailCVid($_SESSION['username'], $comentario, 'C', $nombre);
        echo ("<script> alert('Video Rechazado'); location.href ='../Controller/validarVideo_controller.php';</script>");}
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
}
