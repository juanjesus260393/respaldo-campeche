<?php
class Emp_Activas_model{
    private $db;
    private $empresas;
 
    public function __construct(){
        $this->db=Conectar::con();
        $this->empresas=array();
    }
    public function get_empresas(){
        
        $sqlconsulta = ("SELECT id_empresa, E.nombre, descripcion_corta, S.nombre FROM empresa E JOIN sector S ON E.id_sector=S.id_sector WHERE 1");
        
        $resultado=$this->db->query($sqlconsulta);
        while($filas=$resultado->fetch_row()){
            $this->empresas[]=$filas;
            
        }
        
        $resultado->close();
        $this->db->close();
        
        return $this->empresas;
 
    }
}