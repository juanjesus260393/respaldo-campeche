<?php

class set_usu_model2{
    private $db;
    private $sector;
    private  $pas;
private $empresas;

    public function __construct(){
        $this->db=Conectar::con();
        $this->sector=array();
        $this->id=array();
        $this->empresas=array();
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
    public function add_usuario($idEU, $usubfset) {  
          
         $email=$_POST['email'];
        $nombre=$_POST['empresa'];
        $sector=(int)$_POST['sectores'];
        $tel1=(int)$_POST['tel1'];
        $tel2=(int)$_POST['tel2'];
        $cel=(int)$_POST['cel'];
        $dir= htmlspecialchars($_POST['dir']);
        $owner=$_POST['propietario'];
        $numE=(int)$_POST['numempleados'];
        $precios=(int)$_POST['rangos'];
        $desc= htmlspecialchars($_POST['desc']);
        $tamano=(int)$_POST['tam'];
         $membresia=$_POST['membresia'];
        $facebook=$_POST['facebook'];
        $twitter=$_POST['twitter'];
        $instagram=$_POST['instagram'];
        $youtube=$_POST['youtube'];
        $google=$_POST['googleplus'];
          $sqlAuxMembresia = ("SELECT m.id_membresia FROM membresia m WHERE m.nombre='".$membresia."'");
           $Mres=$this->db->query($sqlAuxMembresia);
            $idmembresia=$Mres->fetch_row();
        
        if($usubfset==$email){ 
            $agregado=1;
        } else {
           $sqlinsert1=("UPDATE users SET username='".$email."' WHERE username='".$usubfset."'");
        $agregado=$this->db->query($sqlinsert1);
        }
        if($agregado){
        $sqlinsert= ("UPDATE empresa SET id_membresia=".$idmembresia[0].", id_sector=".$sector.", id_rango_ventas=".$precios
                . ", descripcion='".$desc."', telefono=".$tel1.", extension=".$tel2.", celular=".$cel.", direccion='".$dir."', "
                . "nombre='".$nombre."', numero_empleados=".$numE.", propietario='".$owner."', tamano=".$tamano.", "
                . "facebook='".$facebook."', twitter='".$twitter."', instagram='".$instagram."', youtube='".$youtube."', "
                . "googleplus='".$google."'"
                ." WHERE id_empresa=".$idEU."");
        $agregado=$this->db->query($sqlinsert);  
        if($agregado){
            
            $sqlconsultaAux = ("SELECT id_empresa FROM empresa WHERE nombre='".$nombre."' AND propietario='".$owner."'");
           $res=$this->db->query($sqlconsultaAux);
            $id=$res->fetch_row();

            //$sqlinsertAux=("INSERT INTO usuario_empresa (id_empresa, username) VALUES (".$id[0].", '".$email."')");
           // $agregadoAux=$this->db->query($sqlinsertAux);  
            /*$agregadoAuX=1;
            if($agregadoAux){
                echo ("<script> alert('Usuario modificado con Exito'); </script>"); 
                
            }else{ printf("Errormessage1: %s\n", $this->db->error);}*/
             
            
        }else{ printf("Errormessage2: %s\n", $this->db->error);
        
        } }else{printf("Errormessage3: %s\n", $this->db->error);}
        
        return $email;
    }
    
  public function get_empresas($usu_set){
        
        $sqlconsulta = ("SELECT U.username, E.nombre, S.id_sector, S.nombre, E.telefono, E.extension, E.celular, E.direccion, "
                . "E.propietario, E.numero_empleados, E.descripcion, E.tamano, U.enabled, EU.id_empresa, "
                . "RV.id_rango_ventas, RV.descripcion, M.id_membresia, M.nombre, E.facebook, E.twitter, E.instagram, E.youtube, E.googleplus "
                . "FROM usuario_empresa EU INNER JOIN empresa E ON EU.id_empresa=E.id_empresa "
                . "INNER JOIN sector S ON E.id_sector=S.id_sector INNER JOIN users U ON EU.username=U.username "
                . "INNER JOIN rango_ventas RV ON E.id_rango_ventas=RV.id_rango_ventas "
                . "INNER JOIN membresia M ON E.id_membresia=M.id_membresia "
                . "WHERE EU.username='".$usu_set."'");
        
        $resultado=$this->db->query($sqlconsulta);
        while($filas=$resultado->fetch_row()){
            $this->empresas[]=$filas;
            
        }
        
        $resultado->close();
       // $this->db->close();
        
        return $this->empresas;
 
    }
    public function habilitando($usu) {
        if(isset($usu)){
        $sqlupdate=("UPDATE users SET enabled = '1' WHERE users.username = '".$usu."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
                 
               echo ("<script> alert('Usuario modificado con Exito'); location.href ='../Controller/Emp_Activas_controller.php';</script>");
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
    }
        public function deshabilitando($usu) {
        if(isset($usu)){
        $sqlupdate=("UPDATE users SET enabled = NULL WHERE users.username = '".$usu."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
               echo ("<script> alert('Usuario modificado con Exito'); location.href ='../Controller/Emp_Activas_controller.php';</script>");
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
    }
    
    
    
}