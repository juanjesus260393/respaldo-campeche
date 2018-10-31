<?php

require_once ('../vendor/autoload.php');

use \Statickidz\GoogleTranslate;

class setSitios_model {

    private $db;
    private $sitios;
    private $isitio;

    public function __construct() {
        $this->db = Conectar::con();
        $this->sitios = array();
        $this->sitiofinal = array();
        $this->isitio = array();
        $this->municipo = array();
    }

    public function get_sitios() {

        $selectSitios = ("SELECT S.id_municipio, S.id_sitio, S.nombre, S.direccion, S.horario, RI.url_sitio_web, RI.status , M.nombre, "
                . "S.telefono1, S.telefono2, S.capacidad, DATE(RI.fecha_creacion), DATE(RI.fecha_actualizacion), RI.id_imagen_perfil, "
                . "RI.id_carta, ST_X(RI.ubicacionGIS), ST_Y(RI.ubicacionGIS), RI.id_revision_informacion, M.id_municipio "
                . "FROM sitio S INNER JOIN revision_informacion RI ON S.id_sitio=RI.id_sitio INNER JOIN municipio M ON S.id_municipio=M.id_municipio WHERE S.id_empresa = " . $_SESSION['idemp'] . "");

        $ressit = $this->db->query($selectSitios);


        $a = 0;
        while ($filas = $ressit->fetch_row()) {
            $this->sitios[] = $filas;
            $a++;
        }

        $this->sitiofinal = self::getdescripciones($this->sitios, $a);

        $this->sitiofinal = self::getGaleria($this->sitiofinal, $a);

        $ressit->close();
        // $this->db->close();

        return $this->sitiofinal;
    }

    public function getdescripciones($sitioaux, $a) {

        for ($i = 0; $i < $a; $i++) {
            $sqldesc = "SELECT descripcion_corta, descripcion_larga FROM descripcion_idioma WHERE id_revision_informacion=" . $sitioaux[$i][17] . " ORDER BY lang_code";
            $ressitaux = $this->db->query($sqldesc);
            while ($filass = $ressitaux->fetch_row()) {


                array_push($sitioaux[$i], $filass[0]);
                array_push($sitioaux[$i], $filass[1]);
            }
        }
        return $sitioaux;
    }

    public function getGaleria($sitioaux, $a) {

        for ($i = 0; $i < $a; $i++) {
            $x = 0;
            $sqldesc = "SELECT id_archivo_imagen FROM imagen_galeria WHERE id_revision_informacion=" . $sitioaux[$i][17] . " ";
            $ressitaux = $this->db->query($sqldesc);
            while ($filass = $ressitaux->fetch_row()) {

                array_push($sitioaux[$i], $filass[0] . ".jpg");
                $x++;
            }
            while ($x < 6) {
                array_push($sitioaux[$i], "sin.jpg");
                $x++;
            }
        }

        return $sitioaux;
    }

    public function get_municipios() {

        $sqlconsulta = ("SELECT m.id_municipio, m.nombre FROM municipio m WHERE 1");

        $resultado = $this->db->query($sqlconsulta);
        while ($filas = $resultado->fetch_row()) {
            $this->municipio[] = $filas;
        }

        $resultado->close();
        //$this->db->close();

        return $this->municipio;
    }

