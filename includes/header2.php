<?php 
$_SESSION['Expira']= time();
if(($_SESSION['Expira']-$_SESSION['Inicia'])>10800){
   
    header('Location: ../Controller/cerrarSession.php');
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap-grid.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
         <script src="../js/Validaciones.js"></script>


   
    
        <title>Proyecto Campeche 360</title>
    </head>
    <body>
        <?php
               include '../view/modals.php';
                  
              
                
//$na = new validacion();
//$idro = $na->registros_cupon();
           
//YsJQueryAutoloader::register();
?>

                  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin:0px 0px 24px 0px;">
                    <a class="navbar-brand" href="">Bienvenido : <?php printf($_SESSION['username']); ?></a>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navb">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link " href="../principal.php" >
                                    HOME
                                </a>

                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    Sitios
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="../Controller/ControladorSitios.php">Ver Sitios</a>
                                    <a class="dropdown-item" href="../Controller/add_Sitios_controller.php">Agregar Sitios</a>
                                    <a class="dropdown-item" href="../Controller/setSitios_controller.php">Modificar Sitio</a>

                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="../Controller/crtCupones.php" id="navbardrop" data-toggle="dropdown">
                                                    Cupones
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="../Controller/crtCupones.php">Cupones  </a>
                                                    <a class="dropdown-item" href="../view/Addcupon.php">Agregar Cupon  </a>
                                                    

                                                </div>
                             </li>
                             <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle" href="../Controller/crtcVideos.php" id="navbardrop" data-toggle="dropdown">
                                                    Videos
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="../Controller/crtcVideos.php">Videos  </a>
                                                    <a class="dropdown-item" href="../view/Addvideo.php">Agregar Video</a>

                                                </div>
                             </li>
                             <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle" href="../Controller/crtcFlyers.php" id="navbardrop" data-toggle="dropdown">
                                                    Flyers & Banners
                                                </a>
                                                <div class="dropdown-menu">
                                                    <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#modalFlyer">Que es un Flyer???</button>
                                                    <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#modalBanner">Que es un Banner???</button>
                                                    <a class="dropdown-item" href="../Controller/crtcFlyers.php">Flyers & Banners  </a>
                                                    <a class="dropdown-item" href="../view/Addflyerybanner.php">Agregar Flyers & Banners  </a>
                                                    
                                                </div>
                             </li>
                              <li class="nav-item dropdown inline-flex">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                            Bolsa de Trabajo
                                        </a>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="../Controller/setVacantes_controller.php">Vacantes</a>
                                        <a class="dropdown-item" href="../view/Addvacante.php">Agregar Vacante</a>
                                        <a class="dropdown-item" href="#">opcion3</a>
                                        </div>
                                    </li>   
                                    <li class="nav-item dropdown inline-flex">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                            Cartelera
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="../Controller/setEventos_controller.php">Eventos</a>
                                            <a class="dropdown-item" href="../Controller/add_Eventos_controller.php">Agregar Evento</a>
                                            <a class="dropdown-item" href="#">opcion3</a>
                                        </div>
                                    </li> 
                                    <li class="nav-item dropdown inline-flex">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                            B2B
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="../Controller/setIntencion_controller.php">Intencion de Paquete</a>
                                            <a class="dropdown-item" href="../Controller/add_Eventos_controller.php">Agregar Intención</a>
                                            <a class="dropdown-item" href="#">Paquetes</a>
                                        </div>
                                    </li> 
                             <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                                    Graficas
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="../Controller/crtEstadisticacupones.php">Estadisticas Cupones </a>
                                                    <a class="dropdown-item" href="#">  </a>
                                                </div>
                             </li>
                              <li class="nav-item dropdown">
                                 <a class="nav-link" href="../Controller/cambiaPass_controller.php" id="navbardrop" >
                                                    Cambia Contraseña
                                                </a>       
                             </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0" action="../Controller/cerrarSession.php">
                            <button class="btn btn-warning my-2 my-sm-0" type="submit">Cerrar Sesion</button>
                        </form>
                    </div>
                </nav>

		<!-- comienza codigo -->        
		<div class="row">
		<div class="col-md-12">
			<div class="row"  style="min-height: 400px;">
				<div class="col-md-1">
				</div>
				<div class="col-md-10">
		<!-- termina codigo -->