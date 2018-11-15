<?php
/*
 *   Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 24-10-2018
 *   Versión: 1.0
 *   Descripcion: Vista donde se encuentra toda la parte visual necesaria
 *   para  mostrar las empresas Inactivas
 * 
 * por Fabrica de Software, CIC-IPN
 */

include '../includes/header.php';


?>
     
              <script>
    //se declaran las variables necesarias para poder aplicar los filtros              
    
    var a =<?php echo $Nemp; ?>;
    var i;
     var aux123=0;
    var j;
    var x = 0;
    var w;
    var empresas = [{nombre: "{", desc: "{", sector: "{", membresia: "{", idEmp: "{", pos: "{"}];
</script>  
<?php
foreach ($datos as $dato) {
    ?>
    <script>
        //Se asignan los valores de las empresas a un arreglo para el manejo de los datos con los filtros
        
        empresas.push({nombre: '<?php echo $dato[1] ?>', desc: '<?php echo $dato[2] ?>', sector: '<?php echo $dato[3] ?>', membresia: '<?php echo $dato[5] ?>', idEmp: '<?php echo $dato[4] ?>', pos: x});
        x++;

    </script>

    <?php
}
?>       
<script>

    function submitdato(A) {
        if(aux123===0){
        var idempresa = A.getAttribute("data-A");
        alert(idempresa);
        document.location = "../Controller/set_usu_controller2.php?dato=" + idempresa;
    }
    }
</script>
<h1> Empresas Inactivas</h1>
<!--<div style="background-color: #f1f1f1;">
    <label><b>BUSQUEDA :</b></label><input type="search" id="busqueda"></div>-->
<table id="tableemp" class="table" style=' border: 1px solid grey; -moz-border-radius: 15px;' align="center">
    <thead id="hcuerpo" class="thead-dark" >
        <tr align='center'>

            <th scope="col" width='220' align='center'><button onclick=" filtroNombre()" class="btn btn-light font-weight-bold">Nombre</button></th>
            <th scope="col" width='500' align='center'>Descripción</th>
            <th scope="col" width='220' align='center'><button onclick=" ordenarS()" class="btn btn-light font-weight-bold">Sector</button>

                <?php
                printf("<select id='Optsector' name='sectores' style='width:20px;' onclick='ordenarS2()' onchange='filtroSector()'>");
                printf("<option value='x'>Todos</option>");
                foreach ($sector as $sec) {
                    printf("<option value='" . $sec[0] . "'>" . $sec[1] . "</option>");
                }
                printf("</select>");
                ?>

            </th>

            <th scope="col" width='220' align='center'>Membresia
                <select id='Optmembresia' name='licence' style='width:20px;' onchange='filtroMembresia()' onclick='ordenarS2()'>                  
                    <option value='y' >Todas</option>   
                    <option value='1'>Basica</option>
                    <option value='2'>Premium</option>
                    <option value='3'>360°</option>
                </select>
            </th>

            <th scope="col" width='220' align='center'></th>
        </tr></thead>



    <?php
    $cont = 0;
// while ($datos) {
    foreach ($datos as $dato) {



        printf("<tr class='btn-outline-primary' id='trform" . $cont . "' data-A='" . $dato[4] . "' onclick='submitdato(this)'>");

        printf("<td  height='80' align='center' id='name" . $cont . "'> %s </td>"
                . "<td  height='80' align='center' id='desc" . $cont . "'> %s </td>"
                . "<td  height='80' align='center' id='sectorr" . $cont . "'>%s </td>", $dato[1], $dato[2], $dato[3]);
        printf("<td id='Mem' height='80' align='center'>");
        switch ($dato[5]) {
            case 1:
                printf('         <img id="licencia' . $cont . '" src="../Controller/img/Mbasica.png" alt="Basica" height="100" width="140" class="">');
                break;
            case 2:
                printf('         <img id="licencia' . $cont . '" src="../Controller/img/MPremium.png" alt="Premium" height="100" width="140" class="">');
                break;
            case 3:
                printf('          <img id="licencia' . $cont . '" src="../Controller/img/M360.png" alt="360" height="100" width="140">');
                break;
        }
        printf("</td>");
       printf("<td height='80' align='center'>"); ?>
                <table>
                <tr>
                <form action='../Controller/Emp_Desactivadas_controller.php' method='post'>
                   <?php printf(" <input id='offEmp" . $cont . "' type='hidden' name='user_disabled' value='" . $dato[4] . "'>"); ?>
                    
                   <div class="modal" id="Modalfecha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Caducidad de Membresia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <label>Fecha Fin de Membresia</label><br>
                                <input type="date" name="fechafin">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" id="aprobar" name="activar" value="Aprobar">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="rechazar" onclick=" document.location = '../Controller/Emp_Desactivadas_controller.php'">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>             
                    
                    
                <input type='hidden' name='user_able' value='<?php printf($dato[4]); ?>'>
                <input type='hidden' name='idemp' value='<?php printf($dato[0]); ?>'>
                <input type='button' name='abrefecha' value='Habilitar' data-toggle='modal' data-target='#Modalfecha' onclick="aux123=1;">
                </form>
               </tr>
                </table> 
             <?php printf("</td>");
        printf("</tr>");
        $cont++;
    }

    printf("</table>");
    ?>


    <script>
        
        //Da formato a la tabla y habilita el filtro de busqueda
        $(document).ready(function () {
            $('#tableemp').DataTable();
        });


