<?php

//se incluye la conexion a la base de datos
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');

class obtener_cupon {

    //Se crea el metodo obtener los objetos revisados esto con el objetivo obtener aquellos cupones que han sido colocados por una empresa 
    //en especificos
    public function recibir_id() {
        //Se recibe el dentificador de la empresa de  la clase contenido
        $id_empresa = $_GET['ide'];
        return $id_empresa;
    }

    public function lista_cupones() {
        //Se llama a la case conectar del archivo conexion.php
        $this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
        //Se declara la variable identificador el cual obtendra el id de la empresa el cual se obtiene del metodo lista_ojetos_revisados
        $id_empresa = $_GET['ide'];
        //Se recibe l identificador de la empresa del metodo lista de objetos revisados
        $sql = "select c.id_cupon, c.id_revision_objeto, c.titulo, c.descripcion_corta, c.descripcion_larga, c.id_imagen_extra, c.vigencia_inicio, c.terminos_y_condiciones, c.limite_codigos from (cupon c inner join revision_objeto on c.id_revision_objeto = revision_objeto.id_revision_objeto) inner join empresa on revision_objeto.id_empresa = '$id_empresa' group by titulo;";
        foreach ($this->dbh->query($sql) as $res) {
            $this->platillo[] = $res;
        }
        //return $this->platillo;
        return $this->platillo;
        $this->dbh = null;
    }

