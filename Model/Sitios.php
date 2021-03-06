<?php

class obtener_sitios {

    private $platillo;
    private $dbh;

//Constructor de la clase obtener sitios
    public function __construct() {
        $this->dbh = Conectar::con();
        $this->platillo = array();
    }

    //Funcion que obtiene la lista de los sitios que han sido registrados por una empresa
    public function lista_sitios() {
        //$this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        $sql = "select * from sitio where id_empresa = " . $_SESSION['idemp'];
        if ($this->dbh->query($sql) == NULL) {
            $this->platillo[] = null;
        } else {
            foreach ($this->dbh->query($sql) as $res) {
                $this->platillo[] = $res;
            }
        }
        return $this->platillo;
    }

}
