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
    
    public function add_usuario() {
        $email=$_POST['email'];
        $nombre=$_POST['empresa'];
        $sector=(int)$_POST['sector'];
        $tel1=(int)$_POST['tel1'];
        $tel2=(int)$_POST['tel2'];
        $dir= htmlspecialchars($_POST['dir']);
        $owner=$_POST['propietario'];
        $numE=(int)$_POST['numempleados'];
        $descC= htmlspecialchars($_POST['descC']);
        $descL= htmlspecialchars($_POST['descL']);
        
        
        $sqlinsert= ("INSERT INTO empresa('descripcion_larga', 'descripcion_corta', 'telefono1', 'telefono2', 'direccion', 'nombre', 'id_sector', 'numero_empleados', 'propietario') VALUES ('".$descL."','".$descC."',".$tel1.",".$tel2.",'".$dir."','".$nombre."',".$sector.",".$numE.",'".$owner."')");
        
        $resultado=$this->db->query($sqlinsert);
        if($resultado){
            
            echo ("<script>alert('Nuevo usuario agregado');</script>");  
        }
        
    }
}