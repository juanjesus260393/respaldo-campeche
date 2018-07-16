<!DOCTYPE html>
<html lang="es">
    <head>
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
    </center> 
</body>
</html>
