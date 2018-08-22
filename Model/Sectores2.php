<?php

date_default_timezone_set('America/Mexico_City');
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');

class Sector {

    private $platillo;
    private $platillo2;
    private $dbh;

    public function search_sectorwithid() {
        $sector_id = $_GET['sector_id'];
        $this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        $sql = "SELECT s.id_sitio as place_id, s.nombre as name,d.descripcion_corta as short_description ,e.id_logo as logo_id from empresa e inner join sitio s on e.id_empresa = s.id_empresa inner join revision_informacion i on s.id_sitio = i.id_sitio
inner join descripcion_idioma d on i.id_revision_informacion= d.id_revision_informacion where d.lang_code = 'ES' and e.id_sector = '$sector_id' order by s.id_sitio;;";
        foreach ($this->dbh->query($sql) as $res) {
            $this->platillo[] = $res;
        }
        if ($this->platillo == null) {
            $this->platillo = array();
        }
        return $this->platillo;
    }

    public function search_sitio() {
        $sector_id = $_GET['id'];
        $this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        $sql = "SELECT s.id_sitio as place_id, s.nombre as name, t.nombre as sector, d.descripcion_corta as short_description,
d.descripcion_larga as long_description, s.direccion as address, s.telefono1 as first_telephone, s.telefono2 as second_telephone,
i.url_sitio_web as web_url, s.horario as schedule,s.capacidad as capacity, i.id_carta as menu_id, i.id_imagen_perfil as profile_img_id,
e.id_logo as logo_id, i.ubicacionGIS as latitude, h.id_calificacion as score, c.calificacion as rated, e.facebook,
e.twitter, e.instagram, e.youtube, e.googleplus FROM empresa e inner join sitio s on e.id_empresa = s.id_empresa 
inner join sector t on e.id_sector = t.id_sector inner join sitio_has_calificacion h on s.id_sitio = h.id_sitio inner join 
calificacion c on h.id_calificacion = c.id_calificacion inner join revision_informacion i on s.id_sitio = i.id_sitio 
inner join descripcion_idioma d on i.id_revision_informacion= d.id_revision_informacion where d.lang_code = 'ES' and s.id_sitio = '$sector_id';";
        foreach ($this->dbh->query($sql) as $res) {
            $this->platillo2[] = $res;
        }
        if ($this->platillo2 == null) {
            $this->platillo2 = array();
        }
        return $this->platillo2;
    }

}
