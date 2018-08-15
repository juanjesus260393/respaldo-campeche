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
require_once("../Model/validarSitios_model.php");
require_once("../Model/Sendmail.php");
$sit= new validarSitios_model();
$sitios=$sit->get_sitios();


require_once("../Model/validar_contenido_model.php");
$cto_pendientes=new validar_contenido_model();

$_SESSION['nC']=$cto_pendientes->get_num_cupones();
$_SESSION['nS']=$cto_pendientes->get_num_sitios();
$_SESSION['nV']=$cto_pendientes->get_num_videos();
$_SESSION['totalPendientes']=$_SESSION['nC']+$_SESSION['nS']+$_SESSION['nV'];



if(isset($_GET['opc'])){
    switch($_GET['opc']){
        case 'A':
            if(isset($_GET['sitio'])&&isset($_GET['revision'])){
   
$sitio=$_GET['sitio'];
$comentario=$_GET['coment'];
$idrevision=$_GET['revision'];

$accept=$sit->acepta_sitio($cupon, $idrevision, $comentario);

}
break;
        case 'R':
            if(isset($_GET['sitio'])&&isset($_GET['revision'])){
   
$comentario=$_GET['coment'];
$sitio=$_GET['sitio'];
$idrevision=$_GET['revision'];

$noaccept=$sit->rechaza_sitio($cupon,$comentario, $idrevision);
            
            break;
    }
}}
 


//Llamada a la vista
require_once("../view/validarSitios_view.php");
}
else{
    unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}