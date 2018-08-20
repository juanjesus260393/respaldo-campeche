<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');

class Sector {

    private $platillo;
    private $dbh;

    public function search_sectorwithid() {
        $sector_id = $_GET['sector_id'];
        $this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        $sql = "SELECT s.id_sitio as place_id, s.nombre as name,d.descripcion_corta as short_description ,e.id_logo as logo_id from empresa e inner join sitio s on e.id_empresa = s.id_empresa inner join revision_informacion i on s.id_sitio = i.id_sitio
inner join descripcion_idioma d on i.id_revision_informacion= d.id_revision_informacion where d.lang_code = 'ES' and e.id_sector = '$sector_id' order by s.id_sitio;;";
        foreach ($this->dbh->query($sql) as $res) {
            $this->platillo[] = $res;
        }
        if($this->platillo == null){
            $this->platillo = array();
           }
        return $this->platillo;
    }

}
