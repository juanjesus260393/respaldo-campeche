<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/bootstrap-grid.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>


        <title>Proyecto Campeche 360</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!--  jquery plguin -->
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <!--start manu -->
        <link href="../css/flexy-menu.css" rel="stylesheet">
        <link href="../css/menu.css" rel="stylesheet">
    </head>
    <body>
        <?php
        //Se manda a llamar a la clase validaciones para verificar el estado de la empresa
        require_once ("../Model/conexion.php");
        require_once("../scripts/Validaciones.php");
        $val = new validacion ();
        //Se llama al metodo habilitado
        //$estatus = $val->habilitado($ena);
        //echo $_SESSION['id_membresia'];
        ?>
        <!-- Se recibe el nombre de usuario debido a que las opciones cambiaran dependiendo del tipo de usuario--> 
        <!-- Funcion para habilitar un div si el tipo de usuario es empresa o administrador--> 
        <div id = "tipo_usuario"> 
            <?php $estatus = $val->mostrar_ocultar(); ?>
        </div>
        <div> 
            <div class="content">
                <div class="main">
                    <div class="grids">
                        <ul class="list">
                            <div class="grid_info">
                                <ul class="menu">
                                    <li> <center><a><strong>Bienvenidos</strong></a></center>
                                    <ul>
                                        <li><p align="justify">La aplicación Campeche 360 fue creada por el Consejo Coordinador Empresarial especialmente para los visitantes a nuestra identidad y desarrollada para la interacción de las empresas prestadoras de servicios turísticos y complementarias de la ciudad con el fin de ofertar de manera competitiva, eficiente y en tiempo real sus productos al turista. 
                                                Es una valiosa herramienta tecnológica que le da un gran poder al usuario para disfrutar a plenitud de todos los atractivos turísticos durante su estadía, para su goce y satisfacción. 
                                                Le invito a disfrutar de la experiencia del App Campeche 360 y vivir campechanamente un tiempo excepcional en nuestra ciudad de San Francisco de Campeche, Patrimonio Cultural de la Humanidad. <br>
                                            <br></li>    
                                    </ul>
                                    </li> 
                                    <li><center><a><strong>NOSOTROS</strong></a></center>
                                    <ul>
                                        <li>
                                            <p align="justify">Campeche 360 es una aplicación creada para ayudar al turista a planear la mejor ruta dentro de San Francisco de Campeche con la finalidad de tener la mejor experiencia dentro de la ciudad amurallada disfrutando de las atracciones turísticas, de entretenimiento, así como fuera de la ciudad en la zona arqueológica; de igual manera los usuarios de Campeche 360 podrá contar con información, descuentos y ofertas de los mejores prestadores de servicios Campechanos tanto en restaurantes, hoteles como en comercios. No olvide checar el área de “cupones” seguro hay uno para sus necesidades.<br><br></li>
                                    </ul>
                                    <li>  <center><a><strong>Membresias</strong></a></center>
                                    <ul>
                                        <li> <br><span class="Estilo5">Membresia 360</span>
                                            <p align="justify">Al contratar este paquete de servicio de forma anual, usted contará con la afiliación por un año en la Camara del Consejo Empresarial de Campeche, así como de la cámara a la cual pertenezca su giro de servicio. Adicionalmente la ubicación de su negocio dentro de los atractivos turísticos de la aplicación con la alta descripción del giro de su empresa, posibilidades de hacer campañas de Marketing personalizadas, tener reportes de visitantes a su negocio, la evaluación de sus servicios de manera inmediata, dinamismo de manejo de publicidad de su negocio. Con la adición de soporte técnico para el mantenimiento de su negocio en la aplicación de Campeche 360. Para cualquier pregunta el cuanto al costo, por favor contáctenos a través de esta página web, correo electrónico o teléfono.<br><br>
                                                <span class="Estilo5">Membresia premium</span>
                                            <p align="justify">El plan oro le permite a su negocio tener acceso a la aplicación a través de las ubicaciones en forma de un pin dentro del mapa de la ciudad, Ud. podrá tener hasta cinco imágenes para publicidad de la aplicación, hacer la descripción corta y una larga de su tipo de servicio, así como la especialidad de su negocio, podrá hacer publicidad de eventos, llevar un registro de la evaluación de sus servicios de forma inmediata, crear cupones de descuentos, creación de campañas de Marketing especializadas, haremos las traducciones a los otros idiomas disponibles dentro de la App de Campeche360, contará con soporte técnico para el manejo de su negocio dentro de Campeche360. Para cualquier pregunta el cuanto al costo, por favor contáctenos a través de esta página web, correo electrónico o teléfono<br></li>
                                    </ul>
                                    </li>
                                </ul>
                            </div>	
                            <div class="clear"></div><br>
                        </ul>
                        </ul>
                    </div>
                </div>
                <div class="clear"></div>	
            </div>
            <div class="clear"></div>	
            <!-- end main_content -->
        </div>
    </div>

</body>
</html>