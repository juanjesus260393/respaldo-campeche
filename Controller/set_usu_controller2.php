<?php
/*
 *          Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 10-10-2018
 *   Versión: 1.0
 *   Descripcion: Controlador de la funcion que permite la modificación de la información de una empresa
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
// Si existe y es de tipo administrador, manda a llamadar a los archivos conexion.php y set_usu_model2
else if($_SESSION['loggedin']==TRUE && $_SESSION['tipo']=='administrador'){
//Llamada al modelo

require_once ("../Model/conexion.php");
require_once("../Model/set_usu_model2.php");
//crea los objetos necesarios de las clases ,
$Set_usu=new set_usu_model2();
$sector=$Set_usu->get_sectores();
$rangos=$Set_usu->get_Rangos();
//variables de sesión de objetos pendientes
require_once("../Model/validar_contenido_model.php");
//Llama a los metodos y clases necesarias para el conteo de objetos y sitios pendientes
$cto_pendientes=new validar_contenido_model();

$_SESSION['nC']=$cto_pendientes->get_num_cupones();
$_SESSION['nS']=$cto_pendientes->get_num_sitios();
$_SESSION['nV']=$cto_pendientes->get_num_videos();
$_SESSION['nF']=$cto_pendientes->get_num_FoB();
$_SESSION['totalPendientes']=$_SESSION['nC']+$_SESSION['nS']+$_SESSION['nV']+$_SESSION['nF'];

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