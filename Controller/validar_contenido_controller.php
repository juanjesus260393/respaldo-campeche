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
require_once("../Model/validar_contenido_model.php");
$cto_pendientes=new validar_contenido_model();

$nC=$cto_pendientes->get_num_cupones();
$nS=$cto_pendientes->get_num_sitios();
$totalPendientes=$nC+$nS;
 
//Llamada a la vista
require_once("../view/validar_contenido_view.php");
}
else{
    unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}