<?php
session_start();
require_once('../scripts/Validaciones.php');
$na = new validacion();
$idro = $na->registros_paquete();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Proyecto Campeche 360</title>
        <script type="text/javascript" src="../scripts/Comprobaciones.js"></script>
    </head>
    <body>
    <center><h2>Llenar los campos que contienen un * al inicio de los campos</h2></center>  
    <center><h1>Agregar Paquete</h1></center>
    <center><form method="post" action="../Controller/crtcaPaquete.php" name="form1" enctype="multipart/form-data">
            <div>
                <span><input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp'];
?>"></span>
            </div>
            <div>
                <span><label>*Nombre del Paquete:</label></span>
                <span><input type="text" id="nombre" name="nombre" placeholder="Titulo del paquete" maxlength="44" required></span>
            </div>  
            <div>
                <span><label>*Descripcion:</label></span>
                <span><textarea  id="descripcion" name="descripcion" rows="10" cols="40" placeholder="Descripcion Larga" maxlength="44" required></textarea></span>
            </div> 
            <div>
                <span><input type="submit" onclick="if (!confirm('Estas seguro que quieres registrar este paquete')) {
                            return false
                        }" value="Registrar Paquete" ></span>
            </div>
        </form></center>
</body>
</html>