<?php
/*
 *          Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 10-10-2018
 *   Versión: 1.0
 *   Descripcion: Controlador de la funcion que muestra las empresas activas
 * por Fabrica de Software, CIC-IPN
 */

//inicia variables de sesión
session_start();
  
//Destruye todas las variables de sesión
unset($_SESSION);

  session_destroy();
  
  echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
 
