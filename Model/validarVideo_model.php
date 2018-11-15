<?php
/*
 *   Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 24-10-2018
 *   Versión: 1.0
 *   Descripcion: Modelo donde se encuentran todas las funciones necesarias
 *   para  Validar Videos (aceptar y rechazar)
 * 
 * por Fabrica de Software, CIC-IPN
 */


//Se declara la clase validarvideo_model, donde se aceptara o rechazara un Video
class validarVideo_model{
    private $db;
    private $videos;
 
 //Se declara el constructor de la clase
    public function __construct(){
        $this->db=Conectar::con();
        $this->videos=array();
      
    }
//Se declara el metodo o función get_videos, donde se obtendra la lista de los videos registrados en la base de datos        
    public function get_videos(){
     //Sentencia Sql para obtener la informacion de los videos    
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
    
 
 //Se declara el metodo o función acepta_video, donde se acepta el video, se publica y se envia un correo para avisarle al usuario      
    public function acepta_video($video, $comentario, $nombre) {
         date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
        //Se actualiza el status del video en la base de datos
        if(isset($video)){
        $sqlupdate=("UPDATE revision_objeto Ro INNER JOIN video V ON Ro.id_revision_objeto=V.id_revision_objeto SET Ro.status = 'A' "
                . ", Ro.fecha_actualizacion='".$hoy."' WHERE V.id_video='".$video."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
//Se envia un correo avisando al usuario que su video fue aceptado y un comentario del motivo si existiera                        
                sendmailCVid($_SESSION['username'], $comentario, 'S', $nombre);
                 echo ("<script> alert('Video Aceptado'); location.href ='../Controller/validarVideo_controller.php';</script>");
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
   //Se declara el metodo o función rechaza_video, donde se rechaza el video y se mantiene sin ser publicado y se envia un correo para avisarle al usuario   
     public function rechaza_video($video, $comentario, $nombre, $revision) {
        date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
        
        if(isset($video)){
       $sqlupdate=("UPDATE revision_objeto Ro INNER JOIN video V ON Ro.id_revision_objeto=V.id_revision_objeto SET Ro.status = 'R' "
                . ", Ro.fecha_actualizacion='".$hoy."' WHERE V.id_video='".$video."'");

        $update=$this->db->query($sqlupdate); 
        if($update){
          //Se actualiza el status del video en la base de datos
            
            $sqlinsertcoment=("INSERT INTO comentario_rechazo_objeto"
                    . "(id_revision_objeto, comentario, fecha_creacion) "
                    . "VALUES (".$revision.",'".$comentario."','".$hoy."')");
            
            $insertcomnt=$this->db->query($sqlinsertcoment); 
        if($insertcomnt){
//Se envia un correo avisando al usuario que su video fue rechazado y un comentario del motivo si existiera                        
            sendmailCVid($_SESSION['username'], $comentario, 'C', $nombre);
        echo ("<script> alert('Video Rechazado'); location.href ='../Controller/validarVideo_controller.php';</script>");}
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
}
