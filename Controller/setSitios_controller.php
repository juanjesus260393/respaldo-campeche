<?php

session_start();

if($_SESSION['loggedin']==NULL || $_SESSION['loggedin']==FALSE){
 unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';

}
else if($_SESSION['loggedin']==TRUE && $_SESSION['tipo']=='empresa'){
//Llamada al modelo
require_once ("../Model/conexion.php");
require_once("../Model/setSitios_model.php");
require_once("../Model/Sendmail.php");
$sit= new setSitios_model();
$sitios=$sit->get_sitios();
$municipio=$sit->get_municipios();


require_once("../Model/validar_contenido_model.php");
$cto_pendientes=new validar_contenido_model();

$_SESSION['nC']=$cto_pendientes->get_num_cupones();
$_SESSION['nS']=$cto_pendientes->get_num_sitios();
$_SESSION['totalPendientes']=$_SESSION['nC']+$_SESSION['nS'];



if(isset($_POST['seeet'])){
    
   $b=$sit->add_sitio();
   printf("<script>document.location.href='../Controller/setSitios_controller.php'; </script>");
   
 }
 


//Llamada a la vista
require_once("../view/setSitios_view.php");
}
else{
    unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}