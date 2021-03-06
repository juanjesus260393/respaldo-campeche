<?php
/*
 *   Campeche  360 
 *   Autor: Isidro Delgado Murillo
 *   Fecha: 24-10-2018
 *   Versión: 1.0
 *   Descripcion: Vista donde se encuentra toda la parte visual necesaria
 *   para  agregar un nuevo sitio
 * 
 * por Fabrica de Software, CIC-IPN
 */
include '../includes/header2.php';
?>

<script type="text/javascript" src="../scripts/Comprobaciones.js"></script> 
<div class="container" id="formulario" >
    <form  enctype="multipart/form-data" action="../Controller/add_Sitios_controller.php" method="post">
        <?php include '../includes/modalGaleria.php'; ?>
        <table class="table" style="width: 100%;">
            <tr>
                <td>     
                    <label>Nombre del Sitio</label>
                    <input type="text" size="30" name="nombreSitio" maxlength="100" required>
                </td>
                <td><label>Url del Sitio</label>
                    <input type="text" size="30" name="urlsitio" maxlength="450"></td>
                <td >

                    <label>Municipio</label>
                    <?php
                    printf("<select required name='municipios'>");
                    printf("<option value=''>Seleccionar...</option>");
                    foreach ($municipio as $mpio) {

                        printf("<option value='" . $mpio[0] . "'>" . $mpio[1] . "</option>");
                    }
                    printf("</select>");
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" >
                    <label>Telefono 1</label>
                    <input type="text" size="20" name="tel1" onkeypress="soloNum()" maxlength="15" required>
                    <label>Telefono 2</label>
                    <input type="text" size="20" name="tel2" onkeypress="soloNum()" maxlength="15">

                    <div class="row  justify-content-center align-items-center ">
                        <div class="col-2">
                            <label>Direccion</label></div>
                        <div class="col-6">

                            <textarea name="dir" rows="3" cols="35" placeholder="Escriba la direccion..." maxlength="200" required></textarea></div>
                        <div class="col-4 text-center">
                            <input class="btn" type="button" data-toggle='modal' id='gal' name="gal" data-target='#modalGalery' value='Galeria'>
                        </div>
                    </div>
                    <div>
                        <label>Imagen Perfil:</label><br>
                        <input type="file" id="idperfil" accept=".jpg" name="idperfil" onchange="ValidarImagenvper(this)" required>
                    </div>

                    <div id="divcarta" class="d-none">
                        <label>Carta:</label><br>
                        <input type="file" id="idcarta" accept=".pdf" name="idcarta">
                    </div>
                    <div>
                        <br>
                        <label>Capacidad</label>
                        <input type="text" size="20" name="tam" onkeypress="soloNum()" maxlength="10">
                    </div>
                    <div class="col text-right">
                        <label>Coordenadas</label>
                        <input id="posx" type="text" size="33" name="cordx" readonly>
                        <input id="posy" type="text" size="33" name="cordy" readonly>
                    </div>

                    <?php
                    //Oculta los elementos de carta si no pertenece a los sectores restaurante, hotel o cafe & snakcs
                    switch ($_SESSION['sectorEmp']) {
                        case '1':
                            printf("<script>"
                                    . "$('#divcarta').removeClass('d-none');"
                                    . "</script>");
                            break;
                        case '2':
                            printf("<script>"
                                    . "$('#divcarta').removeClass('d-none');"
                                    . "</script>");
                            break;
                        case '3':
                            printf("<script>"
                                    . "$('#divcarta').removeClass('d-none');"
                                    . "</script>");
                            break;
                    }
                    ?>

                </td>


                <td style="height: 415px; width: 570px;">
                    <div id="map" style="height: 400px; width: 570px; z-index: 2; position: absolute;">
                    </div>
                    <div id="floating-panel" style="position: relative;top: 1%;
                         left:30%;
                         z-index: 5;
                         background-color: #fff;
                         padding: 3px;
                         border: 1px solid #999;
                         width: 300px;
                         font-family: 'Roboto','sans-serif';
                         line-height: 25px;
                         ">
                        <input id="address" type="text" >
                        <input id="submit" type="button" value="Buscar">
                    </div>




                    <script>
                        //Manejo e implementacion de la API de google Maps
                        var marker;
                        var marker2;
                        function initMap() {
                            var myLatlng = {lat: 19.8301251, lng: -90.53490870000002};

                            var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 13,
                                center: myLatlng,
                                streetViewControl: false
                            });

                            marker = new google.maps.Marker({
                                position: myLatlng,
                                map: map,
                                title: 'Click to zoom'
                            });

                            /* map.addListener('center_changed', function () {
                             // 3 seconds after the center of the map has changed, pan back to the
                             // marker.
                             window.setTimeout(function () {
                             map.panTo(marker.getPosition());
                             }, 3000);
                             });*/

                            map.addListener('click', function (event) {
                                marker.setPosition(event.latLng);

                                document.getElementById("posx").value = marker.getPosition().lat();
                                document.getElementById("posy").value = marker.getPosition().lng();

                            });

                            document.getElementById("posx").value = marker.getPosition().lat();
                            document.getElementById("posy").value = marker.getPosition().lng();

                            var geocoder = new google.maps.Geocoder();

                            document.getElementById('submit').addEventListener('click', function () {
                                geocodeAddress(geocoder, map);


                            });
                        }
                        function geocodeAddress(geocoder, resultsMap) {
                            var address = document.getElementById('address').value;
                            geocoder.geocode({'address': address}, function (results, status) {
                                if (status === 'OK') {
                                    resultsMap.setCenter(results[0].geometry.location);
                                    marker.setPosition(results[0].geometry.location);
                                    document.getElementById("posx").value = marker.getPosition().lat();
                                    document.getElementById("posy").value = marker.getPosition().lng();
                                    resultsMap.setZoom(15);

                                } else {
                                    alert('No se encontro' + status);
                                }
                            });
                        }
                        //AIzaSyCX3zRx9Ccv62uYx_DU8ifXfhWh4t5uwp4
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXVeZ4ei2IHiQ6xt-oV2Sq7Fx8bKqswd4&callback=initMap"
                    async defer></script>
                </td>



            </tr>
            <tr>
                <td>
                    <div>
                        <span><label>Descripcion Corta:</label></span>
                        <span><input type="text" id="descripcion_corta"  size="25" name="descripcion_corta" placeholder="Descripcion Corta"  maxlength="149" required></span>
                    </div> 
                    <br><br><br>
                    <input type="submit" class="btn btn-primary" name="submit" value="Agregar Sitio">
                <td>
                    <label>Horario</label>
                    <br>
                    <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspAbre-&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp-&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp-Cierra</label>
                    <br>
                    <input type="time" name="horaAbre" value="07:00"  step="1">
                    <input type="time" name="horaCierra" value="07:00"  step="1">
                    <br><br>
                </td>



                <td>

                    <label>Descripcion Larga:</label>
                    <textarea  id="descripcion_larga" name="descripcion_larga" rows="7" cols="78" placeholder="Descripcion Larga" maxlength="490" required></textarea>

                </td>
            </tr>
        </table>




    </form>

</div>
<?php ?>
<?php
include '../includes/footer.php';
?>