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
                <span><input type="text" id="titulo" name="titulo" placeholder="Titulo del video" required></span>
            </div> 
            <div>
                <span><label>*Descripcion:</label></span>
                <span><textarea  id="descripcion" name="descripcion" rows="10" cols="40" placeholder="Descripcion" required></textarea></span>
            </div> 
            <div>
                <span><label>*Precio:</label></span>
                <span><input type="number" id="precio" name="precio" placeholder="precio"required></span>
            </div>
            <div>
                <span><label>*Imagen del video:</label></span>
                <span><input type="file"  id="id_img_preview" accept=".jpg" name="id_img_preview" required></span>
            </div>
            <div>
                <span><label>*Video:</label></span>
                <span><input type="file" onchange= "confirmar()" accept=".mp4" id="id_video_archivo"  name="id_video_archivo" required></span>
            </div>
            <div>
                <span><input type="submit" onclick="if (!confirm('Estas seguro que quieres registrar este video?')) {
                            return false
                        }" value="Registrar Video" ></span>
            </div>
        </form></center>
</body>
</html>