<?php

include '../includes/header2.php';

?>
<!-- Array con los elementos obtenidos de la funcion obtener cupon-->
     <?php list($id_cupon, $id_revision_objeto, $titulo, $descripcion_corta, $descripcion_larga, $id_imagen_extra, $id_imagen_vista_previa,$vigencia_inicio,$vigencia_fin,$terminos_y_condiciones, $limite_codigos) = $secupon ?>
    <center><h2>Llenar los campos que contienen un * al inicio</h2></center>   
        <script type="text/javascript" src="../scripts/Comprobaciones.js"></script>
    <center><h1>Actualizar Cupon</h1></center>
    <center><form method="post" action="../Controller/crtacCupon.php" name="form1" enctype="multipart/form-data">
            <div>
                <!-- identificador de la empresa que se envia como oculto-->
                <span><input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp'];
        ?>" required></span>
            </div>
            <div>
                <!-- identificador del cupon que se envia como oculto-->
                <span><input type="hidden" name="id_cupon" id="id_cupon" value="<?php echo $id_cupon;
        ?>" required></span>
            </div>
            <div>
                <!-- identificador del registro del cupon que se envia como oculto-->
                <span><input type="hidden" name="id_revision_objeto" id="id_revision_objeto" value="<?php echo $id_revision_objeto;
        ?>" required></span>
            </div>
            <div>
                <!-- Titulo del cupo que se obtiene previamente -->
                <span><label>*Titulo del Cupon:</label></span>
                <span><input type="text" id="titulo" name="titulo" value="<?php echo $titulo;
        ?>" maxlength="99" required></span>
            </div>
            <div>
                <!-- Descripcion Corta que se obtiene previamente -->
                <span><label>*Descripcion Corta:</label></span>
                <span><input type="text" id="descripcion_corta" name="descripcion_corta" value="<?php echo $descripcion_corta;
        ?>" maxlength="149" required></span>
            </div>   
            <div>
                <!-- Descripcion Larga que se obtiene previamente -->
                <span><label>*Descripcion Larga:</label></span>
                <span><input  id="terminos_y_condiciones" id="descripcion_larga" name="descripcion_larga" size="35" style="WIDTH: 228px; HEIGHT: 98px" value="<?php echo $descripcion_larga;
        ?>"  maxlength="490" required></span>
            </div> 
            <div>
                <!-- Imagen Vista Previa contiene validacion de resolucion de la imagen -->
                <span><label>*Imagen Vista Previa:</label></span>
                <span><input type="file" id="id_imagen_vista_previa" onchange= "ValidarImagenc(this)" accept=".jpg" name="id_imagen_vista_previa" ></span>
                <!-- Imagen Vista Previa que se obtiene previamente -->
                <span><label>Imagen Vista Previa Anterior:</label></span>
                <?php echo ('<span><img src="../Imagenes/Cupones/VistaPrevia/' . $id_imagen_vista_previa . '.jpg"/ width="152" height="118"></span>'); ?>
                <span><input type="hidden" id="id_imagen_anterior" name="id_imagen_anterior" value="<?php echo $id_imagen_vista_previa;
                ?>" required=></span>
            </div>
            <div>
                <!-- Imagen del cupon contiene validacion de resolucion de la imagen -->
                <span><label>Imagen del cupon</label></span>
                <span><input type="file" id="id_imagen_extra" onchange= "ValidarImagenvp(this)" accept=".jpg" name="id_imagen_extra" ></span>
                <!-- Imagen del cupon Anterior que se obtiene previamente --> 
                <span><label>Imagen del cupon Anterior:</label></span>
                <?php echo ('<span><img src="../Imagenes/Cupones/' . $id_imagen_extra . '.jpg"/ width="152" height="118"></span>'); ?>
                <span><input type="hidden" id="id_imagen_anterior2" name="id_imagen_anterior2" value="<?php echo $id_imagen_extra;
        ?>"></span>
            </div>
             <div>
                 <!-- Vigencia inicio previa que se obtiene previamente --> 
                <span><label>*Vigencia inicio previa:</label></span>
                <span><input type="text" id="vigencia_in_prev" name="vigencia_in_prev" value="<?php echo $vigencia_inicio; ?>" disabled="true"></span>
            </div>
            <div>
                <!-- nueva vigencia inicio --> 
                <span><label>*Vigencia inicio:</label></span>
                <span><input type="date" id="vigencia" name="vigencia_inicio" value="<?php echo date('Y-m-d'); ?>" required></span>
            </div>
              <div>
                  <!-- Vigencia fin previa que se obtiene previamente --> 
                <span><label>*Vigencia fin previa:</label></span>
                <span><input type="text" id="vigencia_in_prev" name="vigencia_in_prev" value="<?php echo $vigencia_fin; ?>" disabled="true"></span>
            </div>
            <div>
                <!-- nueva vigencia fin --> 
                <span><label>*Vigencia fin:</label></span>
                <span><input type="date" id="vigencia" name="vigencia_fin" value="<?php echo date('Y-m-d'); ?>" required></span>
            </div>
            <div>
                <!-- Terminos y Condiciones que se obtiene previamente -->
                <span><label>*Terminos y Condiciones:</label></span>
                <span><input  id="terminos_y_condiciones" name="terminos_y_condiciones" size="35" style="WIDTH: 228px; HEIGHT: 98px" value="<?php echo $terminos_y_condiciones;
        ?>" maxlength="240" required></span>
            </div>
            <div>
                <!-- Cantidad de cupones previa que se obtiene previamente -->
                <span><label>*Cantidad de cupones:</label></span>
                <span><input title="Agrega una descripcion no mayor a 150 caracteres"  type="text" id="limite_codigos" name="limite_codigos" value="<?php echo $limite_codigos;
        ?>" maxlength="2" required></span>
            </div> 
            <div>
                 <!-- En el boton registrar se encuentra una alerta para validar que efectivamente se quiere actualizar el cupon-->
                <span><input type="submit" onclick="if (!confirm('Estas seguro que quieres actualizar este cupon?')) {
                            return false
                        }" value="Actualizar Cupon" ></span>
            </div>
        </form></center>
<?php


include '../includes/footer.php';


?>
