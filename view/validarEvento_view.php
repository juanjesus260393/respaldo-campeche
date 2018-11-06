<?php


include '../includes/header.php';


?>
      



        <div align="center"><h3>LISTA DE EVENTOS PARA REVISIÓN Y APROBACIÓN </h3></div>
         <table class="table" style='border: 1px solid grey; -moz-border-radius: 15px;' align='center'>
                
            <thead class="thead-dark" align='center'> <tr>
                <th scope="col" width='120' align='center'>Nombre</th>
                <th scope="col" width='220' align='center'>Lugar</th>
                <th scope="col" width='500' align='center'>Descripcion</th>
                <th scope="col" width='500' align='center'>Fecha Creación</th>
                <th scope="col" width='220' align='center'>Status</th>
            </tr>
            

            <?php
            foreach ($evendatos as $cupdato) {
                ?>
                    <tr  class='btn-outline-primary'  data-toggle='modal' id='idevento' data-target='#exampleModal' data-whatever='<?php printf($cupdato[2]); ?>'
                     data-0='<?php printf($cupdato[0]); ?>' data-1='<?php printf($cupdato[1]); ?>' data-2='<?php printf($cupdato[2]); ?>' data-3='<?php printf($cupdato[3]); ?>'
                     data-4='<?php printf($cupdato[4]); ?>' data-5='<?php printf($cupdato[5]); ?>' data-6='<?php printf($cupdato[6]); ?>' data-7='<?php printf($cupdato[7]); ?>' 
                     data-9='<?php printf($cupdato[9]); ?>' data-10='<?php printf($cupdato[10]); ?>' data-11='<?php printf($cupdato[11]); ?>' data-12='<?php printf($cupdato[12]); ?>'
                     data-13='<?php printf($cupdato[13]); ?>' data-14='<?php printf($cupdato[14]); ?>' data-15='<?php printf($cupdato[15]); ?>' data-8='<?php printf($cupdato[8]); ?>' >


                    <?php
                         printf("<td height='80' align='center'>%s", $cupdato[2]);
                    printf("</td>");
                        
                      printf("<td height='80' align='center'>%s", $cupdato[5]);
                    printf("</td>");
                    
                             printf("<td height='80' align='center'>%s", $cupdato[3]);
                    printf("</td>");  

                     printf("<td height='80' align='center'>". $cupdato[4]);
                    printf("</td>");             
                    if($cupdato[15]=='C'){
  
                        printf("<td height='80' align='center'>En Revision </td>");
                    }
               
                    printf("</tr>");
                }
                printf("</table>");
                ?>


            <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Evento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">


                                <div class="row">
                                    <div class="col-12">



                                            <label class="col-6" style="background-color:#f1f1f1;" >Nombre del Evento</label>
                                                <input class="col-5" type="text" size="60" id="nombre" name="nombre" required>
                                                <input type="hidden" id="idevento" name="idevento">
                                                <input type="hidden" id="idrev" name="idrev">
                                        </div>

                                            <div class="col-12"> 
                                            <label class="col-6" style="background-color:#f1f1f1;" >Categoria</label>
                                           <input class="col-5" type="text" size="60" id="categoria" name="categoria" required>
						</div>
                                            <div class="col-12"> 
                                                <label class="col-6" style="background-color:#f1f1f1;" >Descripcion</label>
                                                <input class="col-5" type="text" id="descripcion" name="descripcion" required>
                                            </div>
                                            <div class="col-12">

                                                <label class="col-1" style="background-color:#f1f1f1;">Fecha:</label>
                                                <input class="col-3" type="text" size="20" id="fecha" name="fecha" required>


                                                <label class="col-1" style="background-color:#f1f1f1;">Lugar:</label>
                                                <input class="col-2" type="text" size="20" name="lugar" id="lugar" required>


                                                <label class="col-2" style="background-color:#f1f1f1;">Costo:</label>
                                                <input class="col-2" type="text" size="20" name="costo" id="costo" required>
                                            </div>

                                             <div class="col-12">

                                                <label class="col-4" style="background-color:#f1f1f1;">Beneficiario</label>
                                                <input class="col-7" type="text" size="20" id="beneficiario" name="beneficiario" required>
                                             </div>
                                             <div class="col-12">

                                                <label class="col-2" style="background-color:#f1f1f1;">Sitio</label>
                                              <input class="col-9" type="text" size="60" id="sitio" name="sitio" required>
                                             </div>
                                            <div class="col-12">
                                                    <label class="col-2" style="background-color:#f1f1f1;">Imagen:</label><br>
                                                    <img class="col-9"id="idperfil" class="img-fluid img-thumbnail" style="width: 190px; height: auto;">
                                                    <input type="hidden" id="idperfilaux" name="idperfilaux">
                                                   
                                                </div>

                                            
                                           <div class="row col-8" style="height: 415px; width: 730px;">
                                            <div id="map" style="height: 400px; width: 730px; z-index: 2; position: absolute;">

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
                                            <div class="col-12" style="padding-top:25px; background-color:#f1f1f1; width: 710px;"> 
                                               <label class="col-4">Coordenadas</label>
                                                <input class="col-4" id="posx" type="text" size="33" name="cordx" readonly>
                                                <input class="col-3" id="posy" type="text" size="33" name="cordy" readonly>
                                            </div>
                                            <div class="text-center">
                                                <br><br><br>
                                               
                                            </div>
                                   <div class="col-12" style="padding-top:25px; background-color:#f1f1f1;  width: 710px;" > 
                                        <label class="col-4" for="messagetext" class="col-form-label">Comentario de Rechazo</label>
                                        <textarea class="col-7" id="messagetext" class="form-control" ></textarea>
                                    </div>
