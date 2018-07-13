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
        $sql = "select v.id_video, v.id_revision_objeto, v.titulo, v.descripcion, v.precio, v.fecha_subida, v.id_img_preview, v.id_video_archivo, v.visualizaciones from (video v inner join revision_objeto on v.id_revision_objeto = revision_objeto.id_revision_objeto) inner join empresa on revision_objeto.id_empresa = " . $_SESSION['idemp'] . " group by titulo;";
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
        $this->titulo = $_POST['titulo'];
        $this->descripcion = $_POST['descripcion'];
        $this->precio = $_POST['precio'];
        $nombreimagen = $this->iip . ".jpg";
        //Subir imagen
        if (move_uploaded_file($_FILES['id_img_preview']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Videos/$nombreimagen")) {
            $msg = "El archivo ha sido cargado correctamente.<br>";
        }
        //Subir video
        $nombrevideo = $this->iva . ".mp4";
        if (move_uploaded_file($_FILES['id_video_archivo']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Videos/$nombrevideo")) {
            
        }
        echo $msg = "esto lo hace.<br>";
        $this->visualizaciones = '0.0';
        $insertrevision = "INSERT INTO revision_objeto(id_revision_objeto,id_empresa,fecha_creacion,status)
        VALUES('$this->iro'," . $_SESSION['idemp'] . ",'$this->fa','$this->status')";
        $insertvideo = "INSERT INTO video (id_video,id_revision_objeto,titulo,descripcion,precio,fecha_subida,id_img_preview,id_video_archivo,visualizaciones)
        VALUES('$this->ivi',$this->iro,' $this->titulo','$this->descripcion','$this->precio','  $this->fa','$nombreimagen','$nombrevideo','$this->visualizaciones')";
        echo $msg = "esto todavia lo hace.<br>";
        if (!mysqli_query($this->pd, $insertrevision)) {
            echo $msg = "esto todavia lo hace x2.<br>";
            die('Error: ' . mysqli_error($this->pd));
        }
        if (!mysqli_query($this->pd, $insertvideo)) {
            echo $msg = "esto todavia lo hace x3.<br>";
            die('Error: ' . mysqli_error($this->pd));
        }
        mysqli_close($this->pd);
        header("Location:https://localhost/campeche-web2/Controller/ControladorSitios.php");
    }

    public function eliminar_video() {
        //Se llama a la clase conectar y a la funcion conectar 
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Se obtienen los parametros de la vista del cupon
        $id_revision_objeto = $_GET["id_revision_objeto"];
        $id_video = $_GET["id_video"];
        $imagen = $_GET["id_img_preview"];
        $video = $_GET["id_video_archivo"];
        $Eliminar = "Delete from revision_objeto where id_revision_objeto = " . $id_revision_objeto . " AND id_empresa = '" . $_SESSION['idemp'] . "'";
        $Eliminar2 = "Delete from video where id_video = " . $id_video . " and id_revision_objeto = " . $id_revision_objeto . "";
        if (!mysqli_query($pd, $Eliminar2)) {
            die('Error: ' . mysqli_error($pd));
        }
        if (!mysqli_query($pd, $Eliminar)) {
            die('Error: ' . mysqli_error($pd));
        }
        if ($imagen == "") {
            mysqli_close($pd);
            header("Location:https://localhost/campeche-web2/Controller/ControladorSitios.php");
        } else {//Se elimina la imagen y el video
            $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Videos/";
            $ruta2 = "C:/xampp/htdocs/campeche-web2/Videos/";
            unlink($ruta . $imagen);
            unlink($ruta2 . $video);
            mysqli_close($pd);
            header("Location:https://localhost/campeche-web2/Controller/ControladorSitios.php");
        }
    }

    public function buscar_video() {
        $conn = new Conectar();
        $pd = $conn->con();
        $id_revision_objeto = $_GET['id_revision_objeto'];
        $id_video = $_GET['id_video'];
        $consulta = "SELECT * FROM video WHERE id_video = '$id_video' and id_revision_objeto ='$id_revision_objeto' ";
        $resultado = mysqli_query($pd, $consulta) or die(mysqli_error());
        $fila = mysqli_fetch_array($resultado);
        if (!$fila[0]) {
            echo '<script language = javascript>
	alert("Este video no se puede modificar")
           self.location = "https://localhost/campeche-web2/Controller/crtcVideos.php"
	</script>';
        } else {
            $id_video = $fila['id_video'];
            $id_revision_objeto = $fila['id_revision_objeto'];
            $titulo = $fila['titulo'];
            $descripcion = $fila['descripcion'];
            $precio = $fila['precio'];
            $id_img_preview = $fila['id_img_preview'];
            $id_video_archivo = $fila['id_video_archivo'];
        }
        return array($id_video, $id_revision_objeto, $titulo, $descripcion, $precio, $id_img_preview, $id_video_archivo);
    }

    public function actualizar_video(){
        $conn = new Conectar();
        $pd = $conn->con();
        $na = new validacion();
        $iie = $na->generar_alfanumerico();
        $iav = $na->generar_alfanumerico();
        $nombreimagen = $_FILES['id_img_preview']['name'];
        $nombreanteriori = $_POST["id_imagen_anterior"];
        $nombrevideo = $_FILES['id_video_archivo']['name'];
        $nombreanteriorv = $_POST["id_video_antetior"];
        if ($nombreimagen == "") {
            $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Videos/";
            unlink($ruta . $nombreanteriori);
        } else {
            $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Videos/";
            unlink($ruta . $nombreanteriori);
            $nombreimagen = $_FILES['id_img_preview']['name'];
            $nombreimagen = $iie . ".jpg";
            if (move_uploaded_file($_FILES['id_img_preview']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Videos/$nombreimagen")) {
                $msg = "El archivo ha sido cargado correctamente.<br>";
            } else {
                die();
            }
        }
        if ($nombrevideo == "") {
            $ruta = "C:/xampp/htdocs/campeche-web2/Videos/";
            unlink($ruta . $nombreanteriorv);
        }
        else {
            $ruta = "C:/xampp/htdocs/campeche-web2/Videos/";
            unlink($ruta . $nombreanteriorv);
            $nombrevideo = $_FILES['id_video_archivo']['name'];
            $nombrevideo = $iav . ".mp4";
            if (move_uploaded_file($_FILES['id_video_archivo']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Videos/$nombrevideo")) {
                $msg = "El video ha sido cargado correctamente.<br>";
            } else {
                die();
            }
        }
        $id_empresa = $_POST["id_empresa"];
        $id_revision_objeto = $_POST["id_revision_objeto"];
        $id_video = $_POST["id_video"];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        //Fecha actual
        $año_actual = date("Y");
        $mes_actual = date("m");
        $dia_actual = date("d");
        $hora_actual = date("h");
        $minuto_actual = date("i");
        $segundo_actual = date("s");
        $fecha_actual = $año_actual . "" . $mes_actual . "" . $dia_actual . "" . $hora_actual . "" . $minuto_actual . "" . $segundo_actual;
        $precio = $_POST['precio'];
        $nombre = $nombreimagen;
        $nombrevid = $nombrevideo;
        $actulizacion1 = "update revision_objeto set fecha_actualizacion = " . $fecha_actual . "  where id_revision_objeto = " . $id_revision_objeto . " AND id_empresa = " . $_SESSION['idemp'] . "";
        if (!mysqli_query($pd, $actulizacion1)) {
            die('Error: ' . mysqli_error($pd));
        }
        $actulizacion2 = "update video set titulo = '$titulo', descripcion = '$descripcion', precio = '$precio', id_img_preview = '$nombre' ,id_video_archivo = '$nombrevid' where id_video = " . $id_video . " AND id_revision_objeto = " . $id_revision_objeto . "";
        if (!mysqli_query($pd, $actulizacion2)) {
            die('Error: ' . mysqli_error($pd));
        }
        mysqli_close($pd);
       header("Location:https://localhost/campeche-web2/Controller/ControladorSitios.php");
    }

}

?>