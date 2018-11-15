<?php
/*
 *   Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 24-10-2018
 *   Versión: 1.0
 *   Descripcion: Vista donde se encuentra toda la parte visual necesaria
 *   para  mostrar las empresas activas
 * 
 * por Fabrica de Software, CIC-IPN
 */
include '../includes/header.php'
?>

<script> 
    //Se declaran las variables necesarias para poder aplicar los filtros de busqueda y organizacion
    var a =<?php echo $Nemp; ?>;
    var i;
    var j;
    var x = 0;
    var w;
    var empresas = [{nombre: "{", desc: "{", sector: "{", membresia: "{", idEmp: "{", pos: "{"}];
</script>  
<?php
foreach ($datos as $dato) {
    ?>
    <script>
        //Se asignan los datos de las empresas a un arreglo
        empresas.push({nombre: '<?php echo $dato[1] ?>', desc: '<?php echo $dato[2] ?>', sector: '<?php echo $dato[3] ?>', membresia: '<?php echo $dato[5] ?>', idEmp: '<?php echo $dato[4] ?>', pos: x});
        x++;

    </script>

    <?php
}
?>       
<script>

    function submitdato(A) {
        var idempresa = A.getAttribute("data-A");
        alert(idempresa);
        document.location = "../Controller/set_usu_controller2.php?dato=" + idempresa;

    }
</script>
<h1> Empresas Activas</h1>
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
    //Imprime las empresas
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
        printf("<td height='80' align='center'>"
                . "<table>"
                . "<td>"
                . "<tr>"
                . "<form action='../Controller/Emp_Activas_controller.php' method='post'>"
                . "<input id='offEmp" . $cont . "' type='hidden' name='user_disabled' value='" . $dato[4] . "'>"
                . "<input type='submit' name='desactivar' value='Deshabilitar'>"
                . "</form>"
                . "</tr>"
                . "</td>"
                . "<td height='20'>"
                . "</td>"
                . "</table>"
                . "</td>");
        printf("</tr>");
        $cont++;
    }

    printf("</table>");
    ?>


    <script>
        //.DataTable asigna las funciones de busqueda
        $(document).ready(function () {
            $('#tableemp').DataTable();
        });


//Filtro de busqueda de cadena
        $("#busqueda").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#tableemp tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
//muestra todas las empresas
        function showall() {
            for (i = 0; i <= a; i++) {

                $('#trform' + i).show();

            }

        }
        //Filtro ordena por sector
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

//Filtro por nombre en orden alfabetico
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

 //Filtro ordena por Tipo de Membresia
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



