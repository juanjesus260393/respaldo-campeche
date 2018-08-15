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
require_once("../Model/validarVideo_model.php");
require_once("../Model/Sendmail.php");
$vid= new validarVideo_model();
$viddatos=$vid->get_videos();


require_once("../Model/validar_contenido_model.php");
$cto_pendientes=new validar_contenido_model();

$_SESSION['nC']=$cto_pendientes->get_num_cupones();
$_SESSION['nS']=$cto_pendientes->get_num_sitios();
$_SESSION['nV']=$cto_pendientes->get_num_videos();
$_SESSION['totalPendientes']=$_SESSION['nC']+$_SESSION['nS']+$_SESSION['nV'];



if(isset($_GET['opc'])){
    switch($_GET['opc']){
        case 'A':
            if(isset($_GET['video'])){
   
$video=$_GET['video'];
$comentario=$_GET['coment'];
$name=$_GET['name'];

$accept=$vid->acepta_video($video, $comentario, $name);

}
break;
        case 'R':
            if(isset($_GET['video'])){
   echo ("<script> alert('Video hola');</script>");
$video=$_GET['video'];
$comentario=$_GET['coment'];
$name=$_GET['name'];
$revision=$_GET['rev'];

$noaccept=$vid->rechaza_video($video, $comentario, $name, $revision);
            
            break;
    }
}}

//Llamada a la vista
require_once("../view/validarVideo_view.php");
}
else{
    unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}