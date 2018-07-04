<?php
//Llamada al modelo
require_once ("../Model/conexion.php");
require_once("../Model/set_usu_model1.php");
$emp=new set_usu_model1();
$datos=$emp->get_empresas();

 
 
//Llamada a la vista
require_once("../view/set_usu_view1.php");