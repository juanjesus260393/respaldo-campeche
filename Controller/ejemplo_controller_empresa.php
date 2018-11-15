<?php
/*
 *          Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 10-10-2018
 *   Versión: 1.0
 *   Descripcion: Controlador de la funcion que muestra las empresas activas
 * por Fabrica de Software, CIC-IPN
 */
session_start();

if($_SESSION['loggedin']==NULL || $_SESSION['loggedin']==FALSE){
 unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';

}
else if($_SESSION['loggedin']==TRUE&&$_SESSION['tipo']=='empresa'){
 //Llamada al modelo
    // ejemplo
                 //Se llama al modelo
                  require_once("C:/xampp/htdocs/campeche-web2/Model/mdlCupones.php");
                  //se referencia la clase obtener sitios
                   $cupon = new obtener_cupon();
                   //se llama el metodo lista de sitios del cual se obtiene la lista de sitios
                   $lcupones = $cupon->lista_cupones();
                   $lcupones2 = $cupon->lista_cupones2();
    // ejemplo
//Llamada al modelo  
                   
//Llamada a la vista
          // ejemplo
             require_once("../view/Emp_Activas_view.php");
         // ejemplo
//Llamada a la vista             
}

else{
    unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}