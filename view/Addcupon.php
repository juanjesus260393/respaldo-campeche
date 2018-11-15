<?php
session_start();
include '../includes/header2.php';
?>
<?php
require_once('../scripts/Validaciones.php');
$na = new validacion();
$idro = $na->registros_cupon();
?>

<script>
    $(document).ready(function () {
        $('#adcuponmodal').modal("show");
        $('#adcuponmodal').on('hidden.bs.modal', function () {
            document.location.href = '../Controller/crtCupones.php';
        });
    });

</script>

<div class="modal" id="adcuponmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="../Controller/crtAdcupon.php" name="form1" enctype="multipart/form-data">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel" style="text-align: center;">Agregar Cupon</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <script type="text/javascript" src="../scripts/Comprobaciones.js"></script>
                        <center><h4>Llenar los campos que contienen un * al inicio de los campos</h4></center>  

                        <center>
                            <div class="col-12">
                                <!-- Para realiza el registro se envia el identificador de la empresa como oculto -->
                                <span><input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp']; ?>"></span>
                            </div>
                            <div>
                                <!-- titulo del cupon -->
                                <label class="col-3" style="background-color:#f1f1f1;">*Titulo del Cupon:</label></span>
                                <input class="col-8" type="text" id="titulo" name="titulo" placeholder="Titulo del Cupon" maxlength="99" oninvalid="alert('Titulo invalido o vacio');" required></span>
                                
                            </div>
                            <div>
                                <!-- Descripcion Corta -->
                                <label class="col-3"style="background-color:#f1f1f1;">*Descripcion Corta:</label>
                                <input class="col-8" type="text" id="descripcion_corta" name="descripcion_corta" placeholder="Descripcion Corta"  maxlength="149" oninvalid="alert('Descripción corta invalida o vacia');" required>
                            </div>   
                            <div>
                                <!-- descripcion_larga -->
                                <label class="col-3" style="background-color:#f1f1f1;" "for="descripcion_larga">*Descripcion Larga:</label>
                                <textarea class="col-8" id="descripcion_larga" name="descripcion_larga" rows="8" cols="40" placeholder="Descripcion Larga" maxlength="490" oninvalid="alert('Descripción larga invalida o vacia');" required></textarea>
                            </div>
                            <div>
                                 <!-- Imagen Vista Previa la cual contiene la validacion para el tamaño de la misma -->
                                <label class="col-3" style="background-color:#f1f1f1;">*Imagen Vista Previa:</label>
                                <input class="col-8" type="file"  id="id_imagen_vista_previa" onchange= "ValidarImagenc(this)" accept=".jpg" name="id_imagen_vista_previa" oninvalid="alert('Es necesario seleccionar una imagen');" required>
                            </div>
                            <div>
                                <!-- Imagen Del Cupon la cual contiene la validacion para el tamaño de la misma -->
                                <label class="col-3" style="background-color:#f1f1f1;">Imagen Del Cupon:</label>
                                <input class="col-8" type="file" id="id_imagen_extra" onchange= "ValidarImagenvp(this)" accept=".jpg" name="id_imagen_extra">
                            </div>
                            <div>
                                <!-- Vigencia inicio-->
                                <label class="col-3" style="background-color:#f1f1f1;">*Vigencia inicio:</label>
                                <input class="col-8" type="date" id="vigencia_inicio"  name="vigencia_inicio" value="<?php echo date('Y-m-d'); ?>">    </div>
                            <div>
                                <!-- Vigencia fin -->
                                <label class="col-3" style="background-color:#f1f1f1;">*Vigencia fin:</label>
                                <input class="col-8" type="date" id="vigencia_fin" name="vigencia_fin" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div>
                                 <!-- Terminos y Condiciones -->
                                <label class="col-3" style="background-color:#f1f1f1;">*Terminos y Condiciones:</label>
                                <textarea class="col-8" id="terminos_y_condiciones" name="terminos_y_condiciones" rows="8" cols="40" placeholder="Terminos y condiciones" maxlength="240" oninvalid="alert('Terminos y condiciones invalido o vacio');" required></textarea>
                            </div>
                            <div>
                                 <!-- Limite de cupones-->
                                <label class="col-3" style="background-color:#f1f1f1;">*Limite de cupones:</label>
                                <input class="col-8" type="number" id="limite_codigos" name="limite_codigos" min="1" max="99" oninvalid="alert('Limite de cupones debe ser entre 1 - 99');" required>
                            </div>
                            <div>

                                <span>
                                </span>
                            </div>
                        </center>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   <!-- En el boton registrar se encuentra una alerta para validar que efectivamente se quiere registrar el cupon-->
                    <input type="submit" class="btn btn-primary"
                           onclick="if (!confirm('Estas seguro que quieres registrar este cupon?')) {
                                       return false;
                                   }" value="Registrar Cupon" >
                </div>
            </form>
        </div>
    </div>
</div>            