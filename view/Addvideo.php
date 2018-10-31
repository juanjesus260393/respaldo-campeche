<?php
session_start();
require_once('../scripts/Validaciones.php');
$na = new validacion();
$idro = $na->registros_video();
include '../includes/header2.php';
?>
<script>
    $(document).ready(function () {
        $('#advidmodal').modal("show");
        $('#advidmodal').on('hidden.bs.modal', function () {
            document.location.href = '../Controller/crtcVideos.php';
        });
    });

</script>

<div class="modal" id="advidmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="../Controller/crtAdvideo.php" name="form1" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel" style="text-align: center;">Agregar Video</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <script type="text/javascript" src="../scripts/Comprobaciones.js"></script>
                        <center><h4>Llenar los campos que contienen un * al inicio de los campos</h4></center>  
                        <div>
                            <!-- Para realiza el registro se envia el identificador de la empresa como oculto -->
                            <span><input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp'];
?>"></span>
                        </div>
                        <div>
                            <!-- Titulo del Video -->
                            <span class="col-3"><label>*Titulo del Video:</label></span>
                            <span class="col-4"><input type="text" id="titulo" name="titulo" placeholder="Titulo del video" maxlength="99" required></span>
                        </div> 
                        <div>
                            <!-- Descripcion del Video -->
                            <span class="col-3"><label for="descripcion">*Descripcion:</label></span>
                            <span class="col-6"><textarea  id="descripcion" name="descripcion" rows="10" cols="40" placeholder="Descripcion" maxlength="499" required></textarea></span>
                        </div> 
                        <div>
                            <!-- Imagen del video contiene la validaciond e la resolucion del video -->
                            <span class="col-3"><label>*Imagen del video:</label></span>
                            <span class="col-4"><input type="file"  onchange= "ValidarImagenvp(this)" id="id_img_preview" accept=".jpg" name="id_img_preview" required></span>
                        </div>
                        <div>
                            <!-- Video contiene la validacion del tamaño del video subido -->
                            <span class="col-3"><label>*Video:</label></span>
                            <span class="col-4"><input type="file" onchange= "confirmar()" accept=".mp4" id="id_video_archivo"  name="id_video_archivo" required></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- En el boton registrar se encuentra una alerta para validar que efectivamente se quiere registrar el video-->
                    <input type="submit" class="btn btn-primary" onclick="if (!confirm('Estas seguro que quieres registrar este video?')) {
                                return false;
                            }" value="Registrar Video" >
                </div>
            </form>
        </div>
    </div>
</div>            


<?php
include '../includes/footer.php';
?>
