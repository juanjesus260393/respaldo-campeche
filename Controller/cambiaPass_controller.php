<?php
session_start();

if($_SESSION['loggedin']==NULL || $_SESSION['loggedin']==FALSE){
 unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';

}
else if($_SESSION['loggedin']==TRUE){
require_once ("../Model/conexion.php");
require_once("../Model/cambiaPass_model.php");
require_once("../Model/Sendmail.php");
if(isset($_POST['si'])){
    $a=new cambiaPass_model();
    $nwp=$a->setPass();
    
    
}


require_once ("../view/cambiaPass_view.php");


}

