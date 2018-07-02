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
        $auxiliar = new obtener_cupon();
        //Se recibe l identificador de la empresa del metodo lista de objetos revisados
        $sql = "select * from cupon";
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
        //Se reciben los parametros de la vista addcupon
        $id_empresa = $_POST['id_empresa'];
        //Fecha de creacion y hora 
        $año_actual = date("y");
        $mes_actual = date("m");
        $dia_actual = date("d");
        $hora_actual = date("h");
        $minuto_actual = date("i");
        $segundo_actual = date("s");
        $fecha_actual = $año_actual . "-" . $mes_actual . "-" . $dia_actual . " " . $hora_actual . ":" . $minuto_actual . ":" . $segundo_actual;
        $status = 'C';
        $sql = "INSERT INTO revision_objeto(id_revision_objeto,id_empresa,fecha_creacion,status)
        VALUES('$idro','$id_empresa','$fecha_actual','$status')";
        if (!mysqli_query($pd, $sql)) {
            die('Error: ' . mysqli_error($pd));
        }
        //A su vez se realiza la insersion en la tabla cupon
        //Se reciben los parametros de la vista de registros
        $titulo = $_POST['titulo'];
        $descripcion_corta = $_POST['descripcion_corta'];
        $descripcion_larga = $_POST['descripcion_larga'];
        //Ruta donde se guardaran las imagenes de los cupones
        $ruta="C:/xampp/htdocs/campeche-web2/Imagenes/Cupones/";
        $uploadfile_temporal = $_FILES['id_imagen_extra']['tmp_name'];
        $uploadfile_nombre = $ruta . $_FILES['id_imagen_extra']['name'];

        if (is_uploaded_file($uploadfile_temporal)) {
            move_uploaded_file($uploadfile_temporal, $uploadfile_nombre);
        } else {
            echo "error";
        }
        $id_imagen_extra = 'prueba.jpg';
        $vigencia = $_POST['vigencia'];
        $terminos_y_condiciones = $_POST['terminos_y_condiciones'];
        //Se genera el identificador del cupon
        $idcu = $na->generar_aleatorio();
        $sql2 = "INSERT INTO cupon (id_cupon,id_revision_objeto,titulo,descripcion_corta,descripcion_larga,id_imagen_extra,vigencia,terminos_y_condiciones)
        VALUES('$idcu','$idro','$titulo','$descripcion_corta','$descripcion_larga','$id_imagen_extra','$vigencia','$terminos_y_condiciones')";
        if (!mysqli_query($pd, $sql2)) {
            die('Error: ' . mysqli_error($pd));
        }
        $id = $id_empresa;
        return $id;
    }

}

?>