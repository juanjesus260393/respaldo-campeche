<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Proyecto Campeche 360</title>
        <script type="text/javascript" src="../scripts/Comprobaciones.js"></script>
    </head>
    <body>
    <center><h1>Agregar Video</h1></center>
    <center><form method="post" action="../Controller/crtAdvideo.php" name="form1" enctype="multipart/form-data">
            <div>
                <span><label>Identificador de la empresa:</label></span>
                <span><input type="text" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp'];
?>"></span>
            </div>
            <div>
                <span><label>*Titulo del Video:</label></span>
                <span><input type="text" id="titulo" name="titulo" placeholder="Titulo del Cupon" pattern=".{1,100}" required title="El titulo de cupon no puede ser mayor a 100 caracteres incluyendo espacios en blanco"></span>
            </div> 
            <div>
                <span><label>*Descripcion:</label></span>
                <span><textarea  id="descripcion" name="descripcion" rows="10" cols="40" placeholder="Descripcion" required title="La cantidad de caracteres maxima es de 500" maxlength="490"></textarea></span>
            </div> 
            <div>
                <span><label>*Precio:</label></span>
                <span><input type="number" id="precio" name="precio" placeholder="precio"></span>
            </div>
            <div>
                <span><label>*Imagen del video:</label></span>
                <span><input type="file" id="id_img_preview" name="id_img_preview"></span>
            </div>
            <div>
                <span><label>*Video:</label></span>
                <span><input type="file" id="id_video_archivo" name="id_video_archivo"></span>
            </div>
            <div>
                <span><input type="submit" onclick="if (!confirm('Estas seguro que quieres registrar este video?')) {
                            return false
                        }" value="Registrar Video" ></span>
            </div>
        </form></center>
</body>
</html>