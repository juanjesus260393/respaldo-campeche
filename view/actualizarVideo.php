<?php session_start(); ?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
    <title>Proyecto Campeche 360</title>
</head>

<?php list($id_video, $id_revision_objeto, $titulo, $descripcion, $precio, $id_img_preview, $id_video_archivo) = $video ?>
<center><h2>Llenar los campos que contienen un * al inicio de los campos</h2></center>  
<center><h1>Actualizar Video</h1></center>
<center><form method="post" action="../Controller/crtacVideo.php" name="form1" enctype="multipart/form-data">
        <div>

            <span><label>Identificador de la empresa:</label></span>
            <span><input type="text" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp'];
?>"></span>
        </div>
        <div>
            <span><label>Identificador del video</label></span>
            <span><input type="text" name="id_video" id="id_cupon" value="<?php echo $id_video;
?>"></span>
        </div>
        <div>
            <span><label>Registro del video</label></span>
            <span><input type="text" name="id_revision_objeto" id="id_revision_objeto" value="<?php echo $id_revision_objeto;
?>"></span>
        </div>
        <div>
            <span><label>*Titulo del video:</label></span>
            <span><input type="text" id="titulo" name="titulo" value="<?php echo $titulo;
?>" maxlength="99" required></span>
        </div>
        <div>
            <span><label>*Descripcion:</label></span>
            <span><input type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" maxlength="499" required></span>
        </div>   
        <div>
            <span><label>*Precio:</label></span>
            <span><input type="number" id="precio" name="precio" value="<?php echo $precio;
?>" maxlength="6" required></span>
        </div> 
        <div>
            <span><label>Imagen:</label></span>
            <span><input type="file" id="id_img_preview" accept=".jpg" name="id_img_preview" required></span>
            <span><label>Nombre anterior de la imagen:</label></span>
            <span><input type="text" id="id_img_preview" name="id_imagen_anterior" value="<?php echo $id_img_preview;
?>"></span>
        </div>
        <div>
            <span><label>Video:</label></span>
            <span><input type="file" id="id_video_archivo" accept=".mp4" name="id_video_archivo" required></span>
            <span><label>Nombre anterior del video</label></span>
            <span><input type="text" id="id_video_archivo" name="id_video_antetior" value="<?php echo $id_video_archivo;
?>"></span>
        </div>
        <div>
            <span><input type="submit" onclick="if (!confirm('Estas seguro que quieres actualizar el contenido de este video?')) {
                        return false
                    }" value="Actualizar Video" ></span>
        </div>
    </form></center>



