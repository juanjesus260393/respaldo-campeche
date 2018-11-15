<?php
/*
 *   Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 24-10-2018
 *   Versión: 1.0
 *   Descripcion: Modelo donde se encuentran todas las funciones necesarias
 *   para  Contar el numero de objetos e informacion pendientes por validar
 * 
 * por Fabrica de Software, CIC-IPN
 */

//Se declara la clase validar_contenido_model, donde estaran las funciones para contar cada uno de los diferentes objetos o sitios
class validar_contenido_model{
    
    private $db;
//Se declara el constructor de la clase    
    public function __construct(){
        $this->db=Conectar::con();
   
    }
//Se declara el metodo o función para contar los cupones
    public function get_num_cupones(){
        $selectCupon = ("SELECT C.id_cupon FROM cupon C INNER JOIN revision_objeto rO ON C.id_revision_objeto=rO.id_revision_objeto WHERE rO.status!='A' ");
        $res=$this->db->query($selectCupon);
        $cuponesPendientes=$res->num_rows;
        return $cuponesPendientes;
 }
//Se declara el metodo o función para contar las vacantes
 public function get_num_vacantes(){
        $selectVacante = ("SELECT C.id_vacante FROM vacante C INNER JOIN revision_objeto rO ON C.id_revision_objeto=rO.id_revision_objeto WHERE rO.status!='A'");
        
        $res=$this->db->query($selectVacante);
        $vacantesPendientes=$res->num_rows;
        
        
        return $vacantesPendientes;
 
}
//Se declara el metodo o función para contar los eventos
public function get_num_eventos(){
        $selectEvento = ("SELECT C.id_evento FROM evento C INNER JOIN revision_evento rO ON C.id_revision_evento=rO.id_revision_evento WHERE rO.status!='A'");
        
        $res=$this->db->query($selectEvento);
        $eventosPendientes=$res->num_rows;
        
        
        return $eventosPendientes;
 
}

//Se declara el metodo o función para contar los sitios
    public function get_num_sitios(){
        
        $selectsitio = ("SELECT S.id_sitio FROM sitio S INNER JOIN revision_informacion rI ON S.id_sitio=rI.id_sitio WHERE rI.status!='A'");
        
        $res2=$this->db->query($selectsitio);
        $sitiosPendientes=$res2->num_rows;
        
        
        return $sitiosPendientes;
 
}
//Se declara el metodo o función para contar los videos 
    public function get_num_videos(){
        
        $selectCupon = ("SELECT V.id_video FROM video V INNER JOIN revision_objeto rO ON V.id_revision_objeto=rO.id_revision_objeto WHERE rO.status!='A'");
        
        $res=$this->db->query($selectCupon);
        $videosPendientes=$res->num_rows;
        
        
        return $videosPendientes;
 
}
//Se declara el metodo o función para contar los Flyers y Banners
 public function get_num_FoB(){        
        $selectCupon = ("SELECT A.id_ad FROM ad A INNER JOIN revision_objeto rO ON A.id_revision_objeto=rO.id_revision_objeto WHERE rO.status!='A'");
        
        $res=$this->db->query($selectCupon);
        $FoBPendientes=$res->num_rows;
        
        
        return $FoBPendientes;
 
}
   
    }
    