    public function registrar_cupon() {
        //Se llama a la clase conectar y a la funcion conectar 
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Primero se genera el identificador de la revision del objeto
        $na = new validacion();
        $idro = $na->generar_aleatorio();
        $iie = $na->generar_alfanumerico();
        //Se reciben los parametros de la vista addcupon
        $id_empresa = $_POST['id_empresa'];
        //Fecha de creacion y hora 
        $fa = $na->fecha_actual();
        $status = 'C';
        $sql = "INSERT INTO revision_objeto(id_revision_objeto,id_empresa,fecha_creacion,status)
        VALUES('$idro','$id_empresa','$fa','$status')";
        if (!mysqli_query($pd, $sql)) {
            die('Error: ' . mysqli_error($pd));
        }
        //A su vez se realiza la insersion en la tabla cupon
        //Se reciben los parametros de la vista de registros
        $titulo = $_POST['titulo'];
        $descripcion_corta = $_POST['descripcion_corta'];
        $descripcion_larga = $_POST['descripcion_larga'];
        //Ruta donde se guardaran las imagenes de los cupones
        $nombreimagen = $_FILES['id_imagen_extra']['name'];
        $nombreimagen = $iie . ".jpg";
        if (move_uploaded_file($_FILES['id_imagen_extra']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/$nombreimagen")) {
            $msg = "El archivo ha sido cargado correctamente.<br>";
        } else {
           $nombreimagen = ""; 
        }
        $nombres = $nombreimagen;
        $vigencia_inicio = $_POST['vigencia_inicio'];
        $vigencia_fin = $_POST['vigencia_fin'];
        $terminos_y_condiciones = $_POST['terminos_y_condiciones'];
        $limite_codigos = $_POST['limite_codigos'];
        //Se genera el identificador del cupon
        $idcu = $na->generar_aleatorio();
        $sql2 = "INSERT INTO cupon (id_cupon,id_revision_objeto,titulo,descripcion_corta,descripcion_larga,id_imagen_extra,vigencia_inicio,vigencia_fin,terminos_y_condiciones,limite_codigos)
        VALUES('$idcu','$idro','$titulo','$descripcion_corta','$descripcion_larga','$nombres','$vigencia_inicio','$vigencia_fin','$terminos_y_condiciones','$limite_codigos')";
        if (!mysqli_query($pd, $sql2)) {
            die('Error: ' . mysqli_error($pd));
        }
        $id = $id_empresa;
        mysqli_close($pd);
        return $id;
    }

    public function eliminar_cupon() {
        //Se llama a la clase conectar y a la funcion conectar 
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Se obtienen los parametros de la vista del cupon
        $id_empresa = $_GET["id_empresa"];
        $id_revision_objeto = $_GET["id_revision_objeto"];
        $id_cupon = $_GET["id_cupon"];
        $imagen = $_GET["id_imagen_extra"];
        $Eliminar = "Delete from revision_objeto where id_revision_objeto = " . $id_revision_objeto . " AND id_empresa = " . $id_empresa . "";
        $Eliminar2 = "Delete from cupon where id_cupon = " . $id_cupon . " and id_revision_objeto = " . $id_revision_objeto . "";
        if (!mysqli_query($pd, $Eliminar2)) {
            die('Error: ' . mysqli_error($pd));
        }
        if (!mysqli_query($pd, $Eliminar)) {
            die('Error: ' . mysqli_error($pd));
        }
        //Se elimina la imagen 
        $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/";
        unlink($ruta . $imagen);
        mysqli_close($pd);
        header("Location:https://localhost/campeche-web2");
    }

    public function actualizar_cupon() {
        //Se llama a la clase conectar y a la funcion conectar 
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Primero se reciben los parametros de la vista actualizar cupon
        //se compara si el parametro id_imagen_ extra esta regresando vacia
        $na = new validacion();
        $iie = $na->generar_alfanumerico();
        $nombreimagen = $_FILES['id_imagen_extra']['name'];
        $nombreanterior = $_POST["id_imagen_anterior"];
        if ($nombreimagen == "") {
            $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/";
            unlink($ruta . $nombreanterior);
        } else {
            $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/";
            unlink($ruta . $nombreanterior);
            $nombreimagen = $_FILES['id_imagen_extra']['name'];
            $nombreimagen = $iie . ".jpg";
            if (move_uploaded_file($_FILES['id_imagen_extra']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/$nombreimagen")) {
                $msg = "El archivo ha sido cargado correctamente.<br>";
            } else {
                die();
            }
        }
        $id_empresa = $_POST["id_empresa"];
        $id_revision_objeto = $_POST["id_revision_objeto"];
        $id_cupon = $_POST["id_cupon"];
        $titulo = $_POST['titulo'];
        $descripcion_corta = $_POST['descripcion_corta'];
        $descripcion_larga = $_POST['descripcion_larga'];
        //Fecha actual
        $año_actual = date("Y");
        $mes_actual = date("m");
        $dia_actual = date("d");
        $hora_actual = date("h");
        $minuto_actual = date("i");
        $segundo_actual = date("s");
        $fecha_actual = $año_actual . "" . $mes_actual . "" . $dia_actual . "" . $hora_actual . "" . $minuto_actual . "" . $segundo_actual;
        if (is_uploaded_file($uploadfile_temporal)) {
            move_uploaded_file($uploadfile_temporal, $uploadfile_nombre);
        } else {
            echo "error";
        }
        $vigencia_inicio = $_POST['vigencia_inicio'];
        $vigencia_fin = $_POST['vigencia_fin'];
        $terminos_y_condiciones = $_POST['terminos_y_condiciones'];
        $nombre = $nombreimagen;
        $limite_codigos = $_POST['limite_codigos'];
        $actulizacion1 = "update revision_objeto set fecha_actualizacion = " . $fecha_actual . "  where id_revision_objeto = " . $id_revision_objeto . " AND id_empresa = " . $id_empresa . "";
        if (!mysqli_query($pd, $actulizacion1)) {
            die('Error: ' . mysqli_error($pd));
        }
        $actulizacion2 = "update cupon set titulo = '$titulo', descripcion_corta = '$descripcion_corta', descripcion_larga = '$descripcion_larga', id_imagen_extra = '$nombre' ,vigencia_inicio = '$vigencia_inicio',vigencia_fin = '$vigencia_fin' , terminos_y_condiciones =  '$terminos_y_condiciones' , limite_codigos =  '$limite_codigos' where id_cupon = " . $id_cupon . " AND id_revision_objeto = " . $id_revision_objeto . "";
        if (!mysqli_query($pd, $actulizacion2)) {
            die('Error: ' . mysqli_error($pd));
        }
        mysqli_close($pd);
        header("Location:https://localhost/campeche-web2");
    }

}

?>