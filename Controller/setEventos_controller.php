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
    require_once("../Model/setEventos_model.php");
    require_once("../Model/Sendmail.php");
    $eve = new setEventos_model();
    $eventos = $eve->get_eventos();
    $categorias = $eve->get_categorias();
    $sitios = $eve->get_sitios();


    //require_once("../Model/validar_contenido_model.php");
    //$cto_pendientes = new validar_contenido_model();

    // $_SESSION['nC'] = $cto_pendientes->get_num_cupones();
    // $_SESSION['nS'] = $cto_pendientes->get_num_sitios();
    // $_SESSION['totalPendientes'] = $_SESSION['nC'] + $_SESSION['nS'];



    if (isset($_POST['actualizar'])) {

     $b = $eve->update_Evento();
       printf("<script>document.location.href='../Controller/setEventos_controller.php'; </script>");
 }

 if (isset($_POST['eliminar'])) {
            printf("Eliminando Evento ...");
            $b = $eve->eliminar_Evento();
       printf("<script>document.location.href='../Controller/setEventos_controller.php'; </script>");
  }



//Llamada a la vista
    require_once("../view/setEvento_view.php");
} else {
    unset($_SESSION);
    session_destroy();
    echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}