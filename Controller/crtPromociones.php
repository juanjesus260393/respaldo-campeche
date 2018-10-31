<?php
/**
 * Description of crtPromociones
 *
 * @author Pablo
 */
   require_once('C:/xampp/htdocs/campeche-web2/Model/mdlPromociones.php');
    $promociones = new Promociones();
    $respuesta =$promociones->getPromociones();
    
   

