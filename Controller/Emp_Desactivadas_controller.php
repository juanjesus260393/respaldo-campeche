<?php

session_start();

if($_SESSION['loggedin']==NULL || $_SESSION['loggedin']==FALSE){
 unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';

}
else if($_SESSION['loggedin']==TRUE&& $_SESSION['tipo']=='administrador'){

//Llamada al modelo
require_once ("../Model/conexion.php");
require_once("../Model/Emp_Desactivadas_model.php");
$emp=new Emp_Desactivas_model();
$datos=$emp->get_empresas();

 if(isset($_POST['activar'])){
     $pon=$emp->able_emp($_POST['user_able']);
     
 }
 
//Llamada a la vista
require_once("../view/Emp_Desactivadas_view.php");}
else{
    unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}