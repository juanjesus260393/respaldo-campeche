<?php
class obtener_sitios
{
 
    private $platillo;
    private $dbh;
 
    public function __construct()
    {
        $this->platillo = array();
        $this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
    }
 
    private function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");
    }
 
    public function lista_sitios()
    {
        self::set_names();
        /* @var $ide type */
        $ide=$_GET['id'];
        $sql="select * from sitio where id_empresa = $ide";
        foreach ($this->dbh->query($sql) as $res)
        {
            $this->platillo[]=$res;
        }
        return $this->platillo;
        $this->dbh=null;
    }
}
?>