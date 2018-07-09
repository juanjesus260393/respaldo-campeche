<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Proyecto Campeche 360</title>
        <script type="text/javascript" src="../scripts/Comprobaciones.js"></script>
    </head>
    <body>
    <center><h1>Agregar Cupon</h1></center>
    <center><form method="post" action="../Controller/crtAdcupon.php" name="form1" enctype="multipart/form-data">
            <div>

                <span><label>Identificador de la empresa:</label></span>
                <?php
                $id_empresa = $_GET['id_empresa'];
                $idextra = $id_empresa;
                ?>
                <span><input type="text" name="id_empresa" id="id_empresa" value="<?php echo $idextra;
                ?>"></span>
            </div>
            <div>
                <span><label>*Titulo del Cupon:</label></span>
                <span><input type="text" id="titulo" name="titulo" placeholder="Titulo del Cupon" pattern=".{1,100}" required title="El titulo de cupon no puede ser mayor a 100 caracteres incluyendo espacios en blanco"></span>
            </div>
            <div>
                <span><label>*Descripcion Corta:</label></span>
                <span><input type="text" id="descripcion_corta" name="descripcion_corta" placeholder="Descripcion Corta"  pattern=".{1,150}" required title="La descripcion no puede ser mayor a 150 caracteres incluyendo espacios en blanco"></span>
            </div>   
            <div>
                <span><label>*Descripcion Larga:</label></span>
                <span><textarea  id="descripcion_larga" name="descripcion_larga" rows="10" cols="40" placeholder="Descripcion Larga" required title="La cantidad de caracteres maxima es de 500" maxlength="490"></textarea></span>
            </div> 
            <div>
                <span><label>Imagen:</label></span>
                <span><input type="file" id="id_imagen_extra" name="id_imagen_extra"></span>
            </div>
            <div>
                <span><label>*Vigencia inicio:</label></span>
                <span><input type="date" id="vigencia_inicio" name="vigencia_inicio" value="<?php echo date('Y-m-d'); ?>"</span>
            </div>
            <div>
                <span><label>*Vigencia fin:</label></span>
                <span><input type="date" id="vigencia_fin" name="vigencia_fin" value="<?php echo date('Y-m-d'); ?>"</span>
            </div>
            <div>
                <span><label>*Terminos y Condiciones:</label></span>
                <span><textarea id="terminos_y_condiciones" name="terminos_y_condiciones" rows="10" cols="40" placeholder="Terminos y condiciones" maxlength="240"></textarea></span>
            </div>
            <div>
                <span><label>*Limite de cupones:</label></span>
                <span><input id="limite_codigos" name="limite_codigos" rows="10" cols="40" placeholder="Cantidad de cupones" pattern=".{1,2}" required title="La cantidad de cupones no puede ser mayor a dos digitos"></span>
            </div>
            <div>
                <span><input type="submit" onclick="if (!confirm('Estas seguro que quieres registrar este cupon?')) { return false }" value="Registrar Cupon" ></span>
            </div>
        </form></center>
</body>
</html>