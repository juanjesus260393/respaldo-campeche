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
require_once("../Model/validarCupon_model.php");
$cup= new validarCupon_model();
$cupdatos=$cup->get_cupones();


require_once("../Model/validar_contenido_model.php");
$cto_pendientes=new validar_contenido_model();

$_SESSION['nC']=$cto_pendientes->get_num_cupones();
$_SESSION['nS']=$cto_pendientes->get_num_sitios();
$_SESSION['totalPendientes']=$_SESSION['nC']+$_SESSION['nS'];



if(isset($_GET['opc'])){
    switch($_GET['opc']){
        case A:
            if(isset($_GET['cupon'])&&isset($_GET['revision'])){
   
$cupon=$_GET['cupon'];
$idrevision=$_GET['revision'];

$accept=$cup->acepta_cupon($cupon, $idrevision);

}
break;
        case R:
            if(isset($_GET['coment'])&&isset($_GET['cupon'])&&isset($_GET['revision'])){
   
$comentario=$_GET['coment'];
$cupon=$_GET['cupon'];
$idrevision=$_GET['revision'];

$noaccept=$cup->rechaza_cupon($cupon,$comentario, $idrevision);
            
            break;
    }
}}
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