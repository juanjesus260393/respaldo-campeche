<?php
require_once('../scripts/Validaciones.php');
// $na = new validacion();
// $idro = $na->registros_evento();
require_once('../includes/header2.php');
?>
               
<div class="container" id="formulario" >
    <center><h3>FORMULARIO PARA AGREGAR EVENTOS A CARTELERA </h3></center>
            <form  enctype="multipart/form-data" action="../Controller/add_Eventos_controller.php" method="post">
           
                <table class="table" style="width: 100%;">
                    <tr>
                        <td>     
                            <label>Nombre del Evento</label>
                        </td>
                        <td>
                            <input type="text" size="50" name="nombre" id="nombre">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Categoria del Evento</label>
                        </td>
                        <td>
                            <?php
                            
                            printf("<select required name='categorias'>");
                            printf("<option value=''>Seleccionar...</option>");
                            foreach ($categoria as $categ) {
                                printf("<option value='" . $categ[0] . "'>" . $categ[1] . "</option>");
                            }
                            printf("</select>");
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>     
                            <label>Descripción del Evento</label>
                        </td>
                        <td>
                            <input type="text" size="50" name="descripcion" id="descripcion">
                        </td>
                    </tr>
                    <tr>
                        <td>     
                            <label>Fecha del Evento</label>
                        </td>
                        <td>
                            <input type="date" size="50" name="fecha" id="fecha">
                        </td>
                    </tr>
                    <tr>
                        <td>     
                            <label>Lugar del Evento</label>
                        </td>
                        <td>
                            <input type="text" size="50" name="lugar" id="lugar">
                        </td>
                    </tr>
                    <tr>
                        <td>     
                            <label>Costo del Evento</label>
                        </td>
                        <td>
                            <input type="text" size="50" name="costo" id="costo">
                        </td>
                    </tr>
                    <tr>
                        <td>     
                            <label>Beneficiario del Evento</label>
                        </td>
                        <td>
                            <input type="text" size="50" name="beneficiario" id="beneficiario">
                        </td>
                    </tr>
                    <tr>
                        <td>     
                            <label>Imagen a mostrar del Evento</label>
                        </td>
                        <td>
                            <input type="file" id="idimagen" accept=".jpg" name="idimagen">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Sitio asignado al evento</label>
                        </td>
                        <td>
                            <?php
                            printf("<select required name='sitios'>");
                            printf("<option value=''>Seleccionar...</option>");
                            foreach ($sitios as $sit) {
                                printf("<option value='" . $sit[0] . "'>" . $sit[1] . "-" .$sit[2] . "</option>");
                            }
                            printf("</select>");
                            ?>
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input id="posx" type="text" size="33" name="cordx" readonly>
                        </td>
                        <td>
                             <input id="posy" type="text" size="33" name="cordy" readonly>
                        </td>
                    </tr>   
                     <tr>
                        <td style="height: 415px; width: 570px; column-span: 2">
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
                        <td colspan="2">
                    <input type="submit" class="btn btn-primary" name="submit1" value="Agregar Evento">
                        </td>
                    </tr>
            </table>
       </form>
        </div>
<?php
include '../includes/footer.php';
?>