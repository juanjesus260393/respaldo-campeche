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
//Llamada al modelo
require_once ("../Model/conexion.php");
require_once("../Model/set_usu_model1.php");
$emp=new set_usu_model1();
$datos=$emp->get_empresas();

 
 
//Llamada a la vista
require_once("../view/set_usu_view1.php");

}
else{
    unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}