<?php
include '../includes/header2.php';
?>
<div> 

        <table class="table" style='border: 1px solid grey; -moz-border-radius: 15px;' align='center'>
                
                     <thead class="thead-dark" align='center'>
                  <th scope="col" width='120' align='center'>Imagen</th>
                <th scope="col" width='220' align='center'>Nombre</th>
                <th scope="col" width='500' align='center'>Descripción</th>
                <th scope="col" width='500' align='center'>Status</th>
                <th scope="col" width='220' align='center'>Lugar</th>
                <th scope="col" width='220' align='center'>Fecha</th>

            </tr>


            <?php
            if (isset($eventos))
            {
               
            foreach ($eventos as $cupdato) {
                if (($cupdato[15] == 'C') or ($cupdato[15] == 'R'))
                 {
                    # <tr  class='btn-outline-primary'  data-toggle='modal' id='idcup' data-target='#exampleModal' data-whatever='<?php printf($cupdato[0]);
                     printf("<tr  class='btn-outline-primary'  data-toggle='modal' id='idcup' data-target='#exampleModal' data-whatever='" . $cupdato[0] . "' " );
                    
                }
                else
                {
                  printf("<tr  class='btn-outline-primary'  data-toggle='modal' id='idcup' data-whatever='" . $cupdato[0] . "' " );  
                 
                }
                
                ?>

               
                     data-0='<?php printf($cupdato[0]); ?>' data-1='<?php printf($cupdato[1]); ?>' data-2='<?php printf('%s', $cupdato[2]); ?>' data-3='<?php printf('%s', $cupdato[3]); ?>'
                     data-4='<?php printf($cupdato[4]); ?>' data-5='<?php printf($cupdato[5]); ?>' data-6='<?php printf($cupdato[6]); ?>' data-7='<?php printf($cupdato[7]); ?>' 
                     data-9='<?php printf($cupdato[9]); ?>' data-10='<?php printf($cupdato[10]); ?>' data-11='<?php printf($cupdato[11]); ?>' data-12='<?php printf($cupdato[12]); ?>'
                     data-13='<?php printf($cupdato[13]); ?>' data-14='<?php printf($cupdato[14]); ?>' data-15='<?php printf($cupdato[15]); ?>' data-8='<?php printf($cupdato[8]); ?>'>

                    <?php
                    printf("<td align='center'><img src='../Imagenes/eventos/img/" . $cupdato[8] . ".jpg' alt='" . $cupdato[8] . ".jpg imagen no disponible' height='80' width='60' ></td>");

                    printf("<td height='80' align='center'>%s", $cupdato[2]);
                    printf("</td>");

                    printf("<td height='80' align='center'>%s", $cupdato[3]);
                    printf("</td>");


                    if ($cupdato[15] == 'R') {
                        printf("<td height='80' align='center' style='color: red ;'>Rechazado </td>");
                    }
                    if ($cupdato[15] == 'C') {
                       printf("<td height='80' align='center' style='color: blue ;'><h5><b>En Revisión</b></h5></td>");
                    }
                    if ($cupdato[15] == 'A') {
                       printf("<td height='80' align='center' style='color: #22C322;'><h5><b>Aprobado (Publicado)</b></h5></td>");
                    }



                    printf("<td height='80' align='center'>" . $cupdato[5]);
                    printf("</td>");
                    printf("<td height='80' align='center'>" . $cupdato[4] . "</td>");
                    printf("</tr>");
                }

                printf("</table>");
            }    ?>
           

            <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                   <div class="modal-content">

                        <form  enctype="multipart/form-data" id="seteventoform" action="../Controller/setEventos_controller.php" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Evento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <!-- <div class="modal-body"> -->

                                <div class="">
                                   


                                  <!--   <div class="row form-group">
                                        <div class="col-8">
                                            <div class='row'> -->
                                                <div class="col-12">
                                                <label>Nombre del Evento</label>
                                                <input type="text" size="60" id="nombre" name="nombre" required>
                                                <input type="hidden" id="idevento" name="idevento">
                                                <input type="hidden" id="idrev" name="idrev">
                                            </div>

                                  
                                            <div class="col-12"> 
                                            <label>Categoria</label>
                                            <?php
                                            printf("<select required name='categorias'>");
                                            printf("<option id='catedefault'></option>");
                                            foreach ($categorias as $mpio) {
                                                printf("<option value='" . $mpio[0] . "'>" . $mpio[1] . "</option>");
                                            }
                                            printf("</select>");
                                            ?>
                                               
                                                <label class="col-2">Descripcion</label>
                                                <input class="col-6" type="text" id="descripcion" name="descripcion" required>

                                            </div>
                                            <div class="col-12">

                                                <label class="col-1">Fecha:</label>
                                                <input class="col-5" type="text" size="20" id="fecha" name="fecha" required>


                                                <label class="col-1">Lugar:</label>
                                                <input class="col-4" type="text" size="20" name="lugar" id="lugar" required>


                                                <label class="col-1">Costo:</label>
                                                <input class="col-3" type="text" size="20" name="costo" id="costo" required>
                                            </div>

                                             <div class="col-12">

                                                <label class="col-2">Beneficiario</label>
                                                <input class="col-8" type="text" size="20" id="beneficiario" name="beneficiario" required>
                                             </div>
                                             <div class="col-12">

                                                <label class="col-2">Sitio</label>
                                                <?php
                                            printf("<select required name='sitios'>");
                                            printf("<option id='sitiodefault'></option>");
                                            foreach ($sitios as $mpio) {
                                                printf("<option value='" . $mpio[0] . "'>" . $mpio[1] . "</option>");
                                            }
                                            printf("</select>");
                                            ?>
                                             </div>
                                            <div class="col-12">
                                                    <label>Imagen:</label><br>
                                                    <img id="idperfil" class="img-fluid img-thumbnail" style="width: 190px; height: auto;">
                                                    <input type="hidden" id="idperfilaux" name="idperfilaux">
                                                    <div class="choose_file">
                                                        <button type="button" class="btn btn-outline-dark" style="width: auto;">Cambia Imagen</button>
                                                        <input type="file" id="idperfilSet" name="idperfilSet" accept=".jpg"    onchange="openFile2(event)"
                                                               style="-webkit-appearance:none;     
                                                               position:absolute;
                                                               top:0;
                                                               left:0;
                                                               opacity:0;
                                                               width: 100%;
                                                               height: 100%;">
                                                    </div>
                                                </div>

                                            
                                            <div class="col-12" style="height: 415px; width: 580px;">
                                                <div id="map" style="height: 400px; width: 570px; z-index: 2; position: absolute; align-content: center;">
                                                </div>
                                                <div id="floating-panel" style="position: relative;top: 1%;
                                                    left:30%;
                                                    z-index: 5;
                                                    background-color: #fff;
                                                    padding: 3px;
                                                    border: 1px solid #999;
                                                    width: 300px;
                                                    height: 40px;
                                                    font-family: 'Roboto','sans-serif';
                                                    line-height: 25px;
                                                    ">
                                                   <input id="address" type="text" >
                                                   <input id="submit" type="button" value="Buscar">
                                               </div>


                                               <script>
                                                    var marker;
                                                    var marker2;
                                                    var map;
                                                    function initMap() {
                                                        var myLatlng = {lat: 19.8301251, lng: -90.53490870000002};

                                                        map = new google.maps.Map(document.getElementById('map'), {
                                                            zoom: 13,
                                                            center: myLatlng,
                                                            streetViewControl: false
                                                        });

                                                        marker = new google.maps.Marker({
                                                            position: myLatlng,
                                                            map: map,
                                                            title: 'Click to zoom'
                                                        });

                                                        document.getElementById("posx").value = marker.getPosition().lat();
                                                        document.getElementById("posy").value = marker.getPosition().lng();

                                                        var geocoder = new google.maps.Geocoder();

                                                        document.getElementById('submit').addEventListener('click', function () {
                                                            geocodeAddress(geocoder, map);
                                                        });
                                                    }
                                                                                                      
                                                </script>
                                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXVeZ4ei2IHiQ6xt-oV2Sq7Fx8bKqswd4&callback=initMap"
                                                async defer></script>

                                            </div>
                                            <div class="row text-right">
                                                <label class="col-3">Coordenadas</label>
                                                <input class="col-4" id="posx" type="text" size="33" name="cordx" readonly>
                                                <input class="col-4" id="posy" type="text" size="33" name="cordy" readonly>
                                            </div>
                                            <div class="text-center">
                                                <br><br><br>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" id="actualizar" name="actualizar">Modificar</button>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                              
                                                                                               
                                            <form  id="f_eliminar" action="../controller/setEventos_controller.php" method="POST"> 
                                                    <input type="hidden" id="id_evento" name="id_evento">
                                                    <input type="hidden" id="id_revision_evento" name="id_revision_evento">
                                                    <button type="submit" class="btn btn-danger"  id="eliminar" name="eliminar" onclick="if (!confirm('Estas seguro que quieres Eliminar este Evento')) {
                            return false
                        }">Eliminar</button>
                                                </form>
                                                
                                            </div>
                                       






                                <div class="modal-footer">
                                   
                                </div>


                            </div>  
                        </form> </div>
                </div>

            </div>
              
        <!-- </div> -->

       
        <script>
                                                $('#exampleModal').on('show.bs.modal', function (event) {
                                                    var button = $(event.relatedTarget); // Button that triggered the modal
                                                    var recipient = button.data('whatever');
                                                    var dat0 = button.data('0');
                                                    var dat1 = button.data('1');
                                                    var dat2 = button.data('2');
                                                    var dat3 = button.data('3');
                                                    var dat4 = button.data('4');
                                                    var dat5 = button.data('5');
                                                    var dat6 = button.data('6');
                                                    var dat7 = button.data('7');
                                                    var dat8 = button.data('8');
                                                    var dat9 = button.data('9');
                                                    var dat10 = button.data('10');
                                                    var dat11 = button.data('11');
                                                    var dat12 = button.data('12');
                                                    var dat13 = button.data('13');
                                                    var dat14 = button.data('14');
                                                    var dat15 = button.data('15');
                                                  

                                                    var posi = new google.maps.LatLng({lat: dat9, lng: dat10});

                                                    // Extract info from data-* attributes
                                                    document.getElementById('idevento').value = dat0;
                                                    document.getElementById('id_evento').value = dat0;

                                                    document.getElementById('idrev').value = dat11;
                                                     document.getElementById('id_revision_evento').value = dat11;
                                                    document.getElementById('nombre').value = dat2;
                                                    document.getElementById('catedefault').text = dat12;
                                                    document.getElementById('catedefault').value = dat1;
                                                     document.getElementById('sitiodefault').text = dat14;
                                                     document.getElementById('sitiodefault').value = dat13;
                                                    document.getElementById('descripcion').value = dat3;
                                                    document.getElementById('fecha').value = dat4;
                                                    document.getElementById('lugar').value = dat5;
                                                    document.getElementById('costo').value = dat6;
                                                    document.getElementById('beneficiario').value = dat7;

                                                 
                                                    document.getElementById('idperfil').src = "../Imagenes/eventos/img/" + dat8+".jpg";
                                                                                                        
                                                    document.getElementById('idperfilaux').value = dat8;
                                                                                                   
                                                  
                                                    document.getElementById('posx').value = dat9;
                                                    document.getElementById('posy').value = dat10;

                                                    
                                                    marker.setPosition(posi);
                                                    map.setCenter(posi);
                                                    map.setZoom(15);

                                                                                                                                                          

                                                   

// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                                                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                                                    var modal = $(this);
                                                    modal.find('.modal-title').text('Evento  :  ' + dat2);
                                                    //modal.find('.modal-body input').val(recipient);
                                                });


                                            
                                                var openFile2 = function (event) {
                                                    var input = event.target;

                                                    var reader = new FileReader();
                                                    reader.onload = function () {
                                                        var dataURL = reader.result;
                                                        var output = document.getElementById('idperfil');
                                                        output.src = dataURL;
                                                    };
                                                    reader.readAsDataURL(input.files[0]);
                                                };
                                                
                                                 
                                              
        </script>
<?php
include '../includes/footer.php';
?>
