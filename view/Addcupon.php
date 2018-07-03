<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Proyecto Campeche 360</title>
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
                <span><input title="Se necesita el titulo del cupon" type="text" id="titulo" name="titulo" placeholder="Titulo del Cupon" required></span>
            </div>
            <div>
                <span><label>*Descripcion Corta:</label></span>
                <span><input title="Agrega una descripcion no mayor a 150 caracteres"  type="text" id="descripcion_corta" name="descripcion_corta" placeholder="Descripcion Corta"required></span>
            </div>   
            <div>
                <span><label>*Descripcion Larga:</label></span>
                <span><textarea title="Agrega una descripcion no mayor a 500 caracteres" id="descripcion_larga" name="descripcion_larga" rows="10" cols="40" placeholder="Descripcion Larga"required></textarea></span>
            </div> 
            <div>
                <span><label>Imagen:</label></span>
                <span><input type="file" id="id_imagen_extra" name="id_imagen_extra"></span>
            </div>
            <div>
                <span><label>*Vigencia:</label></span>
                <span><input title="Agrega la fecha de vencimiento del cupon" type="date" id="vigencia" name="vigencia" required></span>
            </div>
            <div>
                <span><label>*Terminos y Condiciones:</label></span>
                <span><textarea title="los terminos y condiciones no se pueden superar los 250 caracteres"  id="terminos_y_condiciones" name="terminos_y_condiciones" rows="10" cols="40" placeholder="Terminos y condiciones" required></textarea></span>
            </div>
            <div>
                <span><input type="submit" value="Registrar Cupon" ></span>
            </div>
        </form></center>
</body>
</html>