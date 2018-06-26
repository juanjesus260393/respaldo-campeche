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
    function mostrar_ocultar($tipodeusuario) {
        if ($tipodeusuario == "administrador") {
            echo "Tus opciones como administrador son: ";
            echo "<li><a href='Nuevo_usu_controller.php'>Agregar nueva Empresa</a></li>";
            echo "<li><a href='Emp_Activas_controller.php'>Validar Empresa</a></li>";
        } else if ($tipodeusuario == "empresa") {
            echo "Tus opciones como empresa son: ";
            echo "<li><a href='ControladorSitios.php'>Administrar sitios</a></li>";
        }
    }

}

?>
