<?php
/*
 *          Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 10-10-2018
 *   Versión: 1.0
 *   Descripcion: Controlador de la funcion que Permite validar o rechazar un cupon
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
// Si existe y es de tipo administrador, manda a llamadar a los archivos conexion.php y validarCupon_model
else if($_SESSION['loggedin']==TRUE && $_SESSION['tipo']=='administrador'){
//Llamada al modelo
require_once ("../Model/conexion.php");
require_once("../Model/validarCupon_model.php");
require_once("../Model/Sendmail.php");
//crea los objetos necesarios de las clases ,
$cup= new validarCupon_model();
$cupdatos=$cup->get_cupones();


require_once("../Model/validar_contenido_model.php");
//Llama a los metodos y clases necesarias para el conteo de objetos y sitios pendientes
$cto_pendientes=new validar_contenido_model();

$_SESSION['nC']=$cto_pendientes->get_num_cupones();
$_SESSION['nS']=$cto_pendientes->get_num_sitios();
$_SESSION['nV']=$cto_pendientes->get_num_videos();
$_SESSION['nF']=$cto_pendientes->get_num_FoB();
$_SESSION['totalPendientes']=$_SESSION['nC']+$_SESSION['nS']+$_SESSION['nV']+$_SESSION['nF'];


//Se verifica si ya se aprobo o rechazo el cupon
if(isset($_GET['opc'])){
    switch($_GET['opc']){
//Si se acepto        
        case 'A':
            if(isset($_GET['cupon'])&&isset($_GET['revision'])){
  if(isset($_GET['coment'])){
$comentario=$_GET['coment'];}
else{
    $comentario=" ";
}
$cupon=$_GET['cupon'];
$idrevision=$_GET['revision'];

$accept=$cup->acepta_cupon($cupon, $idrevision, $comentario);

}
break;
//Si se rechazo
        case 'R':
            if(isset($_GET['cupon'])&&isset($_GET['revision'])){
   
if(isset($_GET['coment'])){
$comentario=$_GET['coment'];}
else{
    $comentario=" ";
}
$cupon=$_GET['cupon'];
$idrevision=$_GET['revision'];

$noaccept=$cup->rechaza_cupon($cupon,$comentario, $idrevision);
            
            break;
    }
}}
//se obtiene la infromación del cupon
function aux($auxcup) {
    $cup= new validarCupon_model();
$infocupdato=$cup->get_info($auxcup);

return $infocupdato;
}
 


//Llamada a la vista
require_once("../view/validarCupon_view.php");
}
else{
    unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}