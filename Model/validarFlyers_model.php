<?php
/*
 *   Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 24-10-2018
 *   Versión: 1.0
 *   Descripcion: Modelo donde se encuentran todas las funciones necesarias
 *   para  Validar un banner o flyer (aceptar o rechazar)
 * 
 * por Fabrica de Software, CIC-IPN
 */

//Se declara la clase validarFlyers_model, donde se aceptara o rechazara un Flyer o un Banner
class validarFlyers_model{
    private $db;
    private $flyers;

//Se declara el constructor de la clase 
    public function __construct(){
        $this->db=Conectar::con();
        $this->flyers=array();
        
    }
    //Se declara el metodo o función get FLyers, lo cual traera la lista de flyers o banners
    public function get_Flyers(){
        
        $selectFlyers = ("SELECT Ad.tipo, Ad.id_img, E.nombre, Ad.id_ad, rO.id_revision_objeto, rO.status FROM ad Ad INNER JOIN revision_objeto rO ON Ad.id_revision_objeto=rO.id_revision_objeto INNER JOIN empresa E ON rO.id_empresa=E.id_empresa WHERE rO.status='C' OR rO.status='R'" );
        
        $resFly=$this->db->query($selectFlyers);
       
        while($filas=$resFly->fetch_row()){
            $this->flyers[]=$filas; 
        }
        
        $resFly->close();
        //Devuelve la lista de flyers o banners encontrados en la base de datos
        return $this->flyers;
 
    }
//Se declara el metodo o función para aceptar Flyers o Banners
    
   public function acepta_FoB($FoB, $coment) {
         date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
        //Se actualiza el status en la base de datos de dicho Flyer o Banner
        if(isset($FoB)){
        $sqlupdate=("UPDATE revision_objeto Ro INNER JOIN ad C ON Ro.id_revision_objeto=C.id_revision_objeto SET Ro.status = 'A' , Ro.fecha_actualizacion='".$hoy."' WHERE C.id_ad='".$FoB."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
            //Se envia un correo al usuario para avisatle que su publicidad fue aceptada y un comentrio si este existiera
            sendmailAdd($_SESSION['username'], $coment, 'S');
                 echo ("<script> alert('Publicidad Aceptada'); location.href ='../Controller/validarFlyers_controller.php';</script>");
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
    // se declara el metodo o función para rechazar Flyers o Banners
     public function rechaza_FoB($FoB, $coment, $revision) {
        
        if(isset($FoB)){
            //Se actualiza el status en la base de datos de dicho Flyer o Banner
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
            //Se envia un correo al usuario para avisatle que su publicidad fue rechazada y un comentrio con el motivo si este existiera
            sendmailAdd($_SESSION['username'], $coment, 'C');
        echo ("<script> alert('Publicidad  Rechazada'); location.href ='../Controller/validarFlyers_controller.php';</script>");}
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
}
