<?php
//ws que llama al mdltursita
require_once("C:/xampp/htdocs/campeche-web2/Model/mdlTurista.php");
//Se llama a la clase turista para acceder a una funcion en especifico
$turista = new Turista();
//se llama a la funcion keep_alive para mantener activa la sesion en el dispositivo movil
$cs = $turista->keep_alive();

