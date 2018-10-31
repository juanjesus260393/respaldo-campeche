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
require_once("../Model/add_Eventos_model.php");


$Nueva_categoria=new add_Eventos_model();
$categoria=$Nueva_categoria->get_categorias();

$sitios=$Nueva_categoria->get_sitios();




 if(isset($_POST['submit1'])){
   
   $b=$Nueva_categoria->add_evento();
   
 }

 //Llamada a la vista
require_once("../view/add_Eventos_view.php");
}