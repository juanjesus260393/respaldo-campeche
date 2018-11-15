<?php
/*
 *   Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 24-10-2018
 *   Versión: 1.0
 *   Descripcion: Modelo donde se encuentran todas las funciones necesarias
 *   para  Validar un cupon (aceptar o rechazar)
 * 
 * por Fabrica de Software, CIC-IPN
 */

//Se declara la clase validarCupon_model, donde se aceptara o rechazara un cupon
class validarCupon_model{
    private $db;
    private $cupones;
     private $icupon;
 //Se declara el constructor de la clase
    public function __construct(){
        $this->db=Conectar::con();
        $this->cupones=array();
        $this->icupon=array();
    }
    //Se declara el metodo o función get_cupones, donde se obtiene toda la informacion de los cupones de la base de datos
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
      //Devuelve la informacion encontrada en la base de Datos
        return $this->cupones;
 
    }
 //Se declara el metodo o función get_info, donde se obtiene la informacion del cupon seleccionado    
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
        //Devulve la informacion del cupon
        return $this->icupon;
 
    }
    
    
 
 //Se declara el metodo o función acepta_cupon, donde se acepta el cupon para se publicado y se envia un correo para avisarle al usuario   
    public function acepta_cupon($cupon, $revision, $comenta) {
         date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");
        //Se actualiza el status del cupon en la base de datos
        if(isset($revision)){
        $sqlupdate=("UPDATE revision_objeto Ro INNER JOIN cupon C ON Ro.id_revision_objeto=C.id_revision_objeto SET Ro.status = 'A' , Ro.fecha_actualizacion='".$hoy."' WHERE C.id_cupon='".$cupon."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
            //Se envia un correo avisando al usuario que su cupon fue aceptado y un comentario si existiera
 sendmailComentario($_SESSION['username'], $comenta, 'S');
                 echo ("<script> alert('Cupon Aceptado'); location.href ='../Controller/validarCupon_controller.php';</script>");
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
//Se declara el metodo o función rechaza_cupon, donde se rechaza el cupon y se mantiene sin ser publicado y se envia un correo para avisarle al usuario 
     public function rechaza_cupon($cupon, $coment, $revision) {
        //Se actualiza el status del cupon en la base de datos
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
                        //Se envia un correo avisando al usuario que su cupon fue rechazado y un comentario del motivo si existiera

            sendmailComentario($_SESSION['username'], $coment, 'C');
        echo ("<script> alert('Cupon Rechazado'); location.href ='../Controller/validarCupon_controller.php';</script>");}
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
}
