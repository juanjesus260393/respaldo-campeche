<?php

class Nuevo_usu_model{
    private $db;
    private $sector;
 
    public function __construct(){
        $this->db=Conectar::con();
        $this->sector=array();
    }
    public function get_sectores(){
        
        $sqlconsulta = ("SELECT S.id_sector, S.nombre FROM sector S WHERE 1");
        
        $resultado=$this->db->query($sqlconsulta);
        while($filas=$resultado->fetch_row()){
            $this->sector[]=$filas;
            
        }
        
        $resultado->close();
        $this->db->close();
        
        return $this->sector;
 
    }
}