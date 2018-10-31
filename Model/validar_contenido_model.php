<?php
class validar_contenido_model{
    
    private $db;
    public function __construct(){
        $this->db=Conectar::con();
   
    }
    public function get_num_cupones(){
        $selectCupon = ("SELECT C.id_cupon FROM cupon C INNER JOIN revision_objeto rO ON C.id_revision_objeto=rO.id_revision_objeto WHERE rO.status='C' OR rO.status='P' ");
        $res=$this->db->query($selectCupon);
        $cuponesPendientes=$res->num_rows;
        return $cuponesPendientes;
 }

 public function get_num_vacantes(){
        $selectVacante = ("SELECT C.id_vacante FROM vacante C INNER JOIN revision_objeto rO ON C.id_revision_objeto=rO.id_revision_objeto WHERE rO.status='C' OR rO.status='P' ");
        
        $res=$this->db->query($selectVacante);
        $vacantesPendientes=$res->num_rows;
        
        
        return $vacantesPendientes;
 
}

public function get_num_eventos(){
        $selectEvento = ("SELECT C.id_evento FROM evento C INNER JOIN revision_evento rO ON C.id_revision_evento=rO.id_revision_evento WHERE rO.status='C' OR rO.status='P' ");
        
        $res=$this->db->query($selectEvento);
        $eventosPendientes=$res->num_rows;
        
        
        return $eventosPendientes;
 
}


    public function get_num_sitios(){
        
        $selectsitio = ("SELECT S.id_sitio FROM sitio S INNER JOIN revision_informacion rI ON S.id_sitio=rI.id_sitio WHERE rI.status='C' OR rI.status='P' ");
        
        $res2=$this->db->query($selectsitio);
        $sitiosPendientes=$res2->num_rows;
        
        
        return $sitiosPendientes;
 
}

    public function get_num_videos(){
        
        $selectCupon = ("SELECT V.id_video FROM video V INNER JOIN revision_objeto rO ON V.id_revision_objeto=rO.id_revision_objeto WHERE rO.status='C' OR rO.status='P' ");
        
        $res=$this->db->query($selectCupon);
        $videosPendientes=$res->num_rows;
        
        
        return $videosPendientes;
 
}

 public function get_num_FoB(){        
        $selectCupon = ("SELECT A.id_ad FROM ad A INNER JOIN revision_objeto rO ON A.id_revision_objeto=rO.id_revision_objeto WHERE rO.status='C' OR rO.status='P' ");
        
        $res=$this->db->query($selectCupon);
        $FoBPendientes=$res->num_rows;
        
        
        return $FoBPendientes;
 
}
   
    }
    