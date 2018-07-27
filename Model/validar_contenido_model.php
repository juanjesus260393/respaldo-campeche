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
    public function get_num_sitios(){
        
        $selectsitio = ("SELECT S.id_sitio FROM sitio S INNER JOIN revision_informacion rI ON S.id_sitio=rI.id_sitio WHERE rI.status='C' OR rI.status='P' ");
        
        $res2=$this->db->query($selectsitio);
        $sitiosPendientes=$res2->num_rows;
        
        
        return $sitiosPendientes;
 
}
   
    }
    