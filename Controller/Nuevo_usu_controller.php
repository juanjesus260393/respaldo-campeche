<?php
//Llamada al modelo
require_once ("../Model/conexion.php");
require_once("../Model/Nuevo_usu_model.php");
$Nuevo_usu=new Nuevo_usu_model();
$sector=$Nuevo_usu->get_sectores();

 if(isset($_POST['submit'])){
   
   $b=$Nuevo_usu->add_usuario();
   if($_POST['habilitar']){
       $c=$Nuevo_usu->habilitando($b);
       
   }
   
 }

 //Llamada a la vista
require_once("../view/Nuevo_usu_view.php");
