<?php

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
    function mostrar_ocultar() {
        if ($_SESSION['enabled'] == 1) {
            if ($_SESSION['tipo'] == "administrador") {
                echo '<script language = javascript>self.location ="../Controller/Emp_Activas_controller.php";
		</script>';
            } else if ($_SESSION['tipo'] == "empresa") {
                ?>
                <nav class = "navbar navbar-expand-lg navbar-dark bg-dark" style = "margin:24px 0;">
                    <a class="navbar-brand" href="">Bienvenido : <?php printf($_SESSION['username']); ?></a>
                    <button class = "navbar-toggler navbar-toggler-right" type = "button" data-toggle = "collapse" data-target = "#navb">
                        <span class = "navbar-toggler-icon"></span>
                    </button>
                    <div class = "collapse navbar-collapse" id = "navb">
                        <ul class = "navbar-nav mr-auto">
                            <li class = "nav-item">
                                <a class = "nav-link" href = "../Controller/ControladorSitios.php">Ver Sitios</a>
                            </li>
                            <li class = "nav-item">
                                <a class = "nav-link" href = "../Controller/add_Sitios_controller.php">Nuevo Sitio</a>
                            </li>
                            <li class = "nav-item">
                                <a class = "nav-link" href = "../Controller/cambiaPass_controller.php">Cambiar Contraseña</a>
                            </li>
                        </ul>
                        <form class = "form-inline my-2 my-lg-0" action = "../Controller/cerrarSession.php">
                            <button class = "btn btn-warning my-2 my-sm-0" type = "submit">Cerrar Sesion</button>
                        </form>
                    </div>
                </nav>
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
        $año_actual = date("y");
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
        $mysqli = new mysqli("127.0.0.1:3306", "root", "P4SSW0RD", "campeche");
        if (mysqli_connect_errno()) {
            printf("Conexión fallida: %s\n", mysqli_connect_error());
            exit();
        }
        if ($id_mem == "3") {
            echo 'Primera validacion<br>';
//Obtener cantidad de registros en base a una empresa
            $nrpm = '4';
//Obtener la cantidad de Registros entre el registro del primer cupon y la fecha de termino del mes actual
            $result = $mysqli->query("select c.id_cupon from (cupon c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto) inner join empresa e on e.id_empresa = r.id_empresa where e.id_empresa = '1' and r.fecha_creacion group by r.id_revision_objeto");
            $row_cnt = $result->num_rows;
            $nrbd = $row_cnt;
            if ($nrbd < $nrpm) {
                echo 'Todavia puedes subir contenido <br>';
            } else {
                echo 'Ya no puedes subir contenido <br>';
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
        } else {
            return $parametro;
        }
    }

}
