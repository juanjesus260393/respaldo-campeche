<?php

//se incluye la conexion a la base de datos
require_once('Conexion.php');
require_once('../scripts/Validaciones.php');

class Videos {

    public function lista_videos() {
//Se llama a la case conectar del archivo conexion.php
        $this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
//Se declara la variable identificador el cual obtendra el id de la empresa el cual se obtiene del metodo lista_ojetos_revisados
//Se recibe l identificador de la empresa del metodo lista de objetos revisados
        $sql = "select v.id_video, v.id_revision_objeto, v.titulo, v.descripcion, v.precio, v.fecha_subida, v.id_img_preview, v.id_video_archivo, v.status, v.visualizaciones from (video v inner join revision_objeto on v.id_revision_objeto = revision_objeto.id_revision_objeto) inner join empresa on revision_objeto.id_empresa = " . $_SESSION['idemp'] . " group by titulo;";
        if ($this->dbh->query($sql) == NULL) {
            return null;
        } else {
            foreach ($this->dbh->query($sql) as $res) {
                $this->platillo[] = $res;
            }
        }
//return $this->platillo;
        return $this->platillo;
    }

    public function registrar_videos() {
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
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $nombreimagen = $this->iip . ".jpg";
        //Subir imagen
        if (move_uploaded_file($_FILES['id_img_preview']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Videos/$nombreimagen")) {
            $msg = "El archivo ha sido cargado correctamente.<br>";
        } else {
            $nombreimagen = "";
        }
        //Subir video
         $nombrevideo = $this->iva. ".mp4";
        if (move_uploaded_file($_FILES['id_video_archivo']['name'], "C:/xampp/htdocs/campeche-web2/Videos/$nombrevideo")) {
            $msg = "El archivo ha sido cargado correctamente.<br>";
        } else {
            $nombrevideo = "";
        }
        $inserttbvandrb = "INSERT INTO revision_objeto(id_revision_objeto,id_empresa,fecha_creacion,status)
        VALUES('$this->iro'," . $_SESSION['idemp'] . ",'$this->fa','$this->fa') 
        INSERT INTO video(id_revision_objeto,id_empresa,fecha_creacion,status)
        VALUES('$this->iro'," . $_SESSION['idemp'] . ",'$this->fa','$this->fa') ";
    }

}

?>