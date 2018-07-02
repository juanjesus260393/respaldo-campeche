<?php

class Nuevo_usu_model{
    private $db;
    private $sector;
    private  $pas;


    public function __construct(){
        $this->db=Conectar::con();
        $this->sector=array();
        $this->id=array();
        
    }
    public function get_sectores(){
        
        $sqlconsulta = ("SELECT S.id_sector, S.nombre FROM sector S WHERE 1");
        
        $resultado=$this->db->query($sqlconsulta);
        while($filas=$resultado->fetch_row()){
            $this->sector[]=$filas;
            
        }
        
        $resultado->close();
        //$this->db->close();
        
        return $this->sector;
    }
    
    

  public function gen_pass($correo){
      $cadena_base =  $correo;
      $cadena_base .= '0123456789' ;
     $cadena_base .= '@#%.@';
     
      $password = '';
      $limite = strlen($cadena_base) - 1;
     
      for ($i=0; $i < 8; $i++){
        $password .= $cadena_base[rand(0, $limite)];
      }
      return $password;
    }
    public function add_usuario() {  
          
         $email=$_POST['email'];
        $nombre=$_POST['empresa'];
        $sector=(int)$_POST['sectores'];
        $tel1=(int)$_POST['tel1'];
        $tel2=(int)$_POST['tel2'];
        $dir= htmlspecialchars($_POST['dir']);
        $owner=$_POST['propietario'];
        $numE=(int)$_POST['numempleados'];
        
        $desc= htmlspecialchars($_POST['desc']);
        $tamano=(int)$_POST['tam'];
        
        $venta=(int)$_POST['ventas'];
        $min=(int)$_POST['min'];
        $max=(int)$_POST['max'];
        $pass=$this->gen_pass($email);
         
        $sqlinsert1=("INSERT INTO users (username, password) VALUES ('".$email."','".$pass."')");
        $agregado=$this->db->query($sqlinsert1);
        if($agregado){
        $sqlinsert= ("INSERT INTO empresa (id_plan, id_sector , descripcion, telefono1, telefono2, direccion, nombre, numero_empleados, propietario, tamano, ventas_mensuales, monto_min, monto_max) VALUES (1,".$sector.",'".$desc."',".$tel1.",".$tel2.",'".$dir."','".$nombre."',".$numE.",'".$owner."',".$tamano.",".$venta.",".$min.",".$max.")");
        $agregado=$this->db->query($sqlinsert);  
        if($agregado){
            
            $sqlconsultaAux = ("SELECT id_empresa FROM empresa WHERE nombre='".$nombre."' AND propietario='".$owner."'");
           $res=$this->db->query($sqlconsultaAux);
            $id=$res->fetch_row();
            echo $id[0];
            $sqlinsertAux=("INSERT INTO usuario_empresa (id_empresa, username) VALUES (".$id[0].", '".$email."')");
            $agregadoAux=$this->db->query($sqlinsertAux);  
            if($agregadoAux){
                echo ("<script> alert('Nuevo usuario agregado'); </script>"); 
                
            }else{ printf("Errormessage: %s\n", $this->db->error);}
             
            
        }else{ printf("Errormessage: %s\n", $this->db->error);
        
        } }else{printf("Errormessage: %s\n", $this->db->error);}
        
        return $email;
    }
    
    
    public function habilitando($usu) {
        $sqlupdate=("UPDATE users SET enabled = '1' WHERE users.username = '".$usu."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
                 
                
            }else{ printf("Errormessage: %s\n", $this->db->error);}
    }
    
    
    
}