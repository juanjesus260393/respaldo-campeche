<?php
session_start();
include '../includes/header2.php';
require_once('../scripts/Validaciones.php');
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
    <title>Proyecto Campeche 360</title>
    <script type="text/javascript" src="../scripts/Comprobaciones.js"></script>
</head>
<?php list($id_video, $id_revision_objeto, $titulo, $descripcion, $duracion, $id_img_preview, $id_video_archivo) = $video ?>
<center><h2>Llenar los campos que contienen un * al inicio de los campos</h2></center> 
<center><h1>Actualizar Video</h1></center>
<center><form method="post" action="../Controller/crtacVideo.php" name="form1" enctype="multipart/form-data">
        <div>
            <!-- identificador de la empresa que se envia como oculto-->
            <span><input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp'];
?>"></span>
        </div>
        <div>
            <!-- identificador del video que se envia como oculto-->
            <span><input type="hidden" name="id_video" id="id_cupon" value="<?php echo $id_video;
?>"></span>        </div>
        <div>
            <!-- identificador del registro del video que se envia como oculto-->
            <span><input type="hidden" name="id_revision_objeto" id="id_revision_objeto" value="<?php echo $id_revision_objeto;
?>"></span>
        </div>
        <div>
            <!-- duracion del video se envia como oculto-->
            <span><input type="hidden" name="duracionanterior" id="duracionanterior" value="<?php echo $duracion;
?>"></span>
        </div>
        <div>
            <!-- Titulo del video que se obtiene previamente -->
            <span><label>*Titulo del video:</label></span>
            <span><input type="text" id="titulo" name="titulo" value="<?php echo $titulo;
?>" maxlength="99" required></span>
        </div>
        <div>
             <!-- Descripcion del video que se obtiene previamente -->
            <span><label>*Descripcion:</label></span>
            <span><input type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" maxlength="499" required></span>
        </div>   
        <div>
             <!-- Nueva imagen del video -->
            <span><label>Imagen:</label></span>
            <span><input type="file" id="id_img_preview" onchange= "ValidarImagenvp(this)" accept=".jpg" name="id_img_preview"></span>
             <!-- Imagen del video que se obtiene previamente -->
            <span><label>Imagen Anterior:</label></span>
            <?php echo ('<span><img src="../Imagenes/Videos/' . $id_img_preview . '.jpg"/ width="152" height="118"></span>'); ?>
            <span><input type="hidden" id="idimagenanterior" name="idimagenanterior" value="<?php echo $id_img_preview;
            ?>"></span>
        </div>
        <div>
             <!-- Nuevo video -->
            <span><label>Video:</label></span>
            <span><input type="file" id="id_video_archivo" accept=".mp4" name="id_video_archivo" ></span>
             <!-- Video que se obtiene previamente -->
            <span><label>Video Anterior</label></span>
            <video width="320" height="240" controls> 
                <source src="../Videos/<?php echo $id_video_archivo; ?>.mp4" type="video/mp4"> 
            </video>
            <span><input type="hidden" id="id_video_archivo" name="id_video_antetior" value="<?php echo $id_video_archivo;
            ?>"></span>
        </div>
        <div>
            <!-- En el boton registrar se encuentra una alerta para validar que efectivamente se quiere actualizar el video -->
            <span><input type="submit" onclick="if (!confirm('Estas seguro que quieres actualizar el contenido de este video?')) {
                        return false
                    }" value="Actualizar Video" ></span>
        </div>
    </form></center>



<?php
include '../includes/footer.php';
?>

