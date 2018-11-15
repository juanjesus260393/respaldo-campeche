<?php
/*
 *   Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 24-10-2018
 *   Versión: 1.0
 *   Descripcion: Modelo donde se encuentran todas las funciones necesarias
 *   para  mostrar las empresas Inactivas
 * 
 * por Fabrica de Software, CIC-IPN
 */

//Se declara la clase Emp_Desactivas_model
class Emp_Desactivas_model {
//Se declaran las variables privadas necesarias
    private $db;
    private $empresas;
//Se declara el constructor de la clase
    public function __construct() {
        $this->db = Conectar::con();
        $this->empresas = array();
    }
//Metodo o función para obtener las empresas Deshabilitadas de la base de datos
    public function get_empresas() {
//Sentencia Sql
        $sqlconsulta = ("SELECT E.id_empresa, E.nombre, E.descripcion, S.nombre, U.username, E.id_membresia "
                . "FROM usuario_empresa EU INNER JOIN empresa E ON EU.id_empresa=E.id_empresa "
                . "INNER JOIN sector S ON E.id_sector=S.id_sector INNER JOIN users U ON EU.username=U.username WHERE U.enabled IS NULL");
//Php realiza la consulta a la BD
        $resultado = $this->db->query($sqlconsulta);
        //Recibe los resultados
        while ($filas = $resultado->fetch_row()) {
            $this->empresas[] = $filas;
        }

        $resultado->close();
       //Devuelve el resultado
        return $this->empresas;
    }
    //Metodo o función para obtener los sectores de la BD
    public function get_sectores(){
        //Sentencia Sql
        $sqlconsulta = ("SELECT S.id_sector, S.nombre FROM sector S WHERE 1");
        //Php hace la consulta a Maria DB
        $resultado=$this->db->query($sqlconsulta);
        //Recibe el resultado
        while($filas=$resultado->fetch_row()){
            $this->sector[]=$filas;
            
        }
        
        $resultado->close();
        //Devuelve el resultado
        return $this->sector;
    }
    //Función para obtener el numero de Empresas
      public function get_numemp(){
        //Sentencia Sql
        $sqlconsulta = ("SELECT E.id_empresa, E.nombre, E.descripcion, S.nombre, U.username , E.id_membresia "
                . "FROM usuario_empresa EU INNER JOIN empresa E ON EU.id_empresa=E.id_empresa "
                . "INNER JOIN sector S ON E.id_sector=S.id_sector INNER JOIN users U ON EU.username=U.username WHERE U.enabled=1 ");
        //Php realiza la consulta a Maria DB
        $result=$this->db->query($sqlconsulta);
      $Nemp = $result->num_rows;
        
        //Devuelve el resultado
        return $Nemp;
 
    }
    
//Metodo o Función para Habilitar una empresa 
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
//Metodo o Función que activa y establece el inicio y caducidad de la membresia de la empresa
    public function iniciaMembresia() {
        
        $idemp=$_POST['idemp'];
    
        
        date_default_timezone_set('America/Mexico_City');
//Obtiene la fecha actual y la fecha de caducidad 
        $inicio = date("Y-m-d H:i:s");
        $fin = $_POST['fechafin'];
        
        
//Sentencia SQL
        $sqlupdatefecha = "UPDATE empresa SET fecha_inicio_membresia= '" . $inicio . "', fecha_fin_membresia = '" . $fin . "' WHERE empresa.id_empresa ='" . $idemp . "' ";
        //Php realiza la consulta a Maria DB
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
