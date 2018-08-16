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
require_once("../Model/validarFlyers_model.php");
require_once("../Model/Sendmail.php");
$Fly= new validarFlyers_model();
$flyBan=$Fly->get_Flyers();


require_once("../Model/validar_contenido_model.php");
$cto_pendientes=new validar_contenido_model();

$_SESSION['nC']=$cto_pendientes->get_num_cupones();
$_SESSION['nS']=$cto_pendientes->get_num_sitios();
$_SESSION['nV']=$cto_pendientes->get_num_videos();
$_SESSION['nF']=$cto_pendientes->get_num_FoB();
$_SESSION['totalPendientes']=$_SESSION['nC']+$_SESSION['nS']+$_SESSION['nV']+$_SESSION['nF'];



if(isset($_GET['opc'])){
    switch($_GET['opc']){
        case 'A':
            
   
$FoB=$_GET['FoB'];
$comentario=$_GET['coment'];

$accept=$Fly->acepta_FoB($FoB, $comentario);


break;
        case 'R':
            if(isset($_GET['coment'])&&isset($_GET['cupon'])&&isset($_GET['revision'])){
   
$FoB=$_GET['FoB'];
$comentario=$_GET['coment'];
$revision=$_GET['revision'];
$noaccept=$Fly->rechaza_FoB($FoB,$comentario);
            
            break;
    }
}}


 


//Llamada a la vista
require_once("../view/validarFlyers_view.php");
}
else{
    unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}