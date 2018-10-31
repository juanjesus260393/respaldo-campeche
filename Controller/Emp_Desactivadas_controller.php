<?php
/*
 *          Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 10-10-2018
 *   Versión: 1.0
 *   Descripcion: Controlador de la funcion que muestra las empresas no activas
 * por Fabrica de Software, CIC-IPN
 */

//inicia variables de sesión

session_start();
// Verifica si al variable de sesión existe
if($_SESSION['loggedin']==NULL || $_SESSION['loggedin']==FALSE){
//si no existe o es nula, destruye la sesión y regresa al log in 
 unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';

}
// Si existe y es de tipo administrador, manda a llamadar a los archivos conexion.php y Emp_Desactivadas_model
else if($_SESSION['loggedin']==TRUE&& $_SESSION['tipo']=='administrador'){

//Llamada al modelo
require_once ("../Model/conexion.php");
require_once("../Model/Emp_Desactivadas_model.php");
//crea los objetos necesarios de las clases ,
$emp=new Emp_Desactivas_model();
$datos=$emp->get_empresas();
$sector=$emp->get_sectores();
$Nemp=$emp->get_numemp();

require_once("../Model/validar_contenido_model.php");
//Llama a los metodos y clases necesarias para el conteo de objetos y sitios pendientes
$cto_pendientes=new validar_contenido_model();

$_SESSION['nC']=$cto_pendientes->get_num_cupones();
$_SESSION['nS']=$cto_pendientes->get_num_sitios();
$_SESSION['nV']=$cto_pendientes->get_num_videos();
$_SESSION['nF']=$cto_pendientes->get_num_FoB();
$_SESSION['totalPendientes']=$_SESSION['nC']+$_SESSION['nS']+$_SESSION['nV']+$_SESSION['nF'];

 if(isset($_POST['activar'])){
     
     
      $a=$emp->iniciaMembresia();
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