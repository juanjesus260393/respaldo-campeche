<?php
//Llamada al modelo
require_once ("../Model/conexion.php");
require_once("../Model/Emp_Activas_model.php");
$emp=new Emp_Activas_model();
$datos=$emp->get_empresas();

 if(isset($_POST['desactivar'])){
     $quita=$emp->disabled_emp($_POST['user_disabled']);
     
 }
 
//Llamada a la vista
require_once("../view/Emp_Activas_view.php");