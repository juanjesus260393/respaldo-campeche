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

}

?>