//Filtro de busqueda por cadena
        $("#busqueda").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#tableemp tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        function showall() {
            for (i = 0; i <= a; i++) {

                $('#trform' + i).show();

            }

        }
        //Filtro ordena por Sector alfabeticamente
        function ordenarS() {

            for (i = 0; i <= a; i++) {

                $('#trform' + i).show();

            }
            empresas.sort(function (a, b) {
                var x = a.sector.toLowerCase();
                var y = b.sector.toLowerCase();
                if (x < y) {
                    return -1;
                }
                if (x > y) {
                    return 1;
                }
                return 0;
            });


            for (i = 0; i <= a; i++) {

                document.getElementById('name' + i).innerHTML = empresas[i].nombre;
                document.getElementById('desc' + i).innerHTML = empresas[i].desc;
                document.getElementById('sectorr' + i).innerHTML = empresas[i].sector;
                switch (empresas[i].membresia) {
                    case '1':
                        document.getElementById('licencia' + i).src = "../Controller/img/Mbasica.png";
                        break;
                    case '2':
                        document.getElementById('licencia' + i).src = "../Controller/img/MPremium.png";
                        break;
                    case '3':
                        document.getElementById('licencia' + i).src = "../Controller/img/M360.png";
                        break;
                }

                document.getElementById('offEmp' + i).value = empresas[i].idEmp;
                document.getElementById('trform' + i).setAttribute('data-A', empresas[i].idEmp);
            }


        }
        function ordenarS2() {


            empresas.sort(function (a, b) {
                var x = a.sector.toLowerCase();
                var y = b.sector.toLowerCase();
                if (x < y) {
                    return -1;
                }
                if (x > y) {
                    return 1;
                }
                return 0;
            });


            for (i = 0; i <= a; i++) {

                document.getElementById('name' + i).innerHTML = empresas[i].nombre;
                document.getElementById('desc' + i).innerHTML = empresas[i].desc;
                document.getElementById('sectorr' + i).innerHTML = empresas[i].sector;
                switch (empresas[i].membresia) {
                    case '1':
                        document.getElementById('licencia' + i).src = "../Controller/img/Mbasica.png";
                        break;
                    case '2':
                        document.getElementById('licencia' + i).src = "../Controller/img/MPremium.png";
                        break;
                    case '3':
                        document.getElementById('licencia' + i).src = "../Controller/img/M360.png";
                        break;
                }

                document.getElementById('offEmp' + i).value = empresas[i].idEmp;
                document.getElementById('trform' + i).setAttribute('data-A', empresas[i].idEmp);
            }


        }
//Filtro ordena por nombre alfabeticamente

        function filtroNombre() {
            for (i = 0; i <= a; i++) {

                $('#trform' + i).show();

            }

            empresas.sort(function (a, b) {
                var x = a.nombre.toLowerCase();
                var y = b.nombre.toLowerCase();
                if (x < y) {
                    return -1;
                }
                if (x > y) {
                    return 1;
                }
                return 0;
            });


            for (i = 0; i <= a; i++) {

                document.getElementById('name' + i).innerHTML = empresas[i].nombre;
                document.getElementById('desc' + i).innerHTML = empresas[i].desc;
                document.getElementById('sectorr' + i).innerHTML = empresas[i].sector;
                switch (empresas[i].membresia) {
                    case '1':
                        document.getElementById('licencia' + i).src = "../Controller/img/Mbasica.png";
                        break;
                    case '2':
                        document.getElementById('licencia' + i).src = "../Controller/img/MPremium.png";
                        break;
                    case '3':
                        document.getElementById('licencia' + i).src = "../Controller/img/M360.png";
                        break;
                }

                document.getElementById('offEmp' + i).value = empresas[i].idEmp;
                document.getElementById('trform' + i).setAttribute('data-A', empresas[i].idEmp);

            }

        }
//Filtro por sector seleccionado 
        function filtroSector() {


            for (i = 0; i <= a; i++) {

                $('#trform' + i).show();

            }


            var combo = document.getElementById("Optsector");
            var selected = combo.options[combo.selectedIndex].text;

            if (selected === 'Todos') {
                showall();

            } else {
                for (i = 0; i <= a; i++) {

                    if (empresas[i].sector === selected) {

                    } else {

                        $('#trform' + i).hide();
                    }

                }
            }
        }

//Filtro por tipo de Membresia
        function filtroMembresia() {

            for (i = 0; i <= a; i++) {

                $('#trform' + i).show();
            }

            var combomembresia = document.getElementById("Optmembresia").value;
            if (combomembresia === 'y') {
                showall();

            } else {
                for (i = 0; i <= a; i++) {

                    if (empresas[i].membresia === combomembresia) {

                    } else {
                        $('#trform' + i).hide();

                    }

                }
            }
        }





    </script>                 


       
               
<?php
include '../includes/footer.php';
?>