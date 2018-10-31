<?php


include '../includes/header.php';


?>
      



        <div align="center"><h3>LISTA DE VACANTES PARA REVISIÓN Y APROVACIÓN </h3></div>
        <table class="table" style='border: 1px solid grey; -moz-border-radius: 15px;' align='center'>
                
            <thead class="thead-dark" align='center'> <tr>
                <th scope="col" width='120' align='center'>Nombre</th>
                <th scope="col" width='220' align='center'>Habilidades</th>
                <th scope="col" width='500' align='center'>Descripcion</th>
                <th scope="col" width='500' align='center'>Fecha Creación</th>
                <th scope="col" width='220' align='center'>Status</th>
            </tr>
            </thead>

            <?php
            foreach ($vacdatos as $vacantedato) {
                ?>

                <tr class='btn-outline-primary'  data-toggle='modal' id='idvacante' data-target='#exampleModal' data-whatever='<?php printf($vacantedato[0]); ?>'
                    data-0='<?php printf($vacantedato[0]); ?>' data-1='<?php printf($vacantedato[1]); ?>' data-2='<?php printf('%s',$vacantedato[2]); ?>' data-3='<?php printf('%s',$vacantedato[3]); ?>'
                    data-4='<?php printf($vacantedato[4]); ?>' data-5='<?php printf($vacantedato[5]); ?>' data-6='<?php printf($vacantedato[6]); ?>' data-7='<?php printf($vacantedato[7]); ?>' 
                    data-8='<?php printf($vacantedato[8]); ?>' data-9='<?php printf($vacantedato[9]); ?>' data-10='<?php printf($vacantedato[10]); ?>' data-11='<?php printf($vacantedato[11]); ?>'>

                    <?php
                         printf("<td height='80' align='center'>%s", $vacantedato[2]);
                    printf("</td>");
                        
                      printf("<td height='80' align='center'>%s", $vacantedato[3]);
                    printf("</td>");
                    
                             printf("<td height='80' align='center'>%s", $vacantedato[4]);
                    printf("</td>");  

                     printf("<td height='80' align='center'>". $vacantedato[5]);
                    printf("</td>");             
                    if($vacantedato[9]=='C'){
  
                        printf("<td height='80' align='center'>Sin Revisar </td>");
                    }
               
                    printf("</tr>");
                }
                printf("</table>");
                ?>


            <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo Mensaje</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <form>
                                    <div class="row no-gutters">
                                        <div class="col-7 ">
                                            <div class='row no-gutters' ><span> 
                                                <label>Nombre de la Vacante:</label>                    
                                                <input type="text" id="nombre" name="nombre" placeholder="Nombre de la Vacante" readonly> 
                                                </span></div>
                                            <div class="row">
                                                <label class="col-3" for="habilidades">Habilidades:</label><span>
                                                <textarea  id="habilidades" name="habilidades" rows="3" cols="40"  maxlength="490"  readonly></textarea>
                                                </span></div> 
                                            <div class="row">
                                                <label class="col-3" for="descripcion">Descripción</label>
                                                <textarea  id="descripcion" name="descripcion" rows="3" cols="40"  maxlength="490"  readonly></textarea>
                                            </div> </div>

                                        <div class="col-5 ">
                                            <div class="row"><span>
                                                    <label class="col-6">Fecha de Creación</label>
                                                    <input type="text" id="fecha" name="fecha" size="22" readonly>
                                                </span></div>

                                            <div class="row"><span>
                                                    <label class="col-4">Salario</label>
                                                    <input  type="text" id="salario"  name="salario" size="22" readonly>
                                                </span></div>
                                            <div class="row"><span>
                                                    <label class="col-4">Horario</label>
                                                    <input  type="text" id="horario"  name="horario" size="22" readonly>
                                                </span></div>
                                            <div class="row"><span>
                                                    <label class="col-4">Escolaridad</label>
                                                    <input id="escolaridad" name="escolaridad" size="22" readonly>
                                                </span></div> 
                                           </div></div>
                                      <div class="row"><span>
                                                    <label class="col-4">Experiencia</label>
                                                    <input id="experiencia" name="experiencia" size="40" readonly>
                                                </span></div> 
                                           </div></div>
                                    
                                    
                                    <div class="form-group">
                                        <label for="messagetext" class="col-form-label">Comentario de Rechazo</label>
                                        <textarea id="messagetext" class="form-control" ></textarea>
                                    </div>
                        <div>
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="aprobar">Aprobar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="rechazar">Rechazar</button>
                            </div>
                    </div>
                        </div>
                
                        <div class="modal-footer">
                          
                        </div>
                    </div>
                </div>
                      
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
                  
                    // Extract info from data-* attributes
                    document.getElementById('nombre').value = dat2;
                    document.getElementById('habilidades').value = dat3;
                    document.getElementById('descripcion').value = dat4;
                    document.getElementById('fecha').value = dat5;
                    document.getElementById('salario').value = "$" + dat6;
                    document.getElementById('horario').value = dat7;
                    document.getElementById('escolaridad').value = dat8;
                    document.getElementById('experiencia').value = dat10 + " años";
                    
                    
                    $('#aprobar').click(function () {
                        var msgtxt = document.getElementById('messagetext').value;
                        document.location.href = "../Controller/validarVacante_controller.php?opc=A&vacante=" + dat0 +"&revision=" + dat1;

                    });
                     $('#rechazar').click(function () {
                        var msgtxt = document.getElementById('messagetext').value;
                        document.location.href = "../Controller/validarVacante_controller.php?opc=R&vacante=" + dat0 + "&coment=" + msgtxt + "&revision=" + dat1;

                    });

// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                    var modal = $(this);
                    modal.find('.modal-title').text('Vacante  ' + recipient);
                    //modal.find('.modal-body input').val(recipient);
                });
            </script>
            <br>
            </div>  
<?php


include '../includes/footer.php';


?>
