<?php

class Nuevo_usu_model{
    private $db;
    private $sector;
    private $pas;


    public function __construct(){
        $this->db=Conectar::con();
        $this->sector=array();
        $this->id=array();
        $this->idmembresia =array();
        $this->rango=array();
        
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
    
    public function get_Rangos(){
        
        $sqlconsultaRangos = ("SELECT R.id_rango_ventas, R.descripcion FROM rango_ventas R WHERE 1");
        
        $resRangos=$this->db->query($sqlconsultaRangos);
        while($filaR=$resRangos->fetch_row()){
            $this->rango[]=$filaR;
            
        }
        
        $resRangos->close();
        //$this->db->close();
        
        return $this->rango;
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
        $precios=(int)$_POST['rangos'];
        $tel1=(int)$_POST['tel1'];
        $tel2=(int)$_POST['tel2'];
        $cel=(int)$_POST['cel'];
        $dir= htmlspecialchars($_POST['dir']);
        $owner=$_POST['propietario'];
        $numE=(int)$_POST['numempleados'];
        $facebook=$_POST['facebook'];
        $twitter=$_POST['twitter'];
        $instagram=$_POST['instagram'];
        $youtube=$_POST['youtube'];
        $google=$_POST['googleplus'];
        $desc= htmlspecialchars($_POST['desc']);
        $tamano=(int)$_POST['tam'];
        $membresia=$_POST['membresia'];
        
        $passaux= $this->gen_pass($email);
        sendmail($email, $passaux, 0);
        $pass=password_hash($passaux, PASSWORD_DEFAULT);
       // $pass=password_hash('empresa1', PASSWORD_DEFAULT);
      //$pass=$this->gen_pass($email);
         $sqlAuxMembresia = ("SELECT p.id_membresia FROM membresia p WHERE p.nombre='".$membresia."'");
           $Mres=$this->db->query($sqlAuxMembresia);
            $idmembresia = $Mres->fetch_row();
        $sqlinsert1=("INSERT INTO users (username, password) VALUES ('".$email."','".$pass."')");
        $agregado=$this->db->query($sqlinsert1);
        if($agregado){

        $sqlinsert= ("INSERT INTO empresa (id_membresia, id_sector, id_rango_ventas, descripcion, telefono, extension,celular, "
                . "direccion, nombre, numero_empleados, propietario, tamano, facebook, twitter, instagram, youtube, googleplus) "
                . "VALUES (".$idmembresia[0].",".$sector.",".$precios.",'".$desc."',".$tel1.",".$tel2.","
                .$cel.",'".$dir."','".$nombre."',".$numE.",'".$owner."',".$tamano.""
                . ",'".$facebook."','".$twitter."','".$instagram."','".$youtube."','".$google."')");


        $agregado=$this->db->query($sqlinsert);  
        if($agregado){
            
            $sqlconsultaAux = ("SELECT id_empresa FROM empresa WHERE nombre='".$nombre."' AND propietario='".$owner."'");
           $res=$this->db->query($sqlconsultaAux);
            $id=$res->fetch_row();

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
        if(isset($usu)){
        $sqlupdate=("UPDATE users SET enabled = '1' WHERE users.username = '".$usu."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
                 
                
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
    }
    
    
    
}