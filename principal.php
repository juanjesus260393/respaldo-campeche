<?php

session_start();
$_SESSION['Inicia'] = time(); //EL TIEMPO ADELANTADO 10 SEGUNDOS

require_once ("Model/conexion.php");
?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">
    <head>
        <!--
        CSS
        ============================================= -->
        <link rel="stylesheet" href="css/linearicons.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/bootstrap-grid.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/Validaciones.js"></script>



        <!--
        CSS
        ============================================= -->
        <title>Proyecto Campeche</title>

    </head>
    <body class="dup-body">
        <div class="dup-body-wrap">
            <!-- Start Header Area -->
            <header class="default-header">
                <div class="header-wrap">
                    <div class="header-top d-flex justify-content-between align-items-center">
                        <div class="logo" >
                            <a href="index.html"><img src="Imagenes/img/ic_launcher.png" height="80" width="80" alt=""></a>
                        </div>
                        <div class="main-menubar d-flex align-items-center">
                            <nav class="hide">
                                <?php
                                if ($_SESSION['loggedin'] == NULL || $_SESSION['loggedin'] == FALSE) {
                                    unset($_SESSION);
                                    session_destroy();
                                    echo '<script language = javascript>
                         self.location = "../index.php"
                         </script>';
                                } else if ($_SESSION['loggedin'] == TRUE && $_SESSION['tipo'] == 'administrador') {
                                      require_once("Model/validar_contenido_model.php");
                                    $cto_pendientes = new validar_contenido_model();
                                    $_SESSION['nC'] = $cto_pendientes->get_num_cupones();
                                    $_SESSION['nS'] = $cto_pendientes->get_num_sitios();
                                    $_SESSION['nV'] = $cto_pendientes->get_num_videos();
                                    $_SESSION['nF'] = $cto_pendientes->get_num_FoB();
                                    $_SESSION['totalPendientes'] = $_SESSION['nC'] + $_SESSION['nS'] + $_SESSION['nV'] + $_SESSION['nF'];

                                  ?>
                                    <ul>
                                    <li class="nav-item dropdown inline-flex">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                            Empresas
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="Controller/Nuevo_usu_controller.php">Nueva Empresa</a>
                                            <a class="dropdown-item" href="Controller/Emp_Desactivadas_controller.php">Empresas Deshabilitadas</a>
                                            <a class="dropdown-item" href="Controller/Emp_Activas_controller.php">Empresas Activas</a>
                            <?php
                                if ($_SESSION['username'] == 'juan@gmail.com') {
                              printf('<a class="dropdown-item" href="Controller/insertAuthority.php">Agregar Administrador</a>');
                                }
                                    ?>
                                        </div>
                                    </li>

                                    <li class="nav-item dropdown inline-flex">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                            Validar <span> <?php printf($_SESSION['totalPendientes']); ?></span>
                                        </a>
                                        <div class="dropdown-menu">

                                            <a class="dropdown-item" href="Controller/validarSitios_controller.php">Sitios <span> <?php printf($_SESSION['nS']); ?></span></a>
                                            <a class="dropdown-item" href="Controller/validarCupon_controller.php">Cupones   <span> <?php printf($_SESSION['nC']); ?></span></a>
                                            <a class="dropdown-item" href="Controller/validarVideo_controller.php">Videos <span> <?php printf($_SESSION['nV']); ?></span></a>
                                            <a class="dropdown-item" href="Controller/validarFlyers_controller.php">Flyers & Banners <span><?php printf($_SESSION['nF']); ?></span></a>
                                            <a class="dropdown-item" href="Controller/validarVacante_controller.php">Vacantess <span><?php printf($_SESSION['nF']); ?></span></a>
                                            <a class="dropdown-item" href="Controller/validarEvento_controller.php">Cartelera <span><?php printf($_SESSION['nF']); ?></span></a>
                                        </div>
                                    </li>
                                                                        
                                </ul>
 
                               <?php } else if($_SESSION['loggedin']==TRUE&&$_SESSION['tipo']=='empresa'){
                                                        ?>
                                                       
                                    <ul>
                            <li class="nav-item dropdown inline-flex">
                                <a class="nav-link" href="Controller/ControladorSitios.php" id="navbardrop">
                                    Sitios
                                </a>
                            </li>
                            <li class="nav-item dropdown inline-flex">
                                                <a class="nav-link" href="Controller/crtCupones.php" id="navbardrop">
                                                    Cupones
                                                </a>
                             </li>
                             <li class="nav-item dropdown inline-flex">
                                 <a class="nav-link" href="Controller/crtcVideos.php" id="navbardrop">
                                                    Videos
                                                </a>
                             </li>
                             <li class="nav-item dropdown inline-flex">
                                 <a class="nav-link" href="Controller/crtcFlyers.php" id="navbardrop">
                                                    Flyers & Banners
                                                </a>
                             </li>
                             <li class="nav-item dropdown inline-flex">
                                 <a class="nav-link" href="Controller/crtEstadisticacupones.php" id="navbardrop">
                                                    Graficas
                                                </a>
                             </li>
                             <li class="nav-item dropdown inline-flex">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                            Bolsa de Trabajo
                                        </a>
                                        <div class="dropdown-menu">
                                         
                                            
                                            <a class="dropdown-item" href="Controller/setVacantes_controller.php">Vacantes</a>
                                        <a class="dropdown-item" href="view/Addvacante.php">Agregar Vacante</a>
                                        <a class="dropdown-item" href="#">opcion3</a>


                                        </div>
                                    </li>   
                                    <li class="nav-item dropdown inline-flex">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                            Cartelera
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="Controller/setEventos_controller.php">Eventos</a>
                                            <a class="dropdown-item" href="view/add_Eventos_view.php">Agregar Eventos</a>
                                            <a class="dropdown-item" href="#">opcion3</a>
                                        </div>
                                    </li> 
                              <li class="nav-item dropdown inline-flex">
                                 <a class="nav-link" href="Controller/cambiaPass_controller.php" id="navbardrop" >
                                                    Cambia Contraseña
                                                </a>       
                             </li>
                        </ul>

                            <?php   }else {
                                    unset($_SESSION);
                                    session_destroy();
                                    echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
                                }
                                ?>
                                

                                

                            </nav>
                            <div class="menu-bar"><span class="lnr lnr-menu"></span></div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- End Header Area -->
            <!-- Start Banner Area -->
            <section class="banner-area relative">
                <div class="overlay overlay-bg"></div>
                <div class="container">
                    <div class="row fullscreen align-items-center justify-content-between">
                        <div class="col-lg-6 col-md-7 col-sm-8">
                            <div class="banner-content">
                                <h1>Campeche<br> 360</h1>
                                <p>Administrador de contenidos 	campeche 360</p>
                                <form  action="Controller/cerrarSession.php">
                                    <button class="primary-btn" type="submit">Cerrar Sesi&oacute;n</button>
                                    </form>
                            
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-4">
                            <img src="Imagenes/img/campeche.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Banner Area -->



            <!-- Start Carousel Area -->
            <section class="section-gap carousel-area">
                <div class="overlay overlay-bg"></div>
                <div class="active-bottle-carousel">
                    <div class="item">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-xl-6 col-md-4">
                                    <div class="carousel-thumb">
                                        <img src="Imagenes/img/item1.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-7">
                                    <div class="carousel-content">
                                        <h2 class="text-white">Bienvenido</h2>
                                        <h5 class="text-white mb-20">La aplicaci&oacute;n Campeche 360 fue creada por el Consejo Coordinador Empresarial especialmente para los visitantes a nuestra identidad y desarrollada para la interacci&oacute;n de las empresas prestadoras de servicios tur&iacute;sticos y complementarias de la ciudad con el fin de ofertar de manera competitiva, eficiente y en tiempo real sus productos al turista.</h5>
                                        <p class="text-white mb-30">Es una valiosa herramienta tecnol&oacute;gica que le da un gran poder al usuario para disfrutar a plenitud de todos los atractivos tur&iacute;sticos durante su estad&iacute;a, para su goce y satisfacci&oacute;n.</p>
                                        <p class="text-white mb-30">Le invito a disfrutar de la experiencia del App Campeche 360 y vivir campechanamente un tiempo excepcional en nuestra ciudad de San Francisco de Campeche, Patrimonio Cultural de la Humanidad. </p>
                                        <p class="text-white mb-30">Bienvenido, </p>
                                        <p class="text-white mb-30">Carlos Gustavo Rodriguez Valle Presidente del Consejo Coordinador Empresarial de Campeche</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-xl-6 col-md-4">
                                    <div class="carousel-thumb">
                                        <img src="Imagenes/img/item2.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-7">
                                    <div class="carousel-content">
                                        <h2 class="text-white">PLAN DIAMANTE</h2>
                                        <h5 class="text-white mb-20">El mas completo.</h5>
                                        <p class="text-white mb-30">Al contratar este paquete de servicio de forma anual, usted contar&aacute; con la afiliaci&oacute;n por un año en la Camara del Consejo Empresarial de Campeche, as&iacute; como de la c&aacute;mara a la cual pertenezca su giro de servicio. Adicionalmente la ubicaci&oacute;n de su negocio dentro de los atractivos tur&iacute;sticos de la aplicaci&oacute;n con la alta descripci&oacute;n del giro de su empresa, posibilidades de hacer campañas de Marketing personalizadas, tener reportes de visitantes a su negocio, la evaluaci&oacute;n de sus servicios de manera inmediata, dinamismo de manejo de publicidad de su negocio. Con la adici&oacute;n de soporte t&eacute;cnico para el mantenimiento de su negocio en la aplicaci&oacute;n de Campeche 360. Para cualquier pregunta el cuanto al costo, por favor cont&aacute;ctenos a trav&eacute;s de esta p&aacute;gina web, correo electr&oacute;nico o tel&eacute;fono.</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-xl-6 col-md-4">
                                    <div class="carousel-thumb">
                                        <img src="Imagenes/img/item3.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-7">
                                    <div class="carousel-content">
                                        <h2 class="text-white">PLAN ORO</h2>
                                        <h5 class="text-white mb-20">Ideal para ti.</h5>
                                        <p class="text-white mb-30">El plan oro le permite a su negocio tener acceso a la aplicaci&oacute;n a trav&eacute;s de las ubicaciones en forma de un pin dentro del mapa de la ciudad, Ud. podr&aacute; tener hasta cinco im&aacute;genes para publicidad de la aplicaci&oacute;n, hacer la descripci&oacute;n corta y una larga de su tipo de servicio, as&iacute; como la especialidad de su negocio, podr&aacute; hacer publicidad de eventos, llevar un registro de la evaluaci&oacute;n de sus servicios de forma inmediata, crear cupones de descuentos, creaci&oacute;n de campañas de Marketing especializadas, haremos las traducciones a los otros idiomas disponibles dentro de la App de Campeche360, contar&aacute; con soporte t&eacute;cnico para el manejo de su negocio dentro de Campeche360. Para cualquier pregunta el cuanto al costo, por favor cont&aacute;ctenos a trav&eacute;s de esta p&aacute;gina web, correo electr&oacute;nico o tel&eacute;fono.</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </section>
            <!-- End Carousel Area -->

            <div style="background-color:#fff; z-index: 100; height:40px;" ></div>

            <div style="height:1px; background-color:#000;"></div>

            <footer class="page-footer font-small blue pt-4" style="background-color:#ffbb33; color:#fff;  position:absolute;  width: 100%;" >

                <!-- Footer Links -->
                <div class="container-fluid text-center text-md-left">

                    <!-- Grid row -->
                    <div class="row">

                        <!-- Grid column -->

                        <div class="col-md-6 mt-md-0 mt-3">

                            <!-- Content -->
                            <h5 class="text-uppercase">Campeche 360</h5>
                            <p>Administrador de contenidos campeche 360</p>

                        </div>
                        <!-- Grid column -->

                        <hr class="clearfix w-100 d-md-none pb-3">

                        <!-- Grid column -->
                        <div class="col-md-3 mb-md-0 mb-3">

                            <!-- Links -->
                            <h5 class="text-uppercase">Links</h5>

                            <ul class="list-unstyled">
                                <li>
                                    <a href="#!">Link 1</a>
                                </li>
                                <li>
                                    <a href="#!">Link 2</a>
                                </li>
                            </ul>

                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 mb-md-0 mb-3">

                            <!-- Links -->
                            <h5 class="text-uppercase">Links</h5>

                            <ul class="list-unstyled">
                                <li>
                                    <a href="#!">Link 1</a>
                                </li>
                                <li>
                                    <a href="#!">Link 2</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Grid column -->

                    </div>
                    <!-- Grid row -->

                </div>
                <!-- Footer Links -->

                <!-- Copyright -->
                <div class="footer-copyright text-center py-3">&#169; 2018 Derechos Reservados:</br>
                    <a href="http://www.ipn.mx/Paginas/inicio.aspx">Institito Politecnico Nacional</a>
                </div>
                <!-- Copyright -->

            </footer>	
        </div>
        <script src="js/vendor/jquery-2.2.4.min.js"></script>



        <script src="js/owl.carousel.min.js"></script>
        <script src="js/jquery.nice-select.min.js"></script>
        <script src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>
