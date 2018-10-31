<?php
session_start();
require_once('../scripts/Validaciones.php');
$na = new validacion();
$idro = $na->registros_vacante();
require_once('../includes/header2.php');

?>


     
    <center><h1>Agregar Nuevo Evento</h1></center>
    <center><form method="post" action="../Controller/crtAdvacante.php" name="form1" enctype="multipart/form-data">
            <div>
                <span><input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo $_SESSION['idemp'];
?>"></span>
            </div>
            <div>
                <span><label>Nombre del Evento:</label></span>
                <span><input type="text" id="nombre" name="nombre" placeholder="Nombre del Evento" maxlength="99" required></span>
            </div> 
            <div>
                <span><label>Categoria</label></span>
                <span><input type="number" required  id="salario" placeholder="$" name="salario"></span>
            </div>
            <div>
                <span><label>Descripcion</label></span>
                <span> <input type="text" required id="horario" placeholder="ejem: de 7:00 am a 5:00 pm" name="horario"></span>
            </div>

             <div>
                <span><label>Fecha:</label></span>
                <span> <input type="text" required id="escolaridad" placeholder="Licenciatura" name="escolaridad"></span>
            </div>

             <div>
                <span><label>Habilidades:</label></span>
                <span> <textarea required id="habilidades" placeholder="ejem: Puntual,Responsable,Proactivo" name="habilidades"></textarea></span>
            </div>

             <div>
                <span><label>Descripción:</label></span>
                <span> <textarea required id="descripcion" placeholder="Se solicita la vacante para el area de oficinas" name="descripcion"></textarea></span>
            </div>

             <div>
                <span><label>Tiempo:</label></span>
                <span> <div class="list-group" >
                    <label class="label-info"><input type="radio" name="tiempo" value="1" >Temporal</label>
                    <label class="label-info"><input type="radio" name="tiempo" value="2">Indefinido</label></div>
                </span>
            </div>
             <div>
                <span><label>Genero:</label></span>
                <span> 
                <select  id="genero" name="genero" required>
                    <option disabled selected value="">Selecciona una opción</option>
                    <option value="1">Masculino</option>
                    <option value="2">Femenino</option>
                    <option value="3">Indistinto</option>
                </select>
                </span>
            </div>
            <div>
                <span><label>Rango edad:</label></span>
                <span> 
                <select  id="rangoedad" name="rangoedad" required >
                    <option disabled selected value="">Selecciona una opción</option>
                    <option>de 18 a 25</option>
                    <option>de 26 a 45</option>
                    <option>Sin especificar</option>
                </select>
                </span>
            </div>
            <div>
                <span><label>Experiencia</label></span>
                <span><input type="number" placeholder="Años" id="experiencia" name="experiencia" required></span>
            </div>


            <div>
                <span><input type="submit" onclick="if (!confirm('¿Estas seguro que quieres guardar esta Vacante?')) {
                            return false
                        }" value="Registrar Vacante" ></span>
            </div>
        </form></center>
<?php 

       require_once '../includes/footer.php';

?>
