<?php

class obtener_sitios {

    private $platillo;
    private $dbh;

    public function __construct() {
        $this->platillo = array();
        $this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        //$this->dbh = new PDO('mysql:host=localhost;dbname=campeche', "root", "");
    }

    public function lista_sitios() {
        $this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
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



