<?php
class set_usu_model1{
    private $db;
    private $empresas;
 
    public function __construct(){
        $this->db=Conectar::con();
        $this->empresas=array();
    }
    public function get_empresas(){
        
        $sqlconsulta = ("SELECT E.id_empresa, E.nombre, E.descripcion, S.nombre, U.username "
                . "FROM usuario_empresa EU INNER JOIN empresa E ON EU.id_empresa=E.id_empresa "
                . "INNER JOIN sector S ON E.id_sector=S.id_sector INNER JOIN users U ON EU.username=U.username WHERE 1 ");
        
        $resultado=$this->db->query($sqlconsulta);
        while($filas=$resultado->fetch_row()){
            $this->empresas[]=$filas;
            
        }
        
        $resultado->close();
       // $this->db->close();
        
        return $this->empresas;
 
    }
    
 
}