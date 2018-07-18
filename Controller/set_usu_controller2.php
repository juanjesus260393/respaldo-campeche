<?php

session_start();

if($_SESSION['loggedin']==NULL || $_SESSION['loggedin']==FALSE){
 unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';

}
else if($_SESSION['loggedin']==TRUE && $_SESSION['tipo']=='administrador'){
//Llamada al modelo

require_once ("../Model/conexion.php");
require_once("../Model/set_usu_model2.php");
$Set_usu=new set_usu_model2();
$sector=$Set_usu->get_sectores();
$rangos=$Set_usu->get_Rangos();
$usu_aux=$_GET['dato'];
if(isset($usu_aux)){
   

printf($usu_aux);}else{$usu_aux="";}

$datos=$Set_usu->get_empresas($usu_aux);

     
 if(isset($_POST['submit2'])){
   
   $x=$Set_usu->add_usuario($_POST['userr'], $_POST['usu_before_set']);
   if($_POST['habilitar']){
       $c=$Set_usu->habilitando($x);
   }else{
       $d=$Set_usu->deshabilitando($x);
   }
   
 
   
   }

 //Llamada a la vista
require_once("../view/set_usu_view2.php");
}
else{
    unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}