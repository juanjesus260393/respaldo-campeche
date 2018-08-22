<?php
require_once ("../Model/conexion.php");

class validacion {
    /* public function habilitado($estado) {
      //Si tu cuenta no se encuentra habilitada
      if ($_SESSION['enabled'] == NULL) {
      echo '<script language = javascript>
      alert("Tu cuenta todavia no se encuentra habilitada.")
      </script>';
      }
      } */

// creamos la función
    private $platillo;

    public function lista_cupones_caducados() {
        $this->dbh = Conectar::con();
        $fa = date('Y-m-d');
        $ftma = strtotime('+5 day', strtotime($fa));
        $ftma = date('Y-m-d', $ftma);
        //$this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        $sql = "SELECT c.titulo, c.vigencia_fin, c.limite_codigos FROM cupon c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto 
inner join empresa e on r.id_empresa = e.id_empresa inner join usuario_empresa u on e.id_membresia = u.id_empresa where
c.vigencia_fin <= '$ftma' and e.id_empresa = " . $_SESSION['idemp'] . " group by c.titulo";
        foreach ($this->dbh->query($sql) as $res) {
            $this->platillo[] = $res;
        }
        return $this->platillo;
    }

    function mostrar_ocultar() {
        if ($_SESSION['enabled'] == 1) {
            if ($_SESSION['tipo'] == "administrador") {
                echo '<script language = javascript>self.location ="../Controller/Emp_Activas_controller.php";
		</script>';
            } else if ($_SESSION['tipo'] == "empresa") {


                require_once '../view/modals.php';


                require_once ('../view/modals.php');
                ?>

                <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin:0px 0px 24px 0px;">
                    <a class="navbar-brand" href="">Bienvenido : <?php printf($_SESSION['username']); ?></a>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navb">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link " href="../Controller/IniciodeSesion.php" >
                                    HOME
                                </a>

                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    Sitios
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="../Controller/ControladorSitios.php">Ver Sitios</a>
                                    <a class="dropdown-item" href="../Controller/add_Sitios_controller.php">Agregar Sitios</a>
                                    <a class="dropdown-item" href="../Controller/setSitios_controller.php">Modificar Sitio</a>

                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="../Controller/crtCupones.php" id="navbardrop" data-toggle="dropdown">
                                    Cupones
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="../Controller/crtCupones.php">Cupones  </a>
                                    <a class="dropdown-item" href="../view/Addcupon.php">Agregar Cupon</a>

                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="../Controller/crtcVideos.php" id="navbardrop" data-toggle="dropdown">
                                    Videos
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="../Controller/crtcVideos.php">Videos  </a>
                                    <a class="dropdown-item" href="../view/Addvideo.php">Agregar Video</a>

                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="../Controller/crtcFlyers.php" id="navbardrop" data-toggle="dropdown">
                                    Flyers & Banners
                                </a>
                                <div class="dropdown-menu">
                                    <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#modalFlyer">Que es un Flyer???</button>
                                    <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#modalBanner">Que es un Banner???</button>
                                    <a class="dropdown-item" href="../Controller/crtcFlyers.php">Flyers & Banners  </a>
                                    <a class="dropdown-item" href="../view/Addflyerybanner.php">Agregar Flyers & Banners</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    Graficas
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="../Controller/crtEstadisticacupones.php">Estadisticas Cupones </a>
                                    <a class="dropdown-item" href="#">  </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="../Controller/cambiaPass_controller.php">
                                    Cambia Contraseña
                                </a>       
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0" action="../Controller/cerrarSession.php">
                            <button class="btn btn-warning my-2 my-sm-0" type="submit">Cerrar Sesion</button>
                        </form>
                    </div>
                </nav>

                <!-- comienza codigo -->        
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-10">
                                <!-- termina codigo -->






                                <?php
                            }
                        } else if ($_SESSION['enabled'] == NULL) {
                            echo '<script language = javascript>
	alert("Tu cuenta todavia no se encuentra habilitada.")
		</script>';
                        }
                    }

// creamos la función
                    public function generar_aleatorio() {
//Se declara la longitud del numero aleatorio que se generara
                        $rango = 9;
                        $longitud = $rango;
                        $key = '';
//Se establece el numero de patrones que se utilizara
                        $pattern = '1234567890';
                        $max = strlen($pattern) - 1;
                        for ($i = 0; $i < $longitud; $i++)
                            $key .= $pattern{mt_rand(0, $max)};
//Se genera el numero aleatorio
                        return $key;
                    }

// creamos la función generar alfa numerico
                    public function generar_alfanumerico() {
//Se declara la longitud del numero aleatorio que se generara
                        $rango = 7;
                        $longitud = $rango;
                        $key = '';
//Se establece el numero de patrones que se utilizara
                        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
                        $max = strlen($pattern) - 1;
                        for ($i = 0; $i < $longitud; $i++)
                            $key .= $pattern{mt_rand(0, $max)};
//Se genera el numero aleatorio
                        return $key;
                    }

// creamos la función generar alfa numerico
                    public function identificador_token() {
//Se declara la longitud del numero aleatorio que se generara
                        $rango = 10;
                        $longitud = $rango;
                        $key = '';
//Se establece el numero de patrones que se utilizara
                        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzZBCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $max = strlen($pattern) - 1;
                        for ($i = 0; $i < $longitud; $i++)
                            $key .= $pattern{mt_rand(0, $max)};
//Se genera el numero aleatorio
                        return $key;
                    }

// creamos la función
                    public function fecha_actual() {
                        $año_actual = date("Y");
                        $mes_actual = date("m");
                        $dia_actual = date("d");
                        $hora_actual = date("h");
                        $minuto_actual = date("i");
                        $segundo_actual = date("s");
                        $fecha_actual = $año_actual . "-" . $mes_actual . "-" . $dia_actual . " " . $hora_actual . ":" . $minuto_actual . ":" . $segundo_actual;
//Se genera el numero aleatorio
                        return $fecha_actual;
                    }

