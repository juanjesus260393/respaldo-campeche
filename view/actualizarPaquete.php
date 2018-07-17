<?php session_start(); ?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
    <title>Proyecto Campeche 360</title>
</head>

<?php list($idpaquete, $nombre, $descripcion) = $paquete ?>
<center><h2>Llenar los campos que contienen un * al inicio de los campos</h2></center>  
<center><h1>Actualizar Paquete</h1></center>
<center><form method="post" action="../Controller/crtacPaquete.php" name="form1" enctype="multipart/form-data">
        <div>
            <span><input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp'];
?>"></span>
        </div>
        <div>
            <span><input type="hidden" name="id_paquete" id="id_paquete" value="<?php echo $idpaquete;
?>"></span>
        </div>
        <div>
            <span><label>*Nombre del Paquete:</label></span>
            <span><input type="text" id="nombre" name="nombre" value="<?php echo $nombre;
?>" maxlength="44" required></span>
        </div> 
        <div>
            <span><label>*Descripcion:</label></span>
            <span><input type="text" id="descripcion" name="descripcion" size="35" style="WIDTH: 228px; HEIGHT: 98px" value="<?php echo $descripcion;
?>" maxlength="44" required></span>
        </div> 
        <div>
            <span><input type="submit" onclick="if (!confirm('Estas seguro que quieres actualizar el contenido de este paquete?')) {
                        return false
                    }" value="Actualizar Paquete" ></span>
        </div>
    </form></center>




