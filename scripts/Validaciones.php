<?php

class validacion {

    public function habilitado($estado) {
        //Si tu cuenta no se encuentra habilitada 
        if ($estado = "0") {
            echo '<script language = javascript>
	alert("Tu cuenta todavia no se encuentra habilitada.")
		</script>';
        }
    }

    // creamos la función
    function mostrar_ocultar($tipodeusuario, $identificadorempresa) {
        if ($tipodeusuario == "administrador") {
            echo "Tus opciones como administrador son: ";
            echo "<li><a href='Nuevo_usu_controller.php'>Agregar nueva Empresa</a></li>";
            echo "<li><a href='Emp_Activas_controller.php'>Validar Empresa</a></li>";
        } else if ($tipodeusuario == "empresa") {
            echo "Tus opciones como empresa son: ";
            echo "<li><a href='ControladorSitios.php?id=$identificadorempresa'>Administrar Sitios</a></li>";
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
        $rango = 9;
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

    public function hora_computadora() {
        $año_actual = " ";
        $mes_actual = " ";
        $dia_actual = " ";
        $hora = date("h");
        $minuto_actual = date("i");
        $segundo_actual = date("s");
        $hora_actual = $año_actual . "-" . $mes_actual . "-" . $dia_actual . " " . $hora . ":" . $minuto_actual . ":" . $segundo_actual;
        //Se genera el numero aleatorio
        return $hora_actual;
    }

    public function campos_vacios($p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10) {
        //Se verfica si los elementos enviados atraves de la url se encuentran vacios
        if ($p1 == NULL and $p2 == NULL and $p3 = NULL and $p4 == NULL and $p5 == NULL and $p6 = NULL and $p7 == NULL and $p8 == NULL and $p9 == NULL and $p10 == null) {
           include 'error404.php';
        } else {
            //
        }
    }

}

?>
