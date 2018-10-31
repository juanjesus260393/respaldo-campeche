<?php
/*
 *          Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 10-10-2018
 *   Versión: 1.0
 *   Descripcion: Controlador de la funcion que muestra las empresas activas
 * por Fabrica de Software, CIC-IPN
 */
//inicia variables de sesión
session_start();
// Verifica si al variable de sesión existe
if($_SESSION['loggedin']==NULL || $_SESSION['loggedin']==FALSE){
//si no existe o es nula, destruye la sesión y regresa al log in 
 unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';

}
// Si existe y es de tipo administrador, manda a llamadar a los archivo conexion.php
else if($_SESSION['loggedin']==TRUE && $_SESSION['tipo']=='administrador'){
include '../includes/header.php';

    require_once ("../Model/conexion.php");
 //crea los objetos necesarios de las clases 
 //Si ya se llenaron los campos y se dio enviar, se reciben los datos y se dan de alta en la base de datos
 //y a la ves, se envia un correo con la información 
    if (isset($_POST['submit'])) {
        require_once("../Model/Sendmail.php");
        $db;
        $db = Conectar::con();
        $pass = password_hash($_POST['authoPass'], PASSWORD_DEFAULT);
        $email = $_POST['email'];
        $nombre = $_POST['nombre'];
        // $pass=$this->gen_pass($email);

        $sqlinsert1 = ("INSERT INTO users (username, password, enabled) VALUES ('" . $email . "','" . $pass . "', 1)");
        $agregado = $db->query($sqlinsert1);
        $sqlinsert2 = ("INSERT INTO authorities (username, authority) VALUES ('" . $email . "','" . $nombre . "')");
        $agregado2 = $db->query($sqlinsert2);
        sendmail($email, $_POST['email'], 0);
    }
    ?>
<!-- Imprime el formulario de cambio de contraseña -->
    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <br><br>
        <label>Nombre</label>
        <input type="text" size="32" placeholder="Mi nombre" name="nombre" /><br><br>
        <label>Correo</label>
        <input type="text" size="32" placeholder="ejemplo@correo.com" name="email" />
        <br><br>
        <label>Contraseña</label>
        <input type="text" size="32"  name="authoPass" />
        <input type="submit" name="submit" value="Agregar usuario">


    </form>
<?php
include '../includes/footer.php';

    }
else{
    unset($_SESSION);
    session_destroy();
     echo '<script language = javascript>
	self.location = "../index.php"
	</script>';
}

