<?php

session_start();

$_SESSION['loggedin'];
$_SESSION['username'];
$_SESSION['enabled'];
$_SESSION['idemp'];
$_SESSION['tipo'];
//Se llama al modelo de inicios de sesion

if ($_SESSION['loggedin'] == NULL) {
    //se llama al archivo Miniciodesesion
    require_once("../Model/Miniciodesesion.php");
//se referencia la clase obtener usuario
    $usuario = new obtener_usuario();
    //se llama el metodo busquedad de sitios del cual se obtiene la lista de sitios
    $user = $usuario->busquedad_usuario();
    if ($user) {
        //Si el usuario existe se va la vista principal
        echo '<script language = javascript>
	self.location = "../principal.php"
	</script>';
    }
} else if ($_SESSION['loggedin'] == FALSE) {
    unset($_SESSION);
    session_destroy();
    //Si el usuario no existe o su informacion no coincide se regresa a la vista de inicio de sesion
    echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
} else if ($_SESSION['loggedin'] == TRUE && $_SESSION['tipo'] == 'empresa') {
    $user = array($_SESSION['tipo'], $_SESSION['idemp']);
    require_once("../principal.php");
}

    
    
   
    