    public function add_sitio() {
        $idsitio = $_POST['idsitioo'];
        $idrev = $_POST['idrev'];
         $nombre = addslashes($_POST['nombreSitio']);
        $municipios = (int) $_POST['municipios'];
        $url = $_POST['urlsitio'];
        $tel1 = (int) $_POST['tel1'];
        $tel2 = (int) $_POST['tel2'];
        $dir = htmlspecialchars($_POST['dir']);
        $capacidad = (int) $_POST['tam'];
        $posx = $_POST['cordx'];
        $posy = $_POST['cordy'];
        $point = "PointFromText('POINT(" . $posx . " " . $posy . ")')";
        $hora = $_POST['horario'];
       $descCortaES = $_POST['descripcion_cortaES'];
        $descLargaES = htmlspecialchars($_POST['descripcion_largaES']);

        $imageP = $_POST['idperfilaux'];

        $cartaC = $_POST['idcartaaux'];

        $imgh1 = $_POST['imgh1'];
        $imgh2 = $_POST['imgh2'];
        $imgh3 = $_POST['imgh3'];
        $imgh4 = $_POST['imgh4'];
        $imgh5 = $_POST['imgh5'];

        $pathperfil = "../Imagenes/Sitios/img/";
        $pathGaleria = '../Imagenes/Galeria/';
        $pathcarta = "../Imagenes/Sitios/carta/";
        $valid_formatsimg = array("jpg"); //extensiones permitidas para imagenes
        $valid_formatscarta = array("pdf"); //extensiones permitidas para cartas

        if ($_FILES['idperfilSet']['error'] === 4) {

            $actual_image_name = $imageP;
        } else {

            $id_perfil = $_FILES['idperfilSet']['name']; //input file name in this code is file1
            $fileInfoPerfil = pathinfo($id_perfil);
            $extPerfil = $fileInfoPerfil['extension'];

            if (in_array($extPerfil, $valid_formatsimg)) {

                $auxp = random_bytes(12);

                $actual_image_name = substr(bin2hex($auxp), 0, 12);

                $tmp1 = $_FILES['idperfilSet']['tmp_name'];

                if (move_uploaded_file($tmp1, $pathperfil . $actual_image_name . "." . $extPerfil)) {
                    $actual_image_name = $actual_image_name . '.' . $extPerfil;
                } else {
                    echo "failed";
                }
            }
        }


        if ($_FILES['idcartaSet']['error'] === 4) {
            $actual_carta_name = $cartaC;
        } else {

            $id_carta = $_FILES['idcartaSet']['name'];
            $fileInfoCarta = pathinfo($id_carta);
            $extCarta = $fileInfoCarta['extension'];

            if (in_array($extCarta, $valid_formatscarta)) {

                $auxc = random_bytes(12);

                $actual_carta_name = substr(bin2hex($auxc), 0, 12);

                $tmp3 = $_FILES['idcartaSet']['tmp_name'];

                if (move_uploaded_file($tmp3, $pathcarta . $actual_carta_name . "." . $extCarta)) {
                    $actual_carta_name = $actual_carta_name . '.' . $extCarta;
                } else {
                    echo "failed carta";
                }
            }
        }

        //$size = $_FILES['id_perfil']['size'];



        $source = 'ES';
        $target1 = 'EN';
        $target2 = 'FR';


        $trans = new GoogleTranslate();
        $descCortaIngles2 = addslashes($trans->translate($source, $target1, $descCortaES));
        $descCortaFrances2 = addslashes($trans->translate($source, $target2, $descCortaES));

        $descLargaIngles2 = addslashes($trans->translate($source, $target1, $descLargaES));
        $descLargaFrances2 = addslashes($trans->translate($source, $target2, $descLargaES));

       /* $descLargaFrances2 = str_replace("'", "''", $descLargaFrances);
        $descCortaFrances2 = str_replace("'", "''", $descCortaFrances);
        $descLargaIngles2 = str_replace("'", "''", $descLargaIngles);
        $descCortaIngles2 = str_replace("'", "''", $descCortaIngles);*/



        $idunicositio = 0;
        $aux = $_SESSION['idemp'] . uniqid();
        $a = str_split($aux);

        $i = 0;
        for ($i; $i < count($a); $i++) {
            $idunicositio += ord($a[$i]);
        }

        $idunicoRev = $idunicositio + 5;

        date_default_timezone_set('America/Mexico_City');

        $hoy = date("Y-m-d H:i:s");


        $sqlinsert = ("UPDATE sitio SET id_municipio='" . $municipios . "', nombre='" . $nombre . "', direccion='" . $dir . "', telefono1=" . $tel1
                . ", telefono2=" . $tel2 . ", capacidad=" . $capacidad . ", horario='" . $hora . "' WHERE id_sitio=" . $idsitio . " ");
        $agregado = $this->db->query($sqlinsert);

    
        if ($agregado) {
            $sqlinsert2 = ("UPDATE revision_informacion SET status='C', url_sitio_web='" . $url . "', id_imagen_perfil='" . $actual_image_name . "' "
                    . ", id_carta='" . $actual_carta_name . "', ubicacionGIS=" . $point . " WHERE id_revision_informacion=" . $idrev . "");
            $revagregada = $this->db->query($sqlinsert2);
            if ($revagregada) {
                $sqlinsertES = ("UPDATE descripcion_idioma SET descripcion_larga='" . $descLargaES . "', descripcion_corta='" . $descCortaES . "'"
                        . "WHERE id_revision_informacion='" . $idrev . "' AND lang_code='ES'");
                $agregadoEsp = $this->db->query($sqlinsertES);
                $sqlinsertEn = ("UPDATE descripcion_idioma SET descripcion_larga='" . $descLargaIngles2 . "', descripcion_corta='" . $descCortaIngles2 . "'"
                        . "WHERE id_revision_informacion='" . $idrev . "' AND lang_code='EN'");
                $agregadoIng = $this->db->query($sqlinsertEn);
                $sqlinsertFr = ("UPDATE descripcion_idioma SET descripcion_larga='" . $descLargaFrances2 . "', descripcion_corta='" . $descCortaFrances2 . "'"
                        . "WHERE id_revision_informacion='" . $idrev . "' AND lang_code='FR'");
                $agregadoFr = $this->db->query($sqlinsertFr);

                if ($agregadoEsp && $agregadoIng && $agregadoFr) {
                    echo ("<script> alert('Nuevo modificado con exito'); </script>");
                } else {
                    printf("Errormessage: %s\n", $this->db->error);
                }
            } else {
                printf("Errormessage: %s\n", $this->db->error);
            }
        } else {
            printf("Errormessage: %s\n", $this->db->error);
        }


        if ($_FILES['file1']['error'] === 0) {

            $fileInfofile1 = pathinfo($_FILES['file1']['name']);
            $extfile1 = $fileInfofile1['extension'];

            if (in_array($extfile1, $valid_formatsimg)) {

                $aux1 = random_bytes(12);
                $actual_file1_name = substr(bin2hex($aux1), 0, 12);

                $tmp1 = $_FILES['file1']['tmp_name'];
                if (move_uploaded_file($tmp1, $pathGaleria . $actual_file1_name . "." . $extfile1)) {
                    $insertfile1 = ("INSERT INTO imagen_galeria (id_archivo_imagen, id_revision_informacion) VALUES ('" . $actual_file1_name . "'," . $idrev . ")");
                    $agregado = $this->db->query($insertfile1);

                    if ($agregado) {
                        $imgaux = substr($imgh1, 0, 12);
                        $deletefile1 = ("DELETE FROM imagen_galeria WHERE id_archivo_imagen='" . $imgaux . "'");
                        $borrado = $this->db->query($deletefile1);
                        if ($imgh1 != "sin.jpg") {
                            unlink("../Imagenes/Galeria/" . $imgh1);
                        }
                    } else {
                        printf("Errormessage: %s\n", $this->db->error);
                    }
                } else {
                    echo "failed file1";
                }
            }
        }
        if ($_FILES['file2']['error'] === 0) {

            $fileInfofile2 = pathinfo($_FILES['file2']['name']);
            $extfile2 = $fileInfofile2['extension'];

            if (in_array($extfile2, $valid_formatsimg)) {

                $aux2 = random_bytes(12);
                $actual_file2_name = substr(bin2hex($aux2), 0, 12);

                $tmp2 = $_FILES['file2']['tmp_name'];
                if (move_uploaded_file($tmp2, $pathGaleria . $actual_file2_name . "." . $extfile2)) {
                    $insertfile2 = ("INSERT INTO imagen_galeria (id_archivo_imagen, id_revision_informacion) VALUES ('" . $actual_file2_name . "'," . $idrev . ")");
                    $agregado2 = $this->db->query($insertfile2);
                    if ($agregado2) {
                        $imgaux2 = substr($imgh2, 0, 12);
                        $deletefile2 = ("DELETE FROM imagen_galeria WHERE id_archivo_imagen='" . $imgaux2 . "'");
                        $borrado2 = $this->db->query($deletefile2);
                        if ($imgh2 != "sin.jpg") {
                            unlink("../Imagenes/Galeria/" . $imgh2);
                        }
                    } else {
                        printf("Errormessage: %s\n", $this->db->error);
                    }
                } else {
                    echo "failed file1";
                }
            }
        }

        if ($_FILES['file3']['error'] === 0) {

            $fileInfofile3 = pathinfo($_FILES['file3']['name']);
            $extfile3 = $fileInfofile3['extension'];

            if (in_array($extfile3, $valid_formatsimg)) {

                $aux3 = random_bytes(12);
                $actual_file3_name = substr(bin2hex($aux3), 0, 12);

                $tmp3 = $_FILES['file3']['tmp_name'];
                if (move_uploaded_file($tmp3, $pathGaleria . $actual_file3_name . "." . $extfile3)) {
                    $insertfile3 = ("INSERT INTO imagen_galeria (id_archivo_imagen, id_revision_informacion) VALUES ('" . $actual_file3_name . "'," . $idrev . ")");
                    $agregado3 = $this->db->query($insertfile3);
                    if ($agregado3) {
                        $imgaux3 = substr($imgh3, 0, 12);
                        $deletefile3 = ("DELETE FROM imagen_galeria WHERE id_archivo_imagen='" . $imgaux3 . "'");
                        $borrado3 = $this->db->query($deletefile3);
                        if ($imgh3 != "sin.jpg") {
                            unlink("../Imagenes/Galeria/" . $imgh3);
                        }
                    } else {
                        printf("Errormessage: %s\n", $this->db->error);
                    }
                } else {
                    echo "failed file1";
                }
            }
        }

        if ($_FILES['file4']['error'] === 0) {

            $fileInfofile4 = pathinfo($_FILES['file4']['name']);
            $extfile4 = $fileInfofile4['extension'];

            if (in_array($extfile4, $valid_formatsimg)) {

                $aux4 = random_bytes(12);
                $actual_file4_name = substr(bin2hex($aux4), 0, 12);

                $tmp4 = $_FILES['file4']['tmp_name'];
                if (move_uploaded_file($tmp4, $pathGaleria . $actual_file4_name . "." . $extfile4)) {
                    $insertfile4 = ("INSERT INTO imagen_galeria (id_archivo_imagen, id_revision_informacion) VALUES ('" . $actual_file4_name . "'," . $idrev . ")");
                    $agregado4 = $this->db->query($insertfile4);
                    if ($agregado4) {
                        $imgaux4 = substr($imgh4, 0, 12);
                        $deletefile4 = ("DELETE FROM imagen_galeria WHERE id_archivo_imagen='" . $imgaux4 . "'");
                        $borrado4 = $this->db->query($deletefile4);
                        if ($imgh4 != "sin.jpg") {
                            unlink("../Imagenes/Galeria/" . $imgh4);
                        }
                    } else {
                        printf("Errormessage: %s\n", $this->db->error);
                    }
                } else {
                    echo "failed file4";
                }
            }
        }

        if ($_FILES['file5']['error'] === 0) {

            $fileInfofile5 = pathinfo($_FILES['file5']['name']);
            $extfile5 = $fileInfofile5['extension'];

            if (in_array($extfile5, $valid_formatsimg)) {

                $aux5 = random_bytes(12);
                $actual_file5_name = substr(bin2hex($aux5), 0, 12);

                $tmp5 = $_FILES['file5']['tmp_name'];
                if (move_uploaded_file($tmp5, $pathGaleria . $actual_file5_name . "." . $extfile5)) {
                    $insertfile5 = ("INSERT INTO imagen_galeria (id_archivo_imagen, id_revision_informacion) VALUES ('" . $actual_file5_name . "'," . $idrev . ")");
                    $agregado5 = $this->db->query($insertfile5);
                    if ($agregado5) {
                        $imgaux5 = substr($imgh5, 0, 12);
                        $deletefile5 = ("DELETE FROM imagen_galeria WHERE id_archivo_imagen='" . $imgaux5 . "'");
                        $borrado5 = $this->db->query($deletefile5);
                        if ($imgh5 != "sin.jpg") {
                            unlink("../Imagenes/Galeria/" . $imgh5);
                        }
                    } else {
                        printf("Errormessage: %s\n", $this->db->error);
                    }
                } else {
                    echo "failed file1";
                }
            }
        }
    }

}
