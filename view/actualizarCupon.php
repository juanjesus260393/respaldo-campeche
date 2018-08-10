<?php


include '../includes/header2.php';


?>
     
    <center><h2>Llenar los campos que contienen un * al inicio de los campos</h2></center>   

    <center><h1>Actualizar Cupon</h1></center>
    <center><form method="post" action="../Controller/crtacCupon.php" name="form1" enctype="multipart/form-data">
            <div>
                <span><input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp'];
        ?>" required></span>
            </div>
            <div>
                <span><input type="hidden" name="id_cupon" id="id_cupon" value="<?php echo $id_cupon;
        ?>" required></span>
            </div>
            <div>
                <span><input type="hidden" name="id_revision_objeto" id="id_revision_objeto" value="<?php echo $id_revision_objeto;
        ?>" required></span>
            </div>
            <div>
                <span><label>*Titulo del Cupon:</label></span>
                <span><input type="text" id="titulo" name="titulo" value="<?php echo $titulo;
        ?>" maxlength="99" required></span>
            </div>
            <div>
                <span><label>*Descripcion Corta:</label></span>
                <span><input type="text" id="descripcion_corta" name="descripcion_corta" value="<?php echo $descripcion_corta;
        ?>" maxlength="149" required></span>
            </div>   
            <div>
                <span><label>*Descripcion Larga:</label></span>
                <span><input  id="terminos_y_condiciones" id="descripcion_larga" name="descripcion_larga" size="35" style="WIDTH: 228px; HEIGHT: 98px" value="<?php echo $descripcion_larga;
        ?>"  maxlength="490" required></span>
            </div> 
            <div>
                <span><label>*Imagen Vista Previa:</label></span>
                <span><input type="file" id="id_imagen_vista_previa" accept=".jpg" name="id_imagen_vista_previa" ></span>
                <span><input type="hidden" id="id_imagen_anterior" name="id_imagen_anterior" value="<?php echo $id_imagen_vista_previa;
        ?>"></span>
            </div>
            <div>
                <span><label>Imagen del cupon</label></span>
                <span><input type="file" id="id_imagen_extra" accept=".jpg" name="id_imagen_extra" ></span>
                <span><input type="hidden" id="id_imagen_anterior2" name="id_imagen_anterior2" value="<?php echo $id_imagen_extra;
        ?>"></span>
            </div>
            <div>
                <span><label>*Vigencia inicio:</label></span>
                <span><input type="date" id="vigencia" name="vigencia_inicio" value="<?php echo date('Y-m-d'); ?>" required></span>
            </div>
            <div>
                <span><label>*Vigencia fin:</label></span>
                <span><input type="date" id="vigencia" name="vigencia_fin" value="<?php echo date('Y-m-d'); ?>" required></span>
            </div>
            <div>
                <span><label>*Terminos y Condiciones:</label></span>
                <span><input  id="terminos_y_condiciones" name="terminos_y_condiciones" size="35" style="WIDTH: 228px; HEIGHT: 98px" value="<?php echo $terminos_y_condiciones;
        ?>" maxlength="240" required></span>
            </div>
            <div>
                <span><label>*Cantidad de cupones:</label></span>
                <span><input title="Agrega una descripcion no mayor a 150 caracteres"  type="text" id="limite_codigos" name="limite_codigos" value="<?php echo $limite_codigos;
        ?>" maxlength="2" required></span>
            </div> 
            <div>
                <span><input type="submit" onclick="if (!confirm('Estas seguro que quieres actualizar este cupon?')) {
                            return false
                        }" value="Actualizar Cupon" ></span>
            </div>
        </form></center>
<?php


include '../includes/footer.php';


?>
