<?php
//Llamada al modelo
require_once ("../model/conexion.php");
require_once("../model/Emp_Activas_model.php");
$emp=new Emp_Activas_model();
$datos=$emp->get_empresas();
 
//Llamada a la vista
require_once("../view/Emp_Activas_view.php");