<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Proyecto Campeche</title>
    
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  
        
    </head>
    <body>
<<<<<<< HEAD
        <?php list($id_cupon, $id_revision_objeto, $titulo, $descripcion_corta, $descripcion_larga, $id_imagen_extra, $terminos_y_condiciones,$limite_codigos) = $secupon ?>
=======
        <nav class = "navbar navbar-expand-lg navbar-dark bg-dark" style = "margin:24px 0;">
                    <a class="navbar-brand" href="">Bienvenido : <?php printf($_SESSION['username']);?></a>
            <button class = "navbar-toggler navbar-toggler-right" type = "button" data-toggle = "collapse" data-target = "#navb">
            <span class = "navbar-toggler-icon"></span>
            </button>
            <div class = "collapse navbar-collapse" id = "navb">
            <ul class = "navbar-nav mr-auto">
            <li class = "nav-item">
                <a class = "nav-link" href = "../Controller/IniciodeSesion.php">Principal</a>
            </li>

            <li class = "nav-item">
                <a class = "nav-link" href = "../Controller/crtCupones.php">Cupones</a>
            </li>
            <li class = "nav-item">
                <a class = "nav-link" href = "../view/Addcupon.php">Agregar cupon</a>
            </li>
            </ul>
              <form class="form-inline my-2 my-lg-0" action="../Controller/cerrarSession.php">
                  <button class="btn btn-warning my-2 my-sm-0" type="submit">Cerrar Sesion</button>
              </form>
          </div>
      </nav>       

>>>>>>> b79fd595bcbcadcda7f375ffffdda2a73b046838
    <center><h2>Llenar los campos que contienen un * al inicio de los campos</h2></center>   

    <center><h1>Actualizar Cupon</h1></center>
    <center><form method="post" action="../Controller/crtacCupon.php" name="form1" enctype="multipart/form-data">
            <div>
<<<<<<< HEAD
                <span><input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp'];
?>" required></span>
=======

                <span><label>Identificador de la empresa:</label></span>

                <span><input type="text" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp'];?>" disabled="true" ></span>

>>>>>>> b79fd595bcbcadcda7f375ffffdda2a73b046838
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
                <span><label>Imagen:</label></span>
                <span><input type="file" id="id_imagen_extra" accept=".jpg" name="id_imagen_extra" ></span>
                <span><label>Nombre anterior de la imagen:</label></span>
                <span><input type="text" id="id_imagen_extra" name="id_imagen_anterior" value="<?php echo $id_imagen_extra;
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
</body>
</html>
