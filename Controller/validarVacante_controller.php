<?php

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
// Si existe y es de tipo administrador, manda a llamadar a los archivos conexion.php y validarSitios_model
else if($_SESSION['loggedin']==TRUE && $_SESSION['tipo']=='administrador'){
//Llamada al modelo
require_once ("../Model/conexion.php");
require_once("../Model/validarVacante_model.php");
require_once("../Model/Sendmail.php");
$vac= new validarVacante_model();
$vacdatos=$vac->get_vacantes();


require_once("../Model/validar_contenido_model.php");
$cto_pendientes=new validar_contenido_model();

$_SESSION['nC']=$cto_pendientes->get_num_cupones();
$_SESSION['nS']=$cto_pendientes->get_num_sitios();
$_SESSION['nV']=$cto_pendientes->get_num_videos();
$_SESSION['nF']=$cto_pendientes->get_num_FoB();
$_SESSION['nVa']=$cto_pendientes->get_num_vacantes();
$_SESSION['nEv']=$cto_pendientes->get_num_eventos();

$_SESSION['totalPendientes']=$_SESSION['nC']+$_SESSION['nS']+$_SESSION['nV']+$_SESSION['nF']+$_SESSION['nVa'];



if(isset($_GET['opc'])){
    switch($_GET['opc']){
        case 'A':
            if(isset($_GET['vacante'])&&isset($_GET['revision'])){
   
$vacante=$_GET['vacante'];
$idrevision=$_GET['revision'];

$accept=$vac->acepta_vacante($vacante, $idrevision);

}
break;
        case 'R':
            if(isset($_GET['vacante'])&&isset($_GET['revision']) &&isset($_GET['coment'])){
   
$comentario=$_GET['coment'];
$vacante=$_GET['vacante'];
$idrevision=$_GET['revision'];

$noaccept=$vac->rechaza_vacante($vacante,$comentario, $idrevision);
            
            break;
    }
}}
function aux($auxvacante) {
    $vacante= new validarVacante_model();
$infovacantedato=$vacante->get_info($auxvacante);

return $infovacantedato;
}
 


//Llamada a la vista
require_once("../view/validarVacante_view.php");
}
else{
    unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}