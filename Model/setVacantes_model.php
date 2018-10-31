<?php

require_once ('../vendor/autoload.php');
require_once('../scripts/Validaciones.php');
use \Statickidz\GoogleTranslate;

class setVacantes_model {

    private $db;
    
    public function __construct() {
        $this->db = Conectar::con();
        $this->vacantes=array();
        //$this->eventos = array();
        // $this->sitiofinal = array();
        // $this->isitio = array();
        // $this->municipo = array();
    }


    public function get_vacantes() {

      
        $sql = "select v.id_vacante, v.id_revision_objeto, v.nombre, v.salario, v.horario, v.escolaridad, v.habilidades, v.descripcion, v.tiempo, v.genero, v.experiencia, v.rango_edad, revision_objeto.status, v.fecha_creacion from (vacante v inner join revision_objeto on v.id_revision_objeto = revision_objeto.id_revision_objeto) inner join empresa on revision_objeto.id_empresa = " . $_SESSION['idemp'] . " group by nombre;";
        $ressit = $this->db->query($sql);
               while ($filas = $ressit->fetch_row()) {
            $this->vacantes[] = $filas;
            
        }

        $ressit->close();
        return $this->vacantes;
       
    }
    
    public function eliminar_vacante() {
        //Se llama a la clase conectar y a la funcion conectar 
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Se obtienen los parametros de la vista del cupon
        $id_revision_objeto = $_POST["id_revision_objeto"];
        $id_vacante = $_POST["id_vacante"];
        if ($id_revision_objeto == NULL && $id_vacante == NULL) {
            echo '<script language = javascript> alert("No es un elemento valido de las Vacantes") </script>';
            //Regresamos a la pagina anterior
            echo "<html><head></head>" .
            "<body onload=\"javascript:history.back()\">" .
            "</body></html>";
        }
        
        $Eliminar = "Delete from revision_objeto where id_revision_objeto = " . $id_revision_objeto . " AND id_empresa = '" . $_SESSION['idemp'] . "'";
        $Eliminar2 = "Delete from vacante where id_vacante = " . $id_vacante . " and id_revision_objeto = " . $id_revision_objeto . "";
        if (!mysqli_query($pd, $Eliminar2)) {
            die('Error: ' . mysqli_error($pd));
        }
        if (!mysqli_query($pd, $Eliminar)) {
            die('Error: ' . mysqli_error($pd));
        }
        else
        {
            echo ("<script> alert('Vacante Eliminada con Exito'); </script>");
        }
       
    }


   public function actualizar_vacante() {
        $conn = new Conectar();
        $pd = $conn->con();
        $na = new validacion();
        $iie = $na->generar_alfanumerico();
        //$iav = $na->generar_alfanumerico();
                  
      
        $id_revision_objeto = $_POST["id_revision_objeto"];
        $id_vacante = $_POST["id_vacante"];
        $nombre = $_POST['nombre'];
        $salario = $_POST['salario'];
        $horario = $_POST['horario'];
        $escolaridad= $_POST['escolaridad'];
        $habilidades= $_POST['habilidades'];
        $descripcion= $_POST['descripcion'];
        $tiempo= $_POST['tiempo'];
        $genero= $_POST['genero'];
        $rango_edad= $_POST['rango_edad'];
        //$experiencia= $_POST['experiencia'];

        //Fecha actual
        $año_actual = date("Y");
        $mes_actual = date("m");
        $dia_actual = date("d");
        $hora_actual = date("h");
        $minuto_actual = date("i");
        $segundo_actual = date("s");
        $fecha_actual = $año_actual . "" . $mes_actual . "" . $dia_actual . "" . $hora_actual . "" . $minuto_actual . "" . $segundo_actual;
        
        $actualizacion1 = "update revision_objeto set status='C', fecha_actualizacion = " . $fecha_actual . "  where id_revision_objeto = " . $id_revision_objeto . " AND id_empresa = " . $_SESSION['idemp'] . "";
        if (!mysqli_query($pd, $actualizacion1)) {
            die('Error: ' . mysqli_error($pd));
        }
        $actualizacion2 = "update vacante set nombre = '$nombre', salario = '$salario', horario = '$horario', escolaridad='$escolaridad', habilidades='$habilidades', descripcion='$descripcion', tiempo='$tiempo', genero='$genero', rango_edad='$rango_edad', experiencia='$experiencia'  where id_vacante = " . $id_vacante . " AND id_revision_objeto = " . $id_revision_objeto . "";
        if (!mysqli_query($pd, $actualizacion2)) {
            die('Error: ' . mysqli_error($pd));
        }
        else
        {
            echo ("<script> alert('Vacante Actualizada con Exito'); </script>");
        }
        mysqli_close($pd);
        header("Location:https://localhost/campeche-web2/Controller/setVacantes_controller.php");
       
       
    }

}
