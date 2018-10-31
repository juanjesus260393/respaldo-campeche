<?php
/*
 *          Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 10-10-2018
 *   Versión: 1.0
 *   Descripcion: Controlador de la funcion que muestra las empresas no activas
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
// Si existe y es de tipo administrador, manda a llamadar a los archivos conexion.php y validarFlyers_model    
} else if ($_SESSION['loggedin'] == TRUE && $_SESSION['tipo'] == 'administrador') {
//Llamada al modelo
    require_once ("../Model/conexion.php");
    require_once("../Model/validarFlyers_model.php");
    require_once("../Model/Sendmail.php");
//crea los objetos necesarios de las clases ,    
    $Fly = new validarFlyers_model();
    $flyBan = $Fly->get_Flyers();


    require_once("../Model/validar_contenido_model.php");
    //Llama a los metodos y clases necesarias para el conteo de objetos y sitios pendientes
    $cto_pendientes = new validar_contenido_model();

    $_SESSION['nC'] = $cto_pendientes->get_num_cupones();
    $_SESSION['nS'] = $cto_pendientes->get_num_sitios();
    $_SESSION['nV'] = $cto_pendientes->get_num_videos();
    $_SESSION['nF'] = $cto_pendientes->get_num_FoB();
    $_SESSION['totalPendientes'] = $_SESSION['nC'] + $_SESSION['nS'] + $_SESSION['nV'] + $_SESSION['nF'];



//Se verifica si ya se aprobo o rechazo el Flyer o Banner
    if (isset($_GET['opc'])) {
        switch ($_GET['opc']) {
//Si se acepto  
            case 'A':


                $FoB = $_GET['FoB'];
                if (isset($_GET['coment'])) {
                    $comentario = $_GET['coment'];
                } else {
                    $comentario = " ";
                }

                $accept = $Fly->acepta_FoB($FoB, $comentario);


                break;
            case 'R':
//Si se rechazo           
                    $FoB = $_GET['FoB'];
                    if (isset($_GET['coment'])) {
                        $comentario = $_GET['coment'];
                    } else {
                        $comentario = " ";
                    }
                    $revision = $_GET['revision'];
                    $noaccept = $Fly->rechaza_FoB($FoB, $comentario, $revision);

                    break;
                
        }
    }





//Llamada a la vista
    require_once("../view/validarFlyers_view.php");
} else {
    unset($_SESSION);
    session_destroy();
    echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}