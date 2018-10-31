<?php
session_start();
require_once('../scripts/Validaciones.php');
require_once('../includes/header2.php');
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8" />
    <title>Proyecto Campeche 360</title>
     <script type="text/javascript" src="../scripts/Comprobaciones.js"></script>
</head>
<?php list($id_vacante, $id_revision_objeto, $nombre, $salario, $horario, $escolaridad, $habilidades, $descripcion, $tiempo, $genero, $rango_edad, $experiencia, $status) = $vacante 
?>



<center><h2>Llenar los campos que contienen un * al inicio de los campos</h2></center> 

<center><h1>Actualizar Vacante</h1></center>
<center><form method="post" action="../Controller/crtacVacante.php" name="form1" enctype="multipart/form-data">
        <div>
            <span><input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp'];
?>"></span>
        </div>
        <div>
            <span><input type="hidden" name="id_vacante" id="id_vacante" value="<?php echo $id_vacante;
?>"></span>
        </div>
        <div>
            <span><input type="hidden" name="id_revision_objeto" id="id_revision_objeto" value="<?php echo $id_revision_objeto;
?>"></span>
        </div>
        <div>
                <span><label>*Titulo del Puesto/Vacante: <?php echo $id_vacante; ?></label></span>
                <span><input type="text" id="nombre" name="nombre" maxlength="99" required value="<?php echo $nombre; ?>"></span>
            </div> 
            <div>
                <span><label>Salario</label></span>
                <span><input type="number" required  id="salario" name="salario" value="<?php echo $salario; ?>"></span>
            </div>
            <div>
                <span><label>Horario</label></span>
                <span> <input type="text" required id="horario" name="horario" value="<?php echo $horario; ?>">
                </span>
            </div>
            <div>
                <span><label>Escolaridad</label></span>
                <span> <input type="text" required id="escolaridad" name="escolaridad" value="<?php echo $escolaridad; ?>">
                </span>
            </div>
            <div>
                <span><label>Habilidades</label></span>
                <span> <input type="text" required id="habilidades" name="habilidades" value="<?php echo $habilidades; ?>">
                </span>
            </div>

            <div>
                <span><label>Descripcion</label></span>
                <span> <textarea required id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
                </span>
            </div>

            <div>
                <span><label>Tiempo:</label></span>
                <span> <div class="list-group" >
<?php if ($tiempo=='1'){
 ?>

                <input type="radio" name="tiempo" value="1" checked>  <label>Temporal</label>
                 <input type="radio" name="tiempo" value="2">  <label>Indefinido</label>
<?php }  else { ?>
                <input type="radio" name="tiempo" value="1" >  <label>Temporal</label>
                 <input type="radio" name="tiempo" value="2" checked="">  <label>Indefinido</label>

<?php } ?>

                </span>
            </div>

                <div>
                <span><label>Genero:</label></span>
                <span> 
                <select  id="genero" name="genero" required>
<?php if ($genero=='1'){
 ?>

                    <option value="1" selected>Masculino</option>
                    <option value="2">Femenino</option>
                    <option value="3">Indistinto</option>
<?php } ?>

<?php if ($genero=='2'){
 ?>

                    <option value="1" >Masculino</option>
                    <option value="2" selected>Femenino</option>
                    <option value="3">Indistinto</option>
<?php } ?>


<?php if ($genero=='3'){
 ?>

                    <option value="1" >Masculino</option>
                    <option value="2">Femenino</option>
                    <option value="3" selected>Indistinto</option>
<?php } ?>
                </select>
                </span>
            </div>
            <div>
                <span><label>Rango edad:</label></span>
                <span> 
                <select  id="rango_edad" name="rango_edad" required >
        <?php if ($rango_edad=='de 18 a 25'){
 ?>           
                    <option value="de 18 a 25" selected>de 18 a 25</option>
                    <option value="de 26 a 45">de 26 a 45</option>
                    <option value="Sin especificar">Sin especificar</option>
<?php } ?>
 <?php if ($rango_edad=='de 26 a 45'){
 ?>           
                    <option value="de 18 a 25" >de 18 a 25</option>
                    <option value="de 26 a 45" selected>de 26 a 45</option>
                    <option value="Sin especificar">Sin especificar</option>
<?php } ?>
<?php if ($rango_edad=='Sin especificar'){
 ?>           
                    <option value="de 18 a 25" >de 18 a 25</option>
                    <option value="de 26 a 45" >de 26 a 45</option>
                    <option value="Sin especificar" selected>Sin especificar</option>
<?php } ?>

                </select>
                </span>
            </div>
            <div>
                <span><label>Experiencia</label></span>
                <span><input type="number" id="experiencia" name="experiencia" value="<?php echo $experiencia; ?>"></span>
            </div>

           <div>
            <span><input type="submit" onclick="if (!confirm('Estas seguro que quieres actualizar el contenido de esta Vacante?')) {
                        return false
                    }" value="Actualizar Vacante" ></span>
        </div>
    </form></center>

<?php 

       require_once '../includes/footer.php';

?>


