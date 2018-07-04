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

    public function fecha_actualizacion() {
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

    public function campo_vacio($parametro) {
        if ($parametro == NULL) {
            $message = "Todavia no has registrado ningun elemento";
            echo "<script type='text/javascript'>alert('$message');</script>";
        } else {
            return $fecha_actual;
        }
    }

}

?>
