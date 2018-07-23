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

        <script type="text/javascript" src="../scripts/Comprobaciones.js"></script>
    </head>
    <body>

        <nav class = "navbar navbar-expand-lg navbar-dark bg-dark" style = "margin:24px 0;">
            <a class="navbar-brand" href="">Bienvenido : <?php printf($_SESSION['username']); ?></a>
            <button class = "navbar-toggler navbar-toggler-right" type = "button" data-toggle = "collapse" data-target = "#navb">
                <span class = "navbar-toggler-icon"></span>
            </button>
            <div class = "collapse navbar-collapse" id = "navb">
                <ul class = "navbar-nav mr-auto">
                    <li class = "nav-item">
                        <a class = "nav-link" href = "../Controller/IniciodeSesion.php">Principal</a>
                    </li>

                    <li class = "nav-item">
                        <a class = "nav-link" href = "../Controller/crtcFlyers.php">Flyers y Banners</a>
                    </li>

                </ul>
                <form class="form-inline my-2 my-lg-0" action="../Controller/cerrarSession.php">
                    <button class="btn btn-warning my-2 my-sm-0" type="submit">Cerrar Sesion</button>
                </form>
            </div>
        </nav>

    <center><h2>Llenar los campos que contienen un * al inicio de los campos</h2></center>  
    <center><h1>Agregar Flyer o Banner</h1></center>
    <center><form method="post" action="../Controller/crtAdpublicidad.php" name="form1" enctype="multipart/form-data">
            <div>
                <span><input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp'];
?>"></span>
            </div>
            <div>
                <span><label>*Tipo de Publicidad:</label></span>
                <input type="radio" id="contactChoice1"
                       name="contact" value="F" required>
                <label for="contactChoice1">Flyer</label>
                <input type="radio" id="contactChoice2"
                       name="contact" value="B">
                <label for="contactChoice2">Banner</label>
            </div>
            </div>
            <div>
                <span><label>*Imagen de la Publicidad:</label></span>
                <span><input type="file" id="id_img" accept=".jpg" name="id_img" required></span>
            </div>
            <div>
                <span><input type="submit" onclick="if (!confirm('Estas seguro que quieres registrar esta publicidad?')) {
                            return false;
                        }" value="Registrar Publicidad" ></span>
            </div>
        </form></center>
</body>
</html>