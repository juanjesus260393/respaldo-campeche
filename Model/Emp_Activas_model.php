<?php
class Emp_Activas_model{
    private $db;
    private $empresas;
 
    public function __construct(){
        $this->db=Conectar::con();
        $this->empresas=array();
    }
    public function get_empresas(){
        
        $sqlconsulta = ("SELECT E.id_empresa, E.nombre, E.descripcion, S.nombre, U.username , E.id_membresia "
                . "FROM usuario_empresa EU INNER JOIN empresa E ON EU.id_empresa=E.id_empresa "
                . "INNER JOIN sector S ON E.id_sector=S.id_sector INNER JOIN users U ON EU.username=U.username WHERE U.enabled=1 ");
        
        $resultado=$this->db->query($sqlconsulta);
        while($filas=$resultado->fetch_row()){
            $this->empresas[]=$filas;
            
        }
        
        $resultado->close();
       // $this->db->close();
        
        return $this->empresas;
 
    }
    
    public function disabled_emp($user_off) {
        
        if(isset($user_off)){
        $sqlupdate=("UPDATE users SET enabled = NULL WHERE users.username = '".$user_off."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
                 //location.href ='../Controller/Emp_Activas_controller';
                 
                 //header("Location:../Controller/Emp_Activas_controller.php");
                 echo ("<script> alert('Usuario Deshabilitado'); location.href ='../Controller/Emp_Activas_controller.php';</script>");
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
        
    }
}