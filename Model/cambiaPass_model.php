<?php
/*
 *   Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 24-10-2018
 *   Versión: 1.0
 *   Descripcion: Modelo donde se encuentran todas las funciones necesarias
 *   para cambiar la contraseña
 * 
 * por Fabrica de Software, CIC-IPN
 */

//Se declara la clase cambiaPass_model
class cambiaPass_model{
    private $db;
    private  $pas;

//Se declara el constructor de la clase
    
    public function __construct(){
        $this->db=Conectar::con();
        $this->sector=array();
        $this->id=array();
        
    }
    //Se de clara el metodo o función setPass, donde se hara el cambio de contraseña en la base de datos
    
    public function setPass() {  
         //Se recibe el valor del formulario de la nueva contraseña
        $pas=$_POST['password'];
        $emailaux=$_SESSION['username'];
        //Se aplica un hash a la contraseña para cifrarla
        $pass=password_hash($pas, PASSWORD_DEFAULT);
      
      //Se inserta en la base de datos la nueva contraseña   
        if(isset($pass)){
        $sqlupdate=("UPDATE users SET password ='".$pass."' WHERE users.username = '".$emailaux."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
                 sendmail($emailaux, $pas, 1);
                 //Si todo es exitoso se manda una alerta
            echo ('<script language = javascript>'
                    . 'self.location = "../principal.php";'
                    .'alert ("Contraseña cambiada");'
                    . '</script>');
    
 
                
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
            
    }
    
    
   
    
    
    
}