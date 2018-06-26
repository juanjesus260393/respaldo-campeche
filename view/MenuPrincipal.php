<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Proyecto Campeche 360</title>
    </head>
    <body>
        <?php
        //Se obtiene arreglo con los valores del modelo inicio de sesion
        list($un, $tp, $ie, $ena) = $user;
        //Se manda a llamar a la clase validaciones para verificar el estado de la empresa
        require_once("C:/xampp/htdocs/campeche-web2/scripts/Validaciones.php");
        $val = new validacion ();
        //Se llama al metodo habilitado
        $estatus = $val->habilitado($ena);
        ?>
        <!-- Se recibe el nombre de usuario debido a que las opciones cambiaran dependiendo del tipo de usuario--> 
    <center><h2><?php echo "Bienvenido: " . $un; ?> </h2></center>
    <!-- Funcion para habilitar un div si el tipo de usuario es empresa o administrador--> 
    <div name = "tipo_usuario"> 
    <?php $estatus = $val->mostrar_ocultar($tp);?>
    </div>
  
     
      
  
</body>
</html>