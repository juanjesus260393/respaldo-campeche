<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Proyecto Campeche</title>
    
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../css/bootstrap.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </head>
   
    
  <body>
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin:24px 0;">
  <a class="navbar-brand" href="">Administrador</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navb">
    <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
            <a class="nav-link " href="../Controller/Emp_Activas_controller.php">
                HOME
            </a>
            
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                Empresas
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="../Controller/Nuevo_usu_controller.php">Nueva Empresa</a>
                <a class="dropdown-item" href="../Controller/Emp_Desactivadas_controller.php">Empresas Deshabilitadas</a>
                <?php 
                            if($_SESSION['username']=='master@admin.com'){
                            printf('<a class="dropdown-item" href="../Controller/insertAuthority.php">Agregar Administrador</a>');}
                        ?>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                Validar <span> <?php printf($totalPendientes); ?></span>
            </a>
            <div class="dropdown-menu">
                
                <a class="dropdown-item" href="">Sitios <span> <?php printf($nS); ?></span></a>
                <a class="dropdown-item" href="">Cupones   <span> <?php printf($nC); ?></span></a>
                <a class="dropdown-item" href="">Videos</a>
               
            </div>
        </li>
    </ul>
      <form class="form-inline my-2 my-lg-0" action="../Controller/cerrarSession.php">
          <button class="btn btn-warning my-2 my-sm-0" type="submit">Cerrar Sesion</button>
    </form>
  </div>
</nav>            

    </body>
</html>
