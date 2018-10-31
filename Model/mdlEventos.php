<?php

//se incluye la conexion a la base de datos
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');
include_once('../Librerias/getID3-1.9.15/getid3/getid3.php');

class Eventos {

    private $platillo;
    private $dbh;

    public function lista_eventos() {
//Se llama a la case conectar del archivo conexion.php
        $this->dbh = Conectar::con();
       //Se declara la variable identificador el cual obtendra el id de la empresa el cual se obtiene del metodo lista_ojetos_revisados
//Se recibe l identificador de la empresa del metodo lista de objetos revisados
        $sql = "select v.id_vacante, v.id_revision_objeto, v.nombre, v.salario, v.horario, v.escolaridad, v.habilidades, v.descripcion, v.tiempo, v.genero, v.experiencia, v.rango_edad, revision_objeto.status from (vacante v inner join revision_objeto on v.id_revision_objeto = revision_objeto.id_revision_objeto) inner join empresa on revision_objeto.id_empresa = " . $_SESSION['idemp'] . " group by nombre;";
        if ($this->dbh->query($sql) == NULL) {
            $this->platillo[] = NULL;
        } else {
            foreach ($this->dbh->query($sql) as $res) {
                $this->platillo[] = $res;
            }
        }
        return $this->platillo;
    }

    public function registrar_vacantes() {
//Se llama a la clase conectar y a la funcion conectar 
        $conn = new Conectar();
//se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $this->pd = $conn->con();
//Primero se genera el identificador de la revision del objeto
        $validacion = new validacion();
        $this->ivi = $validacion->generar_aleatorio();
        $this->iro = $validacion->generar_aleatorio();
        $this->iip = $validacion->generar_alfanumerico();
        $this->iva = $validacion->generar_alfanumerico();
//Fecha de creacion y hora 
        $this->fa = $validacion->fecha_actual();
        $this->status = 'C';
//Se reciben los parametros del formulario 
        $this->nombre = $_POST['nombre'];
        $this->salario = $_POST['salario'];
        $this->horario = $_POST['horario'];
        $this->escolaridad = $_POST['escolaridad'];
        $this->habilidades = $_POST['habilidades'];
        $this->descripcion = $_POST['descripcion'];
        $this->tiempo = $_POST['tiempo'];
        $this->genero = $_POST['genero'];
        $this->rangoedad= $_POST['rangoedad'];
        $this->experiencia = $_POST['experiencia'];
                     
        
        $this->visualizaciones = '0.0';
        $insertrevision = "INSERT INTO revision_objeto(id_revision_objeto,id_empresa,fecha_creacion,fecha_actualizacion,status)
        VALUES('$this->iro'," . $_SESSION['idemp'] . ",'$this->fa','0000-00-00','$this->status')";
        $insertvacante = "INSERT INTO vacante(id_vacante,id_revision_objeto,nombre,salario,horario,escolaridad,habilidades,descripcion,tiempo,genero,rango_edad,experiencia,fecha)
        VALUES('$this->ivi',$this->iro,' $this->nombre','$this->salario','$this->horario','$this->escolaridad','$this->habilidades','$this->descripcion','$this->tiempo','$this->genero','$this->rangoedad','$this->experiencia', '$this->fa')";
        if (!mysqli_query($this->pd, $insertrevision)) {
            die('Error: ' . mysqli_error($this->pd));
        }
        if (!mysqli_query($this->pd, $insertvacante)) {
            die('Error: ' . mysqli_error($this->pd));
        }
        mysqli_close($this->pd);
        header("Location:https://localhost/campeche-web2/Controller/crtcVacantes.php");
    }

    public function eliminar_vacantes() {
        //Se llama a la clase conectar y a la funcion conectar 
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Se obtienen los parametros de la vista del cupon
        $id_revision_objeto = $_GET["id_revision_objeto"];
        $id_vacante = $_GET["id_vacante"];
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
       
    }

    public function buscar_vacante() {
        $conn = new Conectar();
        $pd = $conn->con();
        $id_vacante = $_POST['id_vacante'];
        $consulta = "SELECT * FROM vacante c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto WHERE c.id_vacante = '$id_vacante' and r.status = 'C' or r.status = 'R'";
        $resultado = mysqli_query($pd, $consulta) or die(mysqli_error());
        $fila = mysqli_fetch_array($resultado);
        if (!$fila[0]) {
            echo '<script language = javascript> alert("No es un elemento valido de alguna Vacante") </script>';
            //Regresamos a la pagina anterior
            echo "<html><head></head>" .
            "<body onload=\"javascript:history.back()\">" .
            "</body></html>";
            $id_vacante = '';
            $id_revision_objeto = '';
            $nombre = '';
            $salario = '';
            $horario = '';
        } else {
            $id_vacante = $fila['id_vacante'];
            $id_revision_objeto = $fila['id_revision_objeto'];
            $nombre = $fila['nombre'];
            $salario = $fila['salario'];
            $horario = $fila['horario'];
            $escolaridad= $fila['escolaridad'];
            $habilidades= $fila['habilidades'];
            $descripcion= $fila['descripcion'];
            $tiempo= $fila['tiempo'];
            $genero= $fila['genero'];
            $rango_edad= $fila['rango_edad'];
            $experiencia= $fila['experiencia'];
            $status=$fila['status'];
           
        }
        return array($id_vacante, $id_revision_objeto, $nombre, $salario, $horario, $escolaridad, $habilidades, $descripcion, $tiempo, $genero, $rango_edad, $experiencia, $status);
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
        $experiencia= $_POST['experiencia'];

        //Fecha actual
        $año_actual = date("Y");
        $mes_actual = date("m");
        $dia_actual = date("d");
        $hora_actual = date("h");
        $minuto_actual = date("i");
        $segundo_actual = date("s");
        $fecha_actual = $año_actual . "" . $mes_actual . "" . $dia_actual . "" . $hora_actual . "" . $minuto_actual . "" . $segundo_actual;
        
        $actualizacion1 = "update revision_objeto set fecha_actualizacion = " . $fecha_actual . "  where id_revision_objeto = " . $id_revision_objeto . " AND id_empresa = " . $_SESSION['idemp'] . "";
        if (!mysqli_query($pd, $actualizacion1)) {
            die('Error: ' . mysqli_error($pd));
        }
        $actualizacion2 = "update vacante set nombre = '$nombre', salario = '$salario', horario = '$horario', escolaridad='$escolaridad', habilidades='$habilidades', descripcion='$descripcion', tiempo='$tiempo', genero='$genero', rango_edad='$rango_edad', experiencia='$experiencia'  where id_vacante = " . $id_vacante . " AND id_revision_objeto = " . $id_revision_objeto . "";
        if (!mysqli_query($pd, $actualizacion2)) {
            die('Error: ' . mysqli_error($pd));
        }
        mysqli_close($pd);
        header("Location:https://localhost/campeche-web2/Controller/crtcVacantes.php");
       
       
    }

}

?>