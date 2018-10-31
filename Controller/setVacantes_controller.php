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
    require_once("../Model/setVacantes_model.php");
    require_once("../Model/Sendmail.php");
    $eve = new setVacantes_model();
    $vacantes = $eve->get_vacantes();
    
   
    if (isset($_POST['actualizar'])) {

     $b = $eve->actualizar_vacante();
       printf("<script>document.location.href='../Controller/setVacantes_controller.php'; </script>");
 }

 if (isset($_POST['eliminar'])) {
            printf("Eliminando Vacante ...");
            $b = $eve->eliminar_vacante();
       printf("<script>document.location.href='../Controller/setVacantes_controller.php'; </script>");
  }



//Llamada a la vista
    require_once("../view/setVacante_view.php");
} else {
    unset($_SESSION);
    session_destroy();
    echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}