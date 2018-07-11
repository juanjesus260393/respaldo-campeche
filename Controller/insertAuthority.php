<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Nuevo usuario</title>
    </head>
    <body>

<?php
require_once ("../Model/conexion.php");
if(isset($_POST['submit'])){
    
     $db;
  
        $db=Conectar::con();
        
    
    
$pass=password_hash($_POST['authoPass'], PASSWORD_DEFAULT);
$email=$_POST['email'];
$nombre=$_POST['nombre'];
      // $pass=$this->gen_pass($email);
         
        $sqlinsert1=("INSERT INTO users (username, password) VALUES ('".$email."','".$pass."')");
        $agregado=$db->query($sqlinsert1);
        $sqlinsert2=("INSERT INTO authorities (username, authority) VALUES ('".$email."','".$nombre."')");
        $agregado2=$db->query($sqlinsert2);
        
}
?>
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
    </body>
</html>