<?php

session_start();

if ($_SESSION['loggedin'] == NULL || $_SESSION['loggedin'] == FALSE) {
    unset($_SESSION);
    session_destroy();
    echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
} else if ($_SESSION['loggedin'] == TRUE && $_SESSION['tipo'] == 'empresa') {
//Llamada al modelo
    require_once ("../Model/conexion.php");
    require_once("../Model/setSitios_model.php");
   
    $sit = new setSitios_model();
    $sitios = $sit->get_sitios();
    $municipio = $sit->get_municipios();

//Llamada a la vista
    require_once("../view/VistaSitios.php");
} else {
    unset($_SESSION);
    session_destroy();
    echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}