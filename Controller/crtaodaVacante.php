<?php

require_once("../Model/mdlVacantes.php");
//se referencia la clase obtener sesiones
$dvacante = new Vacantes();
//se llama el metodo lista de sitios del cual se obtiene la lista de sitios
$vacante = $dvacante-> buscar_vacante();
//Se llama a la vista vista sitios
require_once("../view/actualizarVacante.php");

