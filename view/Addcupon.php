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
                            <div>
                                <!-- Para realiza el registro se envia el identificador de la empresa como oculto -->
                                <span><input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp']; ?>"></span>
                            </div>
                            <div>
                                <!-- titulo del cupon -->
                                <span><label>*Titulo del Cupon:</label></span>
                                <span><input type="text" id="titulo" name="titulo" placeholder="Titulo del Cupon" maxlength="99" oninvalid="alert('Titulo invalido o vacio');" required></span>
                                
                            </div>
                            <div>
                                <!-- Descripcion Corta -->
                                <span><label>*Descripcion Corta:</label></span>
                                <span><input type="text" id="descripcion_corta" name="descripcion_corta" placeholder="Descripcion Corta"  maxlength="149" oninvalid="alert('Descripción corta invalida o vacia');" required></span>
                            </div>   
                            <div>
                                <!-- descripcion_larga -->
                                <span><label for="descripcion_larga">*Descripcion Larga:</label></span>
                                <span><textarea  id="descripcion_larga" name="descripcion_larga" rows="8" cols="40" placeholder="Descripcion Larga" maxlength="490" oninvalid="alert('Descripción larga invalida o vacia');" required></textarea></span>
                            </div>
                            <div>
                                 <!-- Imagen Vista Previa la cual contiene la validacion para el tamaño de la misma -->
                                <span><label>*Imagen Vista Previa:</label></span>
                                <span><input type="file"  id="id_imagen_vista_previa" onchange= "ValidarImagenc(this)" accept=".jpg" name="id_imagen_vista_previa" oninvalid="alert('Es necesario seleccionar una imagen');" required></span>
                            </div>
                            <div>
                                <!-- Imagen Del Cupon la cual contiene la validacion para el tamaño de la misma -->
                                <span><label>Imagen Del Cupon:</label></span>
                                <span><input type="file" id="id_imagen_extra" onchange= "ValidarImagenvp(this)" accept=".jpg" name="id_imagen_extra"></span>
                            </div>
                            <div>
                                <!-- Vigencia inicio-->
                                <span><label>*Vigencia inicio:</label></span>
                                <span><input type="date" id="vigencia_inicio"  name="vigencia_inicio" value="<?php echo date('Y-m-d'); ?>"></span>    </div>
                            <div>
                                <!-- Vigencia fin -->
                                <span><label>*Vigencia fin:</label></span>
                                <span><input type="date" id="vigencia_fin" name="vigencia_fin" value="<?php echo date('Y-m-d'); ?>"></span>
                            </div>
                            <div>
                                 <!-- Terminos y Condiciones -->
                                <span><label>*Terminos y Condiciones:</label></span>
                                <span><textarea id="terminos_y_condiciones" name="terminos_y_condiciones" rows="8" cols="40" placeholder="Terminos y condiciones" maxlength="240" oninvalid="alert('Terminos y condiciones invalido o vacio');" required></textarea></span>
                            </div>
                            <div>
                                 <!-- Limite de cupones-->
                                <span><label>*Limite de cupones:</label></span>
                                <span><input type="number" id="limite_codigos" name="limite_codigos" min="1" max="99" oninvalid="alert('Limite de cupones debe ser entre 1 - 99');" required></span>
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