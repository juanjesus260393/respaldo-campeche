<?php

class cambiaPass_model{
    private $db;
    private  $pas;


    public function __construct(){
        $this->db=Conectar::con();
        $this->sector=array();
        $this->id=array();
        
    }
    
    public function setPass() {  
         
        $pas=$_POST['password'];
        $emailaux=$_SESSION['username'];
        
        $pass=password_hash($pas, PASSWORD_DEFAULT);
       // $pass=password_hash('empresa1', PASSWORD_DEFAULT);
      //$pass=$this->gen_pass($email);
         
        if(isset($pass)){
        $sqlupdate=("UPDATE users SET password ='".$pass."' WHERE users.username = '".$emailaux."'");
        $update=$this->db->query($sqlupdate); 
        if($update){
                 sendmail($emailaux, $pas, 1);
            echo ('<script language = javascript>'
                    . 'self.location = "../principal.php";'
                    .'alert ("Contraseña cambiada");'
                    . '</script>');
    
 
                
        }else{ printf("Errormessage: %s\n", $this->db->error);}}
            
    }
    
    
   
    
    
    
}