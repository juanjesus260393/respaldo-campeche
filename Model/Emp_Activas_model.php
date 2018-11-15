<?php

/*
 *   Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 24-10-2018
 *   Versión: 1.0
 *   Descripcion: Modelo donde se encuentran todas las funciones necesarias
 *   para  mostrar las empresas activas
 * 
 * por Fabrica de Software, CIC-IPN
 */

//Se declara la Clase Emp_Activas_model
class Emp_Activas_model {

    //Se declaran las variables privadas necesarias
    private $db;
    private $empresas;

    //Se declara el constructor de la clase
    public function __construct() {
        $this->db = Conectar::con();
        $this->empresas = array();
    }

    //Metodo o función para obtener las empresas Habilitadas de la base de datos
    public function get_empresas() {
        //consutla sql para obtener las empresas Activas
        $sqlconsulta = ("SELECT E.id_empresa, E.nombre, SUBSTR(E.descripcion, 1, 200), S.nombre, U.username , E.id_membresia "
                . "FROM usuario_empresa EU INNER JOIN empresa E ON EU.id_empresa=E.id_empresa "
                . "INNER JOIN sector S ON E.id_sector=S.id_sector INNER JOIN users U ON EU.username=U.username WHERE U.enabled=1 ");
        //php Realiza la consulta a Maria DB
        $resultado = $this->db->query($sqlconsulta);
        //recibe los resultados y los agrega aun arreglo
        while ($filas = $resultado->fetch_row()) {
            $this->empresas[] = $filas;
        }

        $resultado->close();

        //Regresa el resultado  
        return $this->empresas;
    }

    //Funcion para obtener el numero de Empreasa Activas
    public function get_numemp() {
        //Consulta Sql
        $sqlconsulta = ("SELECT E.id_empresa, E.nombre, E.descripcion, S.nombre, U.username , E.id_membresia "
                . "FROM usuario_empresa EU INNER JOIN empresa E ON EU.id_empresa=E.id_empresa "
                . "INNER JOIN sector S ON E.id_sector=S.id_sector INNER JOIN users U ON EU.username=U.username WHERE U.enabled=1 ");
        //php hace la consulta a Maria DB
        $result = $this->db->query($sqlconsulta);
        $Nemp = $result->num_rows;

        //Regresa el resultado 
        return $Nemp;
    }

    //Metodo o función para obtener los sectores de la BD
    public function get_sectores() {
        //Consulta Sql
        $sqlconsulta = ("SELECT S.id_sector, S.nombre FROM sector S WHERE 1");
        //Php hace la consulta a Maria DB
        $resultado = $this->db->query($sqlconsulta);
        //Recibe los resultados
        while ($filas = $resultado->fetch_row()) {
            $this->sector[] = $filas;
        }

        $resultado->close();

        //Regresa el resultado
        return $this->sector;
    }

    //Metodo o Función para deshabilitar una empresa
    public function disabled_emp($user_off) {

        if (isset($user_off)) {
            //Sentencia Sql 
            $sqlupdate = ("UPDATE users SET enabled = NULL WHERE users.username = '" . $user_off . "'");
            $update = $this->db->query($sqlupdate);
            if ($update) {
                //Mensaje de éxito
                echo ("<script> alert('Usuario Deshabilitado'); location.href ='../Controller/Emp_Activas_controller.php';</script>");
            } else {
                printf("Errormessage: %s\n", $this->db->error);
            }
        }
    }

}
