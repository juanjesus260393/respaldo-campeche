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

require_once("../Model/validar_contenido_model.php");
$cto_pendientes=new validar_contenido_model();

$_SESSION['nC']=$cto_pendientes->get_num_cupones();
$_SESSION['nS']=$cto_pendientes->get_num_sitios();
$_SESSION['nV']=$cto_pendientes->get_num_videos();
$_SESSION['totalPendientes']=$_SESSION['nC']+$_SESSION['nS']+$_SESSION['nV'];

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