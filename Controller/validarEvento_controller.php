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
require_once("../Model/validarEvento_model.php");
require_once("../Model/Sendmail.php");
$even= new validarEvento_model();
$evendatos=$even->get_eventos();


require_once("../Model/validar_contenido_model.php");
$cto_pendientes=new validar_contenido_model();

$_SESSION['nC']=$cto_pendientes->get_num_cupones();
$_SESSION['nS']=$cto_pendientes->get_num_sitios();
$_SESSION['nV']=$cto_pendientes->get_num_videos();
$_SESSION['nF']=$cto_pendientes->get_num_FoB();
$_SESSION['nVa']=$cto_pendientes->get_num_vacantes();
$_SESSION['nEve']=$cto_pendientes->get_num_eventos();

$_SESSION['totalPendientes']=$_SESSION['nC']+$_SESSION['nS']+$_SESSION['nV']+$_SESSION['nF']+$_SESSION['nVa'] + +$_SESSION['nEve'];



if(isset($_GET['opc'])){
    switch($_GET['opc']){
        case 'A':
            if(isset($_GET['evento'])&&isset($_GET['revision'])){
   
$evento=$_GET['evento'];
$idrevision=$_GET['revision'];

$accept=$even->acepta_evento($evento, $idrevision);

}
break;
        case 'R':
            if(isset($_GET['evento'])&&isset($_GET['revision']) &&isset($_GET['coment'])){
   
$comentario=$_GET['coment'];
$evento=$_GET['evento'];
$idrevision=$_GET['revision'];

$noaccept=$even->rechaza_evento($evento,$comentario, $idrevision);
            
            break;
    }
}}
function aux($auxevento) {
    $evento= new validarEvento_model();
$infoeventodato=$evento->get_info($auxevento);

return $infoeventodato;
}
 


//Llamada a la vista
require_once("../view/validarEvento_view.php");
}
else{
    unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}