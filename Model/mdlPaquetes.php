<?php

require_once('Conexion.php');
require_once('../scripts/Validaciones.php');

class Paquetes {

    public function lista_paquetes() {
        $this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        $sql = "select p.nombre, p.status, p.id_paquete, e.descripcion from (paquete p inner join empresa_paquete e on p.id_paquete = e.idpaquete) inner join empresa on empresa.id_empresa = " . $_SESSION['idemp'] . " group by nombre;";
        if ($this->dbh->query($sql) == NULL) {
            return null;
        } else {
            foreach ($this->dbh->query($sql) as $res) {
                $this->platillo[] = $res;
            }
        }
        return $this->platillo;
    }

    public function registrar_paquete() {
        //Se llama a la clase conectar y a la funcion conectar 
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Primero se genera el identificador de la revision del objeto
        $na = new validacion();
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $this->idpa = $na->generar_aleatorio();
        $status = 'C';
        $sql = "INSERT INTO paquete(id_paquete,nombre,status)
        VALUES('$this->idpa','$nombre','$status')";
        if (!mysqli_query($pd, $sql)) {
            die('Error: ' . mysqli_error($pd));
        }
        $sql2 = "INSERT INTO empresa_paquete (idpaquete,idempresa,descripcion)
        VALUES('$this->idpa'," . $_SESSION['idemp'] . " ,'$descripcion')";
        if (!mysqli_query($pd, $sql2)) {
            die('Error: ' . mysqli_error($pd));
        }
        mysqli_close($pd);
        header("Location:https://localhost/campeche-web2/Controller/ControladorSitios.php");
    }

    public function eliminar_paquete() {
        //Se llama a la clase conectar y a la funcion conectar 
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Se obtienen los parametros de la vista del cupon
        $id_paquete = $_GET["id_paquete"];
        $Eliminar = "Delete from paquete where id_paquete = " . $id_paquete . "";
        $Eliminar2 = "Delete from empresa_paquete where idpaquete = " . $id_paquete . " and idempresa = '" . $_SESSION['idemp'] . "'";
        if (!mysqli_query($pd, $Eliminar2)) {
            die('Error: ' . mysqli_error($pd));
        }
        if (!mysqli_query($pd, $Eliminar)) {
            die('Error: ' . mysqli_error($pd));
        }
        mysqli_close($pd);
        header("Location:https://localhost/campeche-web2/Controller/ControladorSitios.php");
    }

}
