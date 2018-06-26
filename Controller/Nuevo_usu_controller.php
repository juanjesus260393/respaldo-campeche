<?php
//Llamada al modelo
require_once ("../model/conexion.php");
require_once("../model/Nuevo_usu_model.php");
$Nuevo_usu=new Nuevo_usu_model();
$sector=$Nuevo_usu->get_sectores();
 
//Llamada a la vista
require_once("../view/Nuevo_usu_view.php");