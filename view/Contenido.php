<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Administracion de Contenido</title>
    </head>
    <body>
        <?php  
$id=$_GET['ide'];
$nam=$_GET['name'];
$array = array("Cupones", "Videos", "Audio Guias");
?>
    <center><?php echo"<h1>Contenido que puedes administrar de $nam</h1>"?></center> 
    <center>
         <?php echo "<a href='../Controller/crtCupones.php?ide=$id'>Cupones</a> " ?>
         <?php echo "<a href='../view/Addcupon.php?id_empresa=$id'><img src='../Controller/img/agregar.png'/></a>" ?>
    </center> 
</body>
</html>
 