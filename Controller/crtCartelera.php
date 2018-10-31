<?php

/**
 * Description of crtCartelera
 *
 * @author Pablo
 */
require_once('C:/xampp/htdocs/campeche-web2/Model/mdlCartelera.php');
    $evento = new Cartelera();
    $respuesta =$evento->get_Eventos();
    

