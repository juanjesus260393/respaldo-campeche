<?php


include '../includes/header.php';


?>
    <script type="text/javascript" src="../scripts/Comprobaciones.js"></script>
    <script src="../js/Validaciones.js"></script>
        <div class="container form-group" id="formulario" >
            <h1 style="text-align:center;">Nueva Empresa</h1>
            <form id="nUsu" name="nusu"  enctype="multipart/form-data"  action="../Controller/Nuevo_usu_controller.php" method="post">
            <br><br>
            
            <label>Correo</label>
            <input type="text" size="32" placeholder="ejemplo@correo.com" id="mail" name="email" maxlength="90" required="required">
            <label>Nombre de la Empresa</label>
            <input type="text" size="40" name="empresa" onkeypress="LetrasyNum()" maxlength="180" required>
            <br>
            <span ><label>Membresias</label>
                <label class="btn btn-outline-primary">
                    <input type="radio"  name="membresia" class="" value="BASICA" required>
            
                    <img src="../Controller/img/Mbasica.png" alt="Basica" height="100" width="140" class="">
                </label>
                <label class="btn btn-outline-primary">
                    <input type="radio"  name="membresia" class="" value="PREMIUM">
                
                    <img src="../Controller/img/MPremium.png" alt="Premium" height="100" width="140" class="">
                </label>
                <label class="btn btn-outline-primary">
                    <input type="radio"  class="" name="membresia" value="360">
                
                    <img src="../Controller/img/M360.png" alt="360" height="100" width="140" class="">
                </label>
            </span>
            <label>Sector</label>
            <?php
                     printf("<select required name='sectores'>");
                     printf("<option value=''>Seleccionar...</option>");
                     foreach ($sector as $sec){
                     printf("<option value='".$sec[0]."'>".$sec[1]."</option>");
                     }
                     printf("</select>");
                    ?>
            <br>
            <label>Logo:</label><br>
            <input type="file" name="idlogo" id="idlogo" accept=".jpg" required onchange="ValidarImagenc(this)">
            <label>Telefono</label>
            <input type="text" size="20" name="tel1" onkeypress="soloNum()" maxlength="15" required>
            <label>Extension</label>
            <input type="text" size="20" name="tel2" onkeypress="soloNum()" maxlength="7">
            <label>Celular</label>
            <input type="text" size="20" name="cel" onkeypress="soloNum()" maxlength="15" >
            <br>
            <label>Direccion</label>
            <br>
            <textarea name="dir" rows="3" cols="35" placeholder="Escriba la direccion..." maxlength="190" required></textarea>
            <label>Propietario</label>
            <input type="text" size="35" name="propietario"  maxlength="240" required>
             <label>Numero de Empleados</label>
            <input type="text" size="5" name="numempleados" maxlength="11" onkeypress="soloNum()">
            <br>
            <label>Descripcion </label>
            <br>
            <textarea name="desc" rows="10" cols="80"  maxlength="490" placeholder="Escriba una descripcion larga ..." required></textarea>
            <label>Facebook</label>
            <input type="text" size="40" name="facebook" maxlength="240">
            <label>Twitter</label>
            <input type="text" size="40" name="twitter" maxlength="240">
            <label>Instagram</label>
            <input type="text" size="40" name="instagram" maxlength="240">
            <label>Youtube</label>
            <input type="text" size="40" name="youtube" maxlength="240">
            <label>Google +</label>
            <input type="text" size="40" name="googleplus" maxlength="240">
            <br>
            <label>Tamaño</label>
         <select required name='tam'>
                   <option value=''>Seleccionar...</option>
                   <option value='1'>Micro Empresa</option>
                    <option value='2'>Pequeña Empresa</option>
                     <option value='3'>Mediana Empresa</option>
                      <option value='4'>Gran Empresa</option>
                       <option value='5'>Sin Especificar</option>
                   </select>
            <br>
            <label>Rango de costos</label>
            <br>
            <label>Minimo---Maximo</label>
            <?php
                     printf("<select required name='rangos'>");
                     printf("<option value=''>Seleccionar...</option>");
                     foreach ($rangos as $costo){
                     printf("<option value='".$costo[0]."'>".$costo[1]."</option>");
                     }
                     printf("</select>");
                    ?>
            <br>
            <input type="checkbox" name="habilitar" value="si" checked onchange="mostrarfec(this)"> Habilitar usuario<br>
            <label id="Lfechafin"> Caducidad Membresia<input type="date" name="fechafin" id="fechafin"  required></label>
           
            <script>
       
                
                function mostrarfec(a){
                    if(a.checked===true){
                        $('#fechafin').removeClass('d-none');
                        $('#Lfechafin').removeClass('d-none');
                        $('#fechafin').Attr('required', 'required');
                    }else{
                    $('#fechafin').addClass('d-none');
                    $('#Lfechafin').addClass('d-none');
                    
                   $('#fechafin').removeAttr('required');
                }
                    
                    
                }
                
              $( "#nUsu" ).submit(function( event ) {
   var c= document.getElementById("mail").value;
 
    var espacios = false;
var cont = 0;
 
while (!espacios && (cont < c.length)) {
  if (c.charAt(cont) === " "){
    espacios = true;}
    cont++;
}
if (c.indexOf(".")<0){
    espacios = true;}
if (c.indexOf("@")<0){
    espacios = true;}
 
if (espacios) {
  alert ("Ingrese un correo valido");
  
 
  return false;
  }else {
  alert("Todo esta correcto");
  return true;
  }});
                </script>

          
            <br>
            <input type="submit"  name="submit" value="Agregar usuario">
            
            
        </form>
        
    </div>
        <?php
         

        ?>
<?php


include '../includes/footer.php';


?>
