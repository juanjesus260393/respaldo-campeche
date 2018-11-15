<?php
/*
 *          Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 10-10-2018
 *   Versión: 1.0
 *   Descripcion: Controlador de la funcion que permite la modificación de la información de un sitio
 * por Fabrica de Software, CIC-IPN
 */

//inicia variables de sesión
session_start();
// Verifica si al variable de sesión existe
if ($_SESSION['loggedin'] == NULL || $_SESSION['loggedin'] == FALSE) {
//si no existe o es nula, destruye la sesión y regresa al log in 
    unset($_SESSION);
    session_destroy();
    echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
// Si existe y es de tipo empresa, manda a llamadar a los archivos conexion.php y Set_Sitios_model
} else if ($_SESSION['loggedin'] == TRUE && $_SESSION['tipo'] == 'empresa') {
//Llamada al modelo
    require_once ("../Model/conexion.php");
    require_once("../Model/setSitios_model.php");
    require_once("../Model/Sendmail.php");

//crea los objetos necesarios de las clases ,
    $sit = new setSitios_model();
    $sitios = $sit->get_sitios();
    $municipio = $sit->get_municipios();
   
    if (isset($_POST['seeet'])) {

        $b = $sit->add_sitio();
        printf("<script>document.location.href='../Controller/setSitios_controller.php'; </script>");
    }



//Llamada a la vista
    require_once("../view/setSitios_view.php");
} else {
    unset($_SESSION);
    session_destroy();
    echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}