<?php
include '../includes/header.php';
?>

<script type="text/javascript" src="../scripts/Comprobaciones.js"></script>
<h1 align="center">Nuevo Usuario</h1>
<div id="formulario" class="container">
<?php
foreach ($datos as $info) {


    printf('  <form id="nUsu" name="nusu" enctype="multipart/form-data" action="../Controller/Set_usu_controller2.php" method="post">');
    printf('  <br><br>');
    printf('<fieldset id="field" disabled>');
    printf("<input type='hidden' name='usu_before_set' value='" . $info[0] . "'>");
    printf('    <label>Correo</label>');
    printf('<div class="input-group">');
    printf('<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>');
    printf(' <input id="email" type="text" size="32" name="email"  maxlength="90" class="form-control" value="' . $info[0] . '"/>');
    printf('</div>');
    printf('   <label>Nombre de la Empresa</label>');
    printf('   <input type="text" size="40" name="empresa" value="' . $info[1] . '" onkeypress="LetrasyNum()" maxlength="180">');

    printf('<span ><label>Membresias</label>');
    switch ($info[16]) {
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
    // printf("<br><label>Logo:</label>");
    // printf('<input type="file" name="idlogo" id="idlogo" accept=".jpg" onchange="ValidarImagenc(this)">');

    printf('<label>Imagen Logo:</label><br>');
    printf('<img id="idlogo2" class="img-fluid img-thumbnail" style="width: 190px; height: auto;" src="../Imagenes/Sitios/logo/' . $info[23] . '.jpg">');
    printf('<input type="hidden" name="logoA" value="' . $info[23] . '"');
    printf(' <input type="text"><label for="idlogoSet" class="btn btn-outline-dark">Cambia Imagen</label><input type="file" class="d-none" id="idlogoSet" name="idlogoSet" accept=".jpg"
                   onchange="openFile2(event)">
                                                    <br>');



    printf(' <label>Telefono</label>');
    printf('    <input type="text" size="20" name="tel1" value="' . $info[4] . '" onkeypress="soloNum()" maxlength="15">');
    printf('  <label>Extension</label>');
    printf('    <input type="text" size="20" name="tel2" value="' . $info[5] . '" onkeypress="soloNum()" maxlength="7">');
    printf("<label>Celular</label>");
    printf('<input type="text" size="20" name="cel" value="' . $info[6] . '"onkeypress="soloNum()" maxlength="15">');
    printf('  <br>');
    printf('     <label>Direccion</label>');
    printf('  <br>');
    printf('     <textarea name="dir" rows="3" cols="35" maxlength="190">' . $info[7] . '</textarea>');
    printf('  <label>Propietario</label>');
    printf('       <input type="text" size="35" name="propietario" value="' . $info[8] . '" maxlength="240">');
    printf('  <label>Numero de Empleados</label>');
    printf('     <input type="text" size="5" name="numempleados" value="' . $info[9] . '" maxlength="11" onkeypress="soloNum()">');
    printf('    <br>');
    printf('      <label>Descripcion </label>');
    printf(' <br>');
    printf('   <textarea name="desc" rows="10" cols="80" maxlength="490">' . $info[10] . '</textarea>');
    printf('<label>Facebook</label >');
    printf('<input type="text" size="40" value="' . $info[18] . '" name="facebook" maxlength="240">');
    printf(' <label>Twitter</label>');
    printf(' <input type="text" size="40" value="' . $info[19] . '" name="twitter" maxlength="240">');
    printf('   <label>Instagram</label>');
    printf('  <input type="text" size="40" value="' . $info[20] . '" name="instagram" maxlength="240">');
    printf('    <label>Youtube</label>');
    printf('  <input type="text" size="40" value="' . $info[21] . '" name="youtube" maxlength="240">');
    printf('    <label>Google +</label>');
    printf('   <input type="text" size="40" value="' . $info[22] . '" name="googleplus" maxlength="240">');
    printf('<br>');
    printf('<label>Tamaño</label>');
    printf('<select required name="tam">');
    printf('<option value="' . $info[11] . '">' . $info[11] . '</option>');
    printf('<option value="1">Micro Empresa</option>');
    printf('<option value="2">Pequeña Empresa</option>');
    printf('<option value="3">Mediana Empresa</option>');
    printf('<option value="4">Gran Empresa</option>');
    printf('<option value="5">Sin Especificar</option>');
    printf('</select>');
    printf('   <br>');
    printf('  <label>Ventas mensuales</label>');
    printf("<select required name='rangos'>");
    printf("<option value='" . $info[14] . "'>" . $info[15] . "</option>");
    foreach ($rangos as $costo) {
        printf("<option value='" . $costo[0] . "'>" . $costo[1] . "</option>");
    }
    printf("</select>");
    printf('    <br><br>');
    printf('Fecha Fin de Membresia <br>');
    printf('<input type="text" name="fecdefault" value="' . $info[24] . '" readonly');
    printf('    <br><br>');
    if ($info[12] == 1) {
        printf('  <label><h3>-------Ya Esta Habilitado-------</h3></label>');
        printf('  <br>');
        printf('  <br>');
        printf(' <input type="checkbox" name="habilitar"  checked> Deshabilitar usuario<br>');
        printf(' <input type="checkbox" name="setCad" value="si" checked onchange="mostrarfec(this)"> Cambiar Caducidad de Membresia(empresa)<br>');
        printf(' <label id="Lfechafin"> Caducidad Membresia<input type="date" name="fechafin" id="fechafin"  required></label>');
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

<script>
    var openFile2 = function (event) {
        var input = event.target;

        var reader = new FileReader();
        reader.onload = function () {
            var dataURL = reader.result;
            var output = document.getElementById('idlogo2');
            output.src = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
    };

    function mostrarfec(a) {
        if (a.checked === true) {
            $('#fechafin').removeClass('d-none');
            $('#Lfechafin').removeClass('d-none');
            $('#fechafin').Attr('required', 'required');
        } else {
            $('#fechafin').addClass('d-none');
            $('#Lfechafin').addClass('d-none');

            $('#fechafin').removeAttr('required');
        }


    }

    $("#nUsu").submit(function (event) {
        var c = document.getElementById("email").value;

        var espacios = false;
        var cont = 0;

        while (!espacios && (cont < c.length)) {
            if (c.charAt(cont) === " ") {
                espacios = true;
            }
            cont++;
        }
        if (c.indexOf(".") < 0) {
            espacios = true;
        }
        if (c.indexOf("@") < 0) {
            espacios = true;
        }

        if (espacios) {
            alert("Ingrese un correo valido");


            return false;
        } else {
            alert("Todo esta correcto");
            return true;
        }
    });
</script>
<?php
include '../includes/footer.php';
?>
