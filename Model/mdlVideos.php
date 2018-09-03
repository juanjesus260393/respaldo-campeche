<?php

//se incluye la conexion a la base de datos
require_once('Conexion.php');
require_once('mdlTurista.php');
require_once('../scripts/Validaciones.php');
include_once('../Librerias/getID3-1.9.15/getid3/getid3.php');

class Videos {

    private $platillo;
    private $dbh;

    public function lista_videos() {
//Se llama a la case conectar del archivo conexion.php
        $this->dbh = Conectar::con();
        // $this->dbh = new PDO('mysql:host=127.0.0.1:3306;dbname=campeche', "root", "P4SSW0RD");
//Se declara la variable identificador el cual obtendra el id de la empresa el cual se obtiene del metodo lista_ojetos_revisados
//Se recibe l identificador de la empresa del metodo lista de objetos revisados
        $sql = "select v.id_video, v.id_revision_objeto, v.titulo, v.descripcion, v.precio, v.fecha_subida, v.id_img_preview, v.id_video_archivo, v.visualizaciones from (video v inner join revision_objeto on v.id_revision_objeto = revision_objeto.id_revision_objeto) inner join empresa on revision_objeto.id_empresa = " . $_SESSION['idemp'] . " group by titulo;";
        if ($this->dbh->query($sql) == NULL) {
            $this->platillo[] = NULL;
        } else {
            foreach ($this->dbh->query($sql) as $res) {
                $this->platillo[] = $res;
            }
        }
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
        $limite = "09:59";
        //Subir video
        $nombrevideo = $this->iva . ".mp4";
        //Primero se sube el video
        if (move_uploaded_file($_FILES['id_video_archivo']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Videos/$nombrevideo")) {
            $filename = "C:/xampp/htdocs/campeche-web2/Videos/$nombrevideo";
            $getID3 = new getID3;
            $file = $getID3->analyze($filename);
            $tiempo_video = $file['playtime_string'];
            $newcadena = '00:' . $tiempo_video;
            $endtime = gmdate('i:s', strtotime('00:' . $tiempo_video));
            //Una ves que se yha subido se comprueba la resolucion del mismo
            if ($file['video']['resolution_x'] > 1920 && $file['video']['resolution_y'] > 1080) {
                //Si la resolucion no es la indicada se elimina el video que se acaba de subir al servidor, y se regresa a la pagina anterior
                $ruta = "C:/xampp/htdocs/campeche-web2/Videos/";
                unlink($ruta . $nombrevideo);
                echo '<script language = javascript> alert("La Resolucion no es la indicada selecciona otro video o reduce la calidad del mismo.") </script>';
                //Regresamos a la pagina anterior
                echo "<html><head></head>" .
                "<body onload=\"javascript:history.back()\">" .
                "</body></html>";
                exit;
            }
            if ($endtime > $limite) {
                //Si la resolucion no es la indicada se elimina el video que se acaba de subir al servidor, y se regresa a la pagina anterior
                $ruta = "C:/xampp/htdocs/campeche-web2/Videos/";
                unlink($ruta . $nombrevideo);
                echo '<script language = javascript> alert("El video tiene que durar menos de 10 minutos.") </script>';
                //Regresamos a la pagina anterior
                echo "<html><head></head>" .
                "<body onload=\"javascript:history.back()\">" .
                "</body></html>";
                exit;
            }
        }
        //Depues se sube la imagen 
        $nombreimagen = $this->iip . ".jpg";
        //Subir imagen
        if (move_uploaded_file($_FILES['id_img_preview']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Videos/$nombreimagen")) {
            $filename = "C:/xampp/htdocs/campeche-web2/Imagenes/Videos/$nombreimagen";
            $getID3 = new getID3;
            $file = $getID3->analyze($filename);
            //Una ves que se yha subido se comprueba la resolucion del mismo
            if ($file['video']['resolution_x'] > 1280 && $file['video']['resolution_y'] > 720) {
                //Si la resolucion no es la indicada se elimina el video que se acaba de subir al servidor, y se regresa a la pagina anterior
                $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Videos/";
                unlink($ruta . $nombreimagen);
                $ruta2 = "C:/xampp/htdocs/campeche-web2/Videos/";
                unlink($ruta2 . $nombrevideo);
                echo '<script language = javascript> alert("El tamaño de la imagen no es el indicado seleciona otra o reduce su tamaño") </script>';
                //Regresamos a la pagina anterior
                echo "<html><head></head>" .
                "<body onload=\"javascript:history.back()\">" .
                "</body></html>";
                exit;
            }
        }
        $this->visualizaciones = '0.0';
        $insertrevision = "INSERT INTO revision_objeto(id_revision_objeto,id_empresa,fecha_creacion,fecha_actualizacion,status)
        VALUES('$this->iro'," . $_SESSION['idemp'] . ",'$this->fa','0000-00-00','$this->status')";
        $insertvideo = "INSERT INTO video (id_video,id_revision_objeto,titulo,descripcion,precio,duracion,fecha_subida,id_img_preview,id_video_archivo,visualizaciones)
        VALUES('$this->ivi',$this->iro,' $this->titulo','$this->descripcion','$this->precio','$newcadena','$this->fa','$this->iip','$this->iva','$this->visualizaciones')";
        if (!mysqli_query($this->pd, $insertrevision)) {
            die('Error: ' . mysqli_error($this->pd));
        }
        if (!mysqli_query($this->pd, $insertvideo)) {
            die('Error: ' . mysqli_error($this->pd));
        }
        mysqli_close($this->pd);
        header("Location:https://localhost/campeche-web2/Controller/crtcVideos.php");
    }

    public function eliminar_video() {
        //Se llama a la clase conectar y a la funcion conectar 
        $conn = new Conectar();
        //se llama a la funcion con para obtener la variable conexion la cual sera utilizada para ejecutar la sentencia sql
        $pd = $conn->con();
        //Se obtienen los parametros de la vista del cupon
        $id_revision_objeto = $_GET["id_revision_objeto"];
        $id_video = $_GET["id_video"];
        if ($id_revision_objeto == NULL && $id_video == NULL) {
            echo '<script language = javascript> alert("No es un elemento valido de los videos") </script>';
            //Regresamos a la pagina anterior
            echo "<html><head></head>" .
            "<body onload=\"javascript:history.back()\">" .
            "</body></html>";
        }
        $extv = '.mp4';
        $exti = '.jpg';
        $imagen = $_GET["id_img_preview"] . $exti;
        $video = $_GET["id_video_archivo"] . $extv;
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
            header("Location:https://localhost/campeche-web2/Controller/IniciodeSesion.php");
        } else {//Se elimina la imagen y el video
            $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Videos/";
            $ruta2 = "C:/xampp/htdocs/campeche-web2/Videos/";
            unlink($ruta . $imagen);
            unlink($ruta2 . $video);
            mysqli_close($pd);
            header("Location:https://localhost/campeche-web2/Controller/IniciodeSesion.php");
        }
    }

    public function buscar_video() {
        $conn = new Conectar();
        $pd = $conn->con();
        $id_video = $_POST['id_video'];
        $consulta = "SELECT * FROM video c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto WHERE c.id_video = '$id_video' and r.status = 'C' or r.status = 'R'";
        $resultado = mysqli_query($pd, $consulta) or die(mysqli_error());
        $fila = mysqli_fetch_array($resultado);
        if (!$fila[0]) {
            echo '<script language = javascript> alert("No es un elemento valido de los videos") </script>';
            //Regresamos a la pagina anterior
            echo "<html><head></head>" .
            "<body onload=\"javascript:history.back()\">" .
            "</body></html>";
            $id_video = '';
            $id_revision_objeto = '';
            $titulo = '';
            $descripcion = '';
            $precio = '';
            $id_img_preview = '';
            $id_video_archivo = '';
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

    public function actualizar_video() {
        $conn = new Conectar();
        $pd = $conn->con();
        $na = new validacion();
        $iie = $na->generar_alfanumerico();
        $iav = $na->generar_alfanumerico();
        $extv = '.mp4';
        $exti = '.jpg';
        $nombreimagen = $_FILES['id_img_preview']['name'];
        $nombreanteriori = $_POST["id_imagen_anterior"] . $exti;
        $nombrevideo = $_FILES['id_video_archivo']['name'];
        $nombreanteriorv = $_POST["id_video_antetior"] . $extv;
        $limite = "09:59";
        $nombrevideo = $iav . ".mp4";
        // se sube el video para realizar las validaciones correspondientes
        if (move_uploaded_file($_FILES['id_video_archivo']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Videos/$nombrevideo")) {
            $filename = "C:/xampp/htdocs/campeche-web2/Videos/$nombrevideo";
            $getID3 = new getID3;
            $file = $getID3->analyze($filename);
            $tiempo_video = $file['playtime_string'];
            $newcadena = '00:' . $tiempo_video;
            $endtime = gmdate('i:s', strtotime('00:' . $tiempo_video));
            //Una ves que se ya subido se comprueba la resolucion del mismo
            if ($file['video']['resolution_x'] > 1920 && $file['video']['resolution_y'] > 1080) {
                //Si la resolucion no es la indicada se elimina el video que se acaba de subir al servidor, y se regresa a la pagina anterior
                $ruta = "C:/xampp/htdocs/campeche-web2/Videos/";
                unlink($ruta . $nombrevideo);
                echo "<script>
                alert('La resolucion del video tiene que ser menor a 1920 x 1080');
                window.location= '../Controller/crtcVideos.php'
    </script>";
                exit();
            }
            if ($endtime > $limite) {
                //Si la resolucion no es la indicada se elimina el video que se acaba de subir al servidor, y se regresa a la pagina anterior
                $ruta = "C:/xampp/htdocs/campeche-web2/Videos/";
                unlink($ruta . $nombrevideo);
                echo "<script>
                alert('El video tiene que durar menos de 10 minutos');
                window.location= '../Controller/crtcVideos.php'
    </script>";
                exit();
            }
        }
        // se sube la imagen y se valida su resolucion
        $nombreimagen = $iie . ".jpg";
        if (move_uploaded_file($_FILES['id_img_preview']['tmp_name'], "C:/xampp/htdocs/campeche-web2/Imagenes/Videos/$nombreimagen")) {
            $filename = "C:/xampp/htdocs/campeche-web2/Imagenes/Videos/$nombreimagen";
            $getID3 = new getID3;
            $file = $getID3->analyze($filename);
            //Una ves que se yha subido se comprueba la resolucion del mismo
            if ($file['video']['resolution_x'] > 1280 && $file['video']['resolution_y'] > 720) {
                //Si la resolucion no es la indicada se elimina el video que se acaba de subir al servidor, y se regresa a la pagina anterior
                $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Videos/";
                unlink($ruta . $nombreimagen);
                $ruta2 = "C:/xampp/htdocs/campeche-web2/Videos/";
                unlink($ruta2 . $nombrevideo);
                echo "<script>
                alert('La resolucion de la imagen tiene que ser menor a 1280 x 720');
                window.location= '../Controller/crtcVideos.php'
    </script>";
                exit();
            }
        }
        //Cuando el video y la imagen se suben corectamente se realiza el cambio en la base de datos y en las carpetas correspondientes
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
        $actulizacion2 = "update video set titulo = '$titulo', descripcion = '$descripcion', precio = '$precio', duracion = '$newcadena',id_img_preview = '$iie' ,id_video_archivo = '$iav' where id_video = " . $id_video . " AND id_revision_objeto = " . $id_revision_objeto . "";
        if (!mysqli_query($pd, $actulizacion2)) {
            die('Error: ' . mysqli_error($pd));
        }
        mysqli_close($pd);
        header("Location:https://localhost/campeche-web2/Controller/crtcVideos.php");
        //Se elimina el video y la imagen anteriores
        $ruta = "C:/xampp/htdocs/campeche-web2/Imagenes/Videos/";
        unlink($ruta . $nombreanteriori);
        $ruta2 = "C:/xampp/htdocs/campeche-web2/Videos/";
        unlink($ruta2 . $nombreanteriorv);
    }

}

?>