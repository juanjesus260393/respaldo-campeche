<?php
/**
 * Description of crtDPlanner
 *
 * @author Pablo
 */
require_once('C:/xampp/htdocs/campeche-web2/Model/mdlDPlanner.php');
    $evento = new Dplanner();
    $respuesta =$evento->getEventos();
