<?php
session_start();
/*
$_SESSION['loggedin']
$_SESSION['username'];
$_SESSION['enabled'];
$_SESSION['idemp'];
$_SESSION['tipo'];*/
//Se llama al modelo de inicios de sesion

if($_SESSION['loggedin']==NULL){
    require_once("../Model/Miniciodesesion.php");  
//se referencia la clase obtener sesiones
     $usuario = new obtener_usuario();
   //se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$user = $usuario->busquedad_usuario();
//Se llama a la vista vista sitios
require_once("../view/MenuPrincipal.php");}

else if($_SESSION['loggedin']==FALSE){
    unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';

}

else if($_SESSION['loggedin']==TRUE){
    $user=array($_SESSION['tipo'], $_SESSION['idemp']);
     require_once("../view/MenuPrincipal.php");
}

    
    
   
    



