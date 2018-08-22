<?php


include '../includes/header.php';


?>
      
   
        <h1 align="center">Nuevo Usuario</h1>
        <div id="formulario" class="container">
            <?php
            foreach ($datos as $info) {


                printf('  <form enctype="multipart/form-data" action="../Controller/Set_usu_controller2.php" method="post">');
                printf('  <br><br>');
                printf('<fieldset id="field" disabled>');
                printf("<input type='hidden' name='usu_before_set' value='" . $info[0] . "'>");
                printf('    <label>Correo</label>');
                printf('<div class="input-group">');
                printf('<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>');
                printf(' <input id="email" type="text" size="32" name="email" class="form-control" value="' . $info[0] . '"/>');
                printf('</div>');
                printf('   <label>Nombre de la Empresa</label>');
                printf('   <input type="text" size="40" name="empresa" value="' . $info[1] . '">');
                
                printf('<span ><label>Membresias</label>');
                switch ($info[16]){
                    case 1:
                printf('    <label class="btn btn-outline-primary">');
                printf('     <input type="radio"  name="membresia" class="" value="BASICA" checked>');

                printf('         <img src="../Controller/img/Mbasica.png" alt="Basica" height="50" width="60" class="">');
                printf('  </label>');
                printf('      <label class="btn btn-outline-primary">');
                printf('     <input type="radio"  name="membresia" class="" value="PREMIUM">');

                printf('         <img src="../Controller/img/MPremium.png" alt="Premium" height="50" width="60" class="">');
                printf(' </label>');
                printf('      <label class="btn btn-outline-primary">');
                printf('      <input type="radio"  class="" name="membresia" value="360">');

                printf('          <img src="../Controller/img/M360.png" alt="360" height="50" width="60" class');
                printf('  </label>');
                break;
                    case 2:
                         printf('    <label class="btn btn-outline-primary">');
                printf('     <input type="radio"  name="membresia" class="" value="BASICA">');

                printf('         <img src="../Controller/img/Mbasica.png" alt="Basica" height="50" width="60" class="">');
                printf('  </label>');
                printf('      <label class="btn btn-outline-primary">');
                printf('     <input type="radio"  name="membresia" class="" value="PREMIUM" checked>');

                printf('         <img src="../Controller/img/MPremium.png" alt="Premium" height="50" width="60" class="">');
                printf(' </label>');
                printf('      <label class="btn btn-outline-primary">');
                printf('      <input type="radio"  class="" name="membresia" value="360">');

                printf('          <img src="../Controller/img/M360.png" alt="360" height="50" width="60" class');
                printf('  </label>');
                break;
                    case 3:
             printf('    <label class="btn btn-outline-primary">');
                printf('     <input type="radio"  name="membresia" class="" value="BASICA">');

                printf('         <img src="../Controller/img/Mbasica.png" alt="Basica" height="50" width="60" class="">');
                printf('  </label>');
                printf('      <label class="btn btn-outline-primary">');
                printf('     <input type="radio"  name="membresia" class="" value="PREMIUM">');

                printf('         <img src="../Controller/img/MPremium.png" alt="Premium" height="50" width="60" class="">');
                printf(' </label>');
                printf('      <label class="btn btn-outline-primary">');
                printf('      <input type="radio"  class="" name="membresia" value="360" checked>');

                printf('          <img src="../Controller/img/M360.png" alt="360" height="50" width="60" class');
                printf('  </label>');
                break;
                }
                printf(' </span>');

                printf('      <label>Sector</label>');
                printf("<select required name='sectores'>");
                printf("<option value='" . $info[2] . "'>" . $info[3] . "</option>");
                foreach ($sector as $sec) {
                    printf("<option value='" . $sec[0] . "'>" . $sec[1] . "</option>");
                }
                printf("</select>");
                printf("<br><label>Logo:</label>");
                printf('<input type="file" name="idlogo" id="idlogo" accept=".jpg" >');
                printf(' <label>Telefono</label>');
                printf('    <input type="text" size="20" name="tel1" value="' . $info[4] .'" onkeypress="soloNum()">');
                printf('  <label>Extension</label>');
                printf('    <input type="text" size="20" name="tel2" value="' . $info[5] .'" onkeypress="soloNum()">');
                printf("<label>Celular</label>");
                printf('<input type="text" size="20" name="cel" value="'.$info[6].'"valueypress="soloNum()"');
                printf('  <br>');
                printf('     <label>Direccion</label>');
                printf('  <br>');
                printf('     <textarea name="dir" rows="3" cols="35">' . $info[7] . '</textarea>');
                printf('  <label>Propietario</label>');
                printf('       <input type="text" size="35" name="propietario" value="' . $info[8] . '">');
                printf('  <label>Numero de Empleados</label>');
                printf('     <input type="text" size="5" name="numempleados" value="' . $info[9] . '">');
                printf('    <br>');
                printf('      <label>Descripcion </label>');
                printf(' <br>');
                printf('   <textarea name="desc" rows="10" cols="80" >' . $info[10] . '</textarea>');
                printf('<label>Facebook</label >');
                printf('<input type="text" size="40" value="'.$info[18].'" name="facebook">');
                printf(' <label>Twitter</label>');
                printf(' <input type="text" size="40" value="'.$info[19].'" name="twitter">');
                printf('   <label>Instagram</label>');
                printf('  <input type="text" size="40" value="'.$info[20].'" name="instagram">');
                printf('    <label>Youtube</label>');
                printf('  <input type="text" size="40" value="'.$info[21].'" name="youtube">');
                printf('    <label>Google +</label>');
                printf('   <input type="text" size="40" value="'.$info[22].'" name="googleplus">');
                printf('<br>');
                printf('    <label>Tamaño</label>');
                printf('  <input type="text" size="20" name="tam" value="' . $info[11] . '">');
                printf('   <br>');
                printf('  <label>Ventas mensuales</label>');
                printf("<select required name='rangos'>");
                printf("<option value='" . $info[14] . "'>" . $info[15] . "</option>");
                foreach ($rangos as $costo) {
                    printf("<option value='" . $costo[0] . "'>" . $costo[1] . "</option>");
                }
                printf("</select>");
                printf('    <br><br>');
                if ($info[12] == 1) {
                    printf('  <label><h3>-------Ya Esta Habilitado-------</h3></label>');
                    printf('  <br>');
                    printf('  <br>');
                    printf(' <input type="checkbox" name="habilitar"  checked> Deshabilitar usuario<br>');
                } else {
                    printf('  <label><h3>-------Ya Esta Deshabilitado-------</h3></label>');
                    printf('  <br>');
                    printf('  <br>');
                    printf(' <input type="checkbox" name="habilitar" > Habilitar usuario<br>');
                }
                printf("<input type='hidden' name='userr' value='" . $info[13] . "'>");
                //  printf("<input type='hidden' name='user_to_set' value='".$dato[4]."'>");
                printf('  <br>');
                printf('  <br>');
                printf('    <input type="submit" name="submit2" value="Guardar Cambios">');
                printf('</fieldset>');
                printf('<input type="button" onClick=document.getElementById("field").removeAttribute("disabled"); value="Modificar">');
                printf('   </form> ');
            }
            ?>
    </div>
<?php


include '../includes/footer.php';


?>
