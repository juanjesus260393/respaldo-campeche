<?php
session_start();
include '../includes/header2.php';
require_once('../scripts/Validaciones.php');
$na = new validacion();
$idro = $na->registros_publicidad();
?>


<script>
    $(document).ready(function () {
        $('#adFoBmodal').modal("show");
        $('#adFoBmodal').on('hidden.bs.modal', function () {
            document.location.href = '../Controller/crtcFlyers.php';
        });
    });

</script>
<div class="modal" id="adFoBmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="../Controller/crtAdpublicidad.php" name="form1" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel" >Agregar Flyer o Banner</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <center><h4>Llenar los campos que contienen un * al inicio de los campos</h4></center>  
                        <script type="text/javascript" src="../scripts/Comprobaciones.js"></script>   
                        <div>
                            <!-- Para realiza el registro se envia el identificador de la empresa como oculto -->
                            <span><input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp'];
?>"></span>
                        </div>
                        <div class="col-12">
                            <!-- radio button del tipo flyer -->
                            <input class="col-2" type="radio" name="tipo" id="flyer" value="F" onclick="habilitar(this)" required>
                            <label class="col-1" for="correo">Flyer</label>
                            <!-- imagen del flyer la cual tiene la validicion de las dimensiones que tiene que tener este tipo de elementos -->
                            <input class="col-8" type="file" name="flyer" accept=".jpg" onchange= "ValidarImagenf(this)" disabled="true">
                        </div>
                        <div class="col-12">
                            <!-- radio button del tipo banner -->
                            <input class="col-2" type="radio" name="tipo" id="banner" value="B" onclick="habilitar(this)" required>
                            <label class="col-1" for="telefono">Banner</label>
                            <!-- imagen del banner la cual tiene la validicion de las dimensiones que tiene que tener este tipo de elementos -->
                            <input class="col-8" type="file" name="banner" onchange= "ValidarImagenb(this)" accept=".jpg"disabled="true" >
                        </div>
                        <div class="col-12">
                            <!-- Pagina del evento contiene validacion de la estructura de la url a registrar -->
                            <label class="col-3">*Pagina del evento:</label>
                            <input class="col-8" type="text" id="url_sitio" style="WIDTH: 500px" 
                                         size=32 name="url_sitio" placeholder="url_sitio" onblur = "ValidURL();" maxlength="200" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <!-- En el boton registrar se encuentra una alerta para validar que efectivamente se quiere registrar la publicidad-->
                    <input type="submit" class="btn btn-primary"
                           onclick="if (!confirm('Estas seguro que quieres registrar esta publicidad?')) {
                                       return false;
                                   }" value="Registrar Publicidad">
                </div>
            </form>
        </div>
    </div>
</div>       
<script>
    $("#adFoBmodal").on('show.bs.modal', function () {
        $.ajax({
            type: "POST",
            url: "tupagina.php",
            data: {nombre: "El fego", numero: 20}
        }).done(function (msg) {
            alert("Los datos que se recibieron: " + msg);
        });
    });
</script>