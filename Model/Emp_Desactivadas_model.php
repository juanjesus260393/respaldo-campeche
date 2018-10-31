<?php

class Emp_Desactivas_model {

    private $db;
    private $empresas;

    public function __construct() {
        $this->db = Conectar::con();
        $this->empresas = array();
    }

    public function get_empresas() {

        $sqlconsulta = ("SELECT E.id_empresa, E.nombre, E.descripcion, S.nombre, U.username, E.id_membresia "
                . "FROM usuario_empresa EU INNER JOIN empresa E ON EU.id_empresa=E.id_empresa "
                . "INNER JOIN sector S ON E.id_sector=S.id_sector INNER JOIN users U ON EU.username=U.username WHERE U.enabled IS NULL");

        $resultado = $this->db->query($sqlconsulta);
        while ($filas = $resultado->fetch_row()) {
            $this->empresas[] = $filas;
        }

        $resultado->close();
        // $this->db->close();

        return $this->empresas;
    }
    public function get_sectores(){
        
        $sqlconsulta = ("SELECT S.id_sector, S.nombre FROM sector S WHERE 1");
        
        $resultado=$this->db->query($sqlconsulta);
        while($filas=$resultado->fetch_row()){
            $this->sector[]=$filas;
            
        }
        
        $resultado->close();
        //$this->db->close();
        
        return $this->sector;
    }
      public function get_numemp(){
        
        $sqlconsulta = ("SELECT E.id_empresa, E.nombre, E.descripcion, S.nombre, U.username , E.id_membresia "
                . "FROM usuario_empresa EU INNER JOIN empresa E ON EU.id_empresa=E.id_empresa "
                . "INNER JOIN sector S ON E.id_sector=S.id_sector INNER JOIN users U ON EU.username=U.username WHERE U.enabled=1 ");
        
        $result=$this->db->query($sqlconsulta);
      $Nemp = $result->num_rows;
        
        
        return $Nemp;
 
    }
    

    public function able_emp($user_on) {

        if (isset($user_on)) {
            $sqlupdate = ("UPDATE users SET enabled = 1 WHERE users.username = '" . $user_on . "'");
            $update = $this->db->query($sqlupdate);
            if ($update) {
                //location.href ='../Controller/Emp_Activas_controller';
                //header("Location:../Controller/Emp_Activas_controller.php");
                echo ("<script> alert('Usuario Habilitado'); location.href ='../Controller/Emp_Desactivadas_controller.php';</script>");
            } else {
                printf("Errormessage: %s\n", $this->db->error);
            }
        }
    }

    public function iniciaMembresia() {
        
        $idemp=$_POST['idemp'];
    
        
        date_default_timezone_set('America/Mexico_City');

        $inicio = date("Y-m-d H:i:s");
        $fin = $_POST['fechafin'];
        
        

        $sqlupdatefecha = "UPDATE empresa SET fecha_inicio_membresia= '" . $inicio . "', fecha_fin_membresia = '" . $fin . "' WHERE empresa.id_empresa ='" . $idemp . "' ";
        $updatedate = $this->db->query($sqlupdatefecha);
        if ($updatedate) {
            //location.href ='../Controller/Emp_Activas_controller';
            //header("Location:../Controller/Emp_Activas_controller.php");
            //echo ("<script> alert('Usuario Habilitado'); location.href ='../Controller/Emp_Desactivadas_controller.php';</script>");
        } else {
            printf("Errormessage: %s\n", $this->db->error);
            
        }
    }

}