<br>
                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="aprobar">Aprobar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="rechazar">Rechazar</button>
                                    </div>
                                </div>
                                  </div>
                                </div>
<br>
                        <div class="modal-footer">
                            
                        </div>
                 
              
            </div> </div> 
                
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
                                                  

                                                    document.getElementById('idrev').value = dat11;
                                                 
                                                    document.getElementById('nombre').value = dat2;
                                                    document.getElementById('categoria').value = dat12;
                                                     document.getElementById('sitio').text = dat14;
                                                     document.getElementById('descripcion').value = dat3;
                                                    document.getElementById('fecha').value = dat4;
                                                    document.getElementById('lugar').value = dat5;
                                                    document.getElementById('costo').value = dat6;
                                                    document.getElementById('beneficiario').value = dat7;
                                                     document.getElementById('sitio').value = dat14;

                                                 
                                                    document.getElementById('idperfil').src = "../Imagenes/eventos/img/" + dat8+".jpg";
                                                                                                        
                                                    document.getElementById('idperfilaux').value = dat8;
                                                                                                   
                                                  
                                                    document.getElementById('posx').value = dat9;
                                                    document.getElementById('posy').value = dat10;

                                                    
                                                    marker.setPosition(posi);
                                                    map.setCenter(posi);
                                                    map.setZoom(15);

                    $('#aprobar').click(function () {
                        var msgtxt = document.getElementById('messagetext').value;
                        document.location.href = "../Controller/validarEvento_controller.php?opc=A&evento=" + dat0 +"&revision=" + dat11;

                    });
                     $('#rechazar').click(function () {
                        var msgtxt = document.getElementById('messagetext').value;
                        document.location.href = "../Controller/validarEvento_controller.php?opc=R&evento=" + dat0 + "&coment=" + msgtxt + "&revision=" + dat11;

                    });

// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                    var modal = $(this);
                    modal.find('.modal-title').text('Evento  ');
                    //modal.find('.modal-body input').val(recipient);
                    
                });
            </script>
            <br>
                </div>
<?php


include '../includes/footer.php';


?>
