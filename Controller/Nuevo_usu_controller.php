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
require_once("../Model/Nuevo_usu_model.php");
require_once("../Model/Sendmail.php");

$Nuevo_usu=new Nuevo_usu_model();
$sector=$Nuevo_usu->get_sectores();
$rangos=$Nuevo_usu->get_Rangos();

 if(isset($_POST['submit'])){
   
   $b=$Nuevo_usu->add_usuario();
   if($_POST['habilitar']){
       $c=$Nuevo_usu->habilitando($b);
       
   }
   
 }

 //Llamada a la vista
require_once("../view/Nuevo_usu_view.php");
}
else{
    unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}