                    public function registros_cupon() {
                        $mysqli = Conectar::con();
                        // $mysqli = new mysqli("127.0.0.1:3306", "root", "P4SSW0RD", "campeche");
                        if (mysqli_connect_errno()) {
                            printf("Conexión fallida: %s\n", mysqli_connect_error());
                            exit();
                        }
                        if ($_SESSION['id_membresia'] == "3") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '4';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select c.id_cupon from (cupon c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto) inner join empresa e on e.id_empresa = r.id_empresa where e.id_empresa = " . $_SESSION['idemp'] . " group by r.id_revision_objeto");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Solo puedes subir 4 Cupones, si deseas agregar otro, primero elimina alguno de los que tienes registrados") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                        if ($_SESSION['id_membresia'] == "2") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '2';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select c.id_cupon from (cupon c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto) inner join empresa e on e.id_empresa = r.id_empresa where e.id_empresa = " . $_SESSION['idemp'] . " group by r.id_revision_objeto");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Solo puedes subir 2 Cupones, si deseas agregar otro, primero elimina alguno de los que tienes registrados") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                        if ($_SESSION['id_membresia'] == "1") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '0';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select c.id_cupon from (cupon c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto) inner join empresa e on e.id_empresa = r.id_empresa where e.id_empresa = " . $_SESSION['idemp'] . " group by r.id_revision_objeto");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Para Agregar cupones necesitas cambiar el tipo de membresia") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                    }

                    public function registros_video() {
                        $mysqli = Conectar::con();
                        //$mysqli = new mysqli("127.0.0.1:3306", "root", "P4SSW0RD", "campeche");
                        if (mysqli_connect_errno()) {
                            printf("Conexión fallida: %s\n", mysqli_connect_error());
                            exit();
                        }
                        if ($_SESSION['id_membresia'] == "3") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '3';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select c.id_video from (video c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto) inner join empresa e on e.id_empresa = r.id_empresa where e.id_empresa = " . $_SESSION['idemp'] . " group by r.id_revision_objeto");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Solo puedes subir 3 Videos, si deseas agregar otro, primero elimina alguno de los que tienes registrados") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                        if ($_SESSION['id_membresia'] == "2") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '1';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select c.id_video from (video c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto) inner join empresa e on e.id_empresa = r.id_empresa where e.id_empresa = " . $_SESSION['idemp'] . " group by r.id_revision_objeto");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Solo puedes subir 2 Videos, si deseas agregar otro, primero elimina alguno de los que tienes registrados") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                        if ($_SESSION['id_membresia'] == "1") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '0';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select c.id_video from (video c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto) inner join empresa e on e.id_empresa = r.id_empresa where e.id_empresa = " . $_SESSION['idemp'] . " group by r.id_revision_objeto");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Para Agregar Videos necesitas cambiar de membresia") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                    }

                    public function registros_paquete() {
                        $mysqli = new mysqli("127.0.0.1:3306", "root", "P4SSW0RD", "campeche");
                        if (mysqli_connect_errno()) {
                            printf("Conexión fallida: %s\n", mysqli_connect_error());
                            exit();
                        }
                        if ($_SESSION['id_membresia'] == "1") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '0';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select p.id_paquete, p.nombre, p.status, e.descripcion from paquete p inner join empresa_paquete e on p.id_paquete = e.idpaquete where e.idempresa = " . $_SESSION['idemp'] . " group by nombre;");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Para Agregar Paquetes necesitas cambiar de membresia") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                    }

                    public function registros_publicidad() {
                        $mysqli = Conectar::con();
                        //$mysqli = new mysqli("127.0.0.1:3306", "root", "P4SSW0RD", "campeche");
                        if (mysqli_connect_errno()) {
                            printf("Conexión fallida: %s\n", mysqli_connect_error());
                            exit();
                        }
                        if ($_SESSION['id_membresia'] == "3") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '4';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select a.id_ad, a.id_revision_objeto, a.tipo, a.id_img, revision_objeto.status from (ad a inner join revision_objeto on a.id_revision_objeto = revision_objeto.id_revision_objeto) inner join empresa on revision_objeto.id_empresa = " . $_SESSION['idemp'] . " group by id_ad;");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Solo puedes subir 4 flyers o Banners, si deseas agregar otro, primero elimina alguno de los que tienes registrados") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                        if ($_SESSION['id_membresia'] == "2") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '2';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select a.id_ad, a.id_revision_objeto, a.tipo, a.id_img, revision_objeto.status from (ad a inner join revision_objeto on a.id_revision_objeto = revision_objeto.id_revision_objeto) inner join empresa on revision_objeto.id_empresa = " . $_SESSION['idemp'] . " group by id_ad;");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Solo puedes subir 2 flyers o Banners si deseas agregar otro, primero elimina alguno de los que tienes registrados") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                        if ($_SESSION['id_membresia'] == "1") {
//Obtener cantidad de registros en base a una empresa
                            $nrpm = '0';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
                            $result = $mysqli->query("select a.id_ad, a.id_revision_objeto, a.tipo, a.id_img, revision_objeto.status from (ad a inner join revision_objeto on a.id_revision_objeto = revision_objeto.id_revision_objeto) inner join empresa on revision_objeto.id_empresa = " . $_SESSION['idemp'] . " group by id_ad;");
                            $row_cnt = $result->num_rows;
                            $nrbd = $row_cnt;
                            if ($nrbd >= $nrpm) {
                                echo '<script language = javascript> alert("Para Agregar Flyers o Banners necesitas cambiar el tipo de membresia") </script>';
                                //Regresamos a la pagina anterior
                                echo "<html><head></head>" .
                                "<body onload=\"javascript:history.back()\">" .
                                "</body></html>";
                                exit;
                            }
                        }
                    }

                    public function hora_computadora() {
                        $horaInicial = date("h");
                        $minutoAnadir = 60;
                        $segundos_horaInicial = strtotime($horaInicial);
                        $segundos_minutoAnadir = $horaInicial * 60;
                        $nuevaHora = date("h:i", $segundos_horaInicial + $segundos_minutoAnadir);
//Se genera el numero aleatorio, $segundos_horaInicial + $segundos_minutoAnadir
                        return $segundos_minutoAnadir;
                    }

                    public function campos_vacios($p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10) {
//Se verfica si los elementos enviados atraves de la url se encuentran vacios
                        if ($p1 == NULL and $p2 == NULL and $p3 = NULL and $p4 == NULL and $p5 == NULL and $p6 = NULL and $p7 == NULL and $p8 == NULL and $p9 == NULL and $p10 == null) {
                            include 'error404.php';
                        } else {
                            
                        }
                    }

                    public function campo_vacio($parametro) {
                        if ($parametro == NULL) {
                            echo '<script language = javascript>
	alert("No tienes contenido registrado.")
    	</script>';
                            echo "<html><head></head>" .
                            "<body onload=\"javascript:history.back()\">" .
                            "</body></html>";
                            exit;
                        } else {
                            return $parametro;
                        }
                    }

                }
                