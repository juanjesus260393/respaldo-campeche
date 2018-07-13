<?php

class add_Sitios_model{
    private $db;
    private $municipio;
    private  $pas;


    public function __construct(){
        $this->db=Conectar::con();
        $this->municipo=array();
        $this->id=array();
        
    }
    public function get_municipios(){
        
        $sqlconsulta = ("SELECT m.id, m.nombre FROM municipios m WHERE 1");
        
        $resultado=$this->db->query($sqlconsulta);
        while($filas=$resultado->fetch_row()){
            $this->municipio[]=$filas;
            
        }
        
        $resultado->close();
        //$this->db->close();
        
        return $this->municipio;
    }
    
  
    public function add_sitio() {  
          
        $nombre=$_POST['nombreSitio'];
        $municipios=(int)$_POST['municipios'];
        $tel1=(int)$_POST['tel1'];
        $tel2=(int)$_POST['tel2'];
        $dir= htmlspecialchars($_POST['dir']);
        $capacidad=(int)$_POST['tam'];
        
        $hora=("De  ".$_POST['horaAbre']."  a  ".$_POST['horaCierra']);
                
        
        $sqlinsert= ("INSERT INTO sitio (id_empresa, municipios_id , nombre, direccion, telefono1, telefono2, capacidad, horario) VALUES (".$_SESSION['idemp'].",".$municipios.",'".$nombre."', '".$dir."',".$tel1.",".$tel2.",".$capacidad.",'".$hora."')");
        $agregado=$this->db->query($sqlinsert);  
        if($agregado){
            
 
                echo ("<script> alert('Nuevo Sitio agregado'); </script>"); 
                
            }else{ printf("Errormessage: %s\n", $this->db->error);}
        
        
    }   
}