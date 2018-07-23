<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta charset="UTF-8" />
        <title>Administracion de Contenido</title>
    </head>
    <body>
        <?php
        $nam = $_GET['name'];
        ?>
    <center><?php echo"<h1>Contenido que puedes administrar de $nam</h1>" ?></center> 
    <center>
        <?php echo "<li><a href='../Controller/crtCupones.php'>Cupones</a>   <a href='../view/Addcupon.php'><img src='../Controller/img/agregar.png'/>Agregar Cupon</a></li> " ?>
        <?php echo "<li><a href='../Controller/crtcVideos.php'>Videos</a>   <a href='../view/Addvideo.php'><img src='../Controller/img/agregar.png'/>Agregar video</a></li>" ?>
        <?php echo "<li><a href='../Controller/crtcPaquetes.php'>Paquetes</a>   <a href='../view/Addpaquete.php'><img src='../Controller/img/agregar.png'/>Agregar Paquete</a></li>" ?>
        <?php echo "<li><a href='../Controller/crtcFlyers.php'>Flyers y Banners</a>   <a href='../view/Addflyerybanner.php'><img src='../Controller/img/agregar.png'/>Agregar Flyer o Banner</a></li>" ?>
         <?php echo "<li><a href='../Controller/crtcFlyers.php'>Visualizacion de Estadisticas de canjeo de Cupones</a></li>" ?>
               <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalFlyer">Que es un Flyer???</button>
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalBanner">Que es un Banner???</button>
        <!-- Modal Flyer -->
        <div class="modal fade" id="modalFlyer" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Un Flyer es:</h4>
                    </div>
                    <div class="modal-body">
                        <p>Es una pubicidad gráfica de tamaño mediano, utilizada para promocionar un producto o servicio a continuacion se muestra un ejemplo.</p>
                        <img src="../Imagenes/flyer.jpg" class="img-responsive" width="152" height="118">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Modal Banner -->
        <div class="modal fade" id="modalBanner" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Un Banner es:</h4>
                    </div>
                    <div class="modal-body">
                        <p>Es un formato publicitario digital la cual se incluye dentro de una pagina web o aplicacion, la cual tiene como objetivo es atraer tráfico hacia el sitio web o aplicacion del anunciante. a continuacion se muestra el ejemplo de uno.</p>
                        <img src="../Imagenes/banner.png" class="img-responsive" width="304" height="236">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
    </center> 
</body>
</html>
