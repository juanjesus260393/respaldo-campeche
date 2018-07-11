<?php  session_start(); ?>
<!DOCTYPE html>
<html lang="es">
    
    <head>
        <meta charset="UTF-8" />
        <title>Proyecto Campeche 360</title>
    </head>
    <body>
        
    <center><h1>Actualizar Cupon</h1></center>
    <center><form method="post" action="../Controller/crtacCupon.php" name="form1" enctype="multipart/form-data">
            <div>

                <span><label>Identificador de la empresa:</label></span>
                <span><input type="text" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp'];
?>"></span>
            </div>
            <div>
                <span><label>Identificador del cupon</label></span>
                <span><input type="text" name="id_cupon" id="id_cupon" value="<?php echo $id_cupon = $_GET['id_cupon'];
?>"></span>
            </div>
            <div>
                <span><label>Registro del cupon</label></span>
                <span><input type="text" name="id_revision_objeto" id="id_revision_objeto" value="<?php echo $id_revision_objeto = $_GET['id_revision_objeto'];
?>"></span>
            </div>
            <div>
                <span><label>*Titulo del Cupon:</label></span>
                <span><input type="text" id="titulo" name="titulo" value="<?php echo $titulo = $_GET['titulo'];
?>"></span>
            </div>
            <div>
                <span><label>*Descripcion Corta:</label></span>
                <span><input title="Agrega una descripcion no mayor a 150 caracteres"  type="text" id="descripcion_corta" name="descripcion_corta" value="<?php echo $descripcion_corta = $_GET['descripcion_corta'];
?>"required></span>
            </div>   
            <div>
                <span><label>*Descripcion Larga:</label></span>
                <span><input  id="terminos_y_condiciones" id="descripcion_larga" name="descripcion_larga" size="35" style="WIDTH: 228px; HEIGHT: 98px" value="<?php echo $descripcion_larga = $_GET['descripcion_larga'];
?>" required></span>
            </div> 
            <div>
                <span><label>Imagen:</label></span>
                <span><input type="file" id="id_imagen_extra" name="id_imagen_extra"></span>
                <span><label>Nombre anterior de la imagen:</label></span>
                <span><input type="text" id="id_imagen_extra" name="id_imagen_anterior" value="<?php echo $id_imagen_extra = $_GET['id_imagen_extra'];
?>"></span>
            </div>
            <div>
                <span><label>*Vigencia inicio:</label></span>
                <span><input type="date" id="vigencia" name="vigencia_inicio" ></span>
            </div>
            <div>
                <span><label>*Vigencia fin:</label></span>
                <span><input type="date" id="vigencia" name="vigencia_fin" ></span>
            </div>
            <div>
                <span><label>*Terminos y Condiciones:</label></span>
                <span><input  id="terminos_y_condiciones" name="terminos_y_condiciones" size="35" style="WIDTH: 228px; HEIGHT: 98px" value="<?php echo $terminos_y_condiciones = $_GET['terminos_y_condiciones'];
?>" required></span>
            </div>
            <div>
                <span><label>*Cantidad de cupones:</label></span>
                <span><input title="Agrega una descripcion no mayor a 150 caracteres"  type="text" id="limite_codigos" name="limite_codigos" value="<?php echo $limite_codigos = $_GET['limite_codigos'];
?>"required></span>
            </div> 
            <div>
                <span><input type="submit" onclick="if (!confirm('Estas seguro que quieres actualizar este cupon?')) { return false }" value="Actualizar Cupon" ></span>
            </div>
        </form></center>
</body>
</html>
