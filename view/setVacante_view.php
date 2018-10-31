<?php
include '../includes/header2.php';
?>
<div> 

        <table class="table" style='border: 1px solid grey; -moz-border-radius: 15px;' align='center'>
                
                     <thead class="thead-dark" align='center'>
                  <th scope="col" width='120' align='center'>Nombre</th>
                <th scope="col" width='220' align='center'>Salario</th>
                <th scope="col" width='500' align='center'>Horario</th>
                <th scope="col" width='500' align='center'>Status</th>
                <th scope="col" width='220' align='center'>Escolaridad</th>
                <th scope="col" width='220' align='center'>Fecha</th>

            </tr>


            <?php
            if (isset($vacantes))
            {
            foreach ($vacantes as $cupdato) {
               if (($cupdato[12] == 'R') or ($cupdato[12] == 'C'))
                 {
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
                     data-13='<?php printf($cupdato[13]); ?>' data-8='<?php printf($cupdato[8]); ?>'>
                    <?php
                    printf("<td height='80' align='center'>%s", $cupdato[2]);
                    printf("</td>");

                    printf("<td height='80' align='center'>%s", $cupdato[3]);
                    printf("</td>");
                    
                    printf("<td height='80' align='center'>%s", $cupdato[4]);
                    printf("</td>");



                    if ($cupdato[12] == 'R') {
                        printf("<td height='80' align='center' style='color: red ;'>Rechazado </td>");
                    }
                    if ($cupdato[12] == 'C') {
                       printf("<td height='80' align='center' style='color: blue ;'><h5><b>En Revisión</b></h5></td>");
                    }
                    if ($cupdato[12] == 'A') {
                       printf("<td height='80' align='center' style='color: #22C322;'><h5><b>Aprobado (Publicado)</b></h5></td>");
                    }



                    printf("<td height='80' align='center'>" . $cupdato[5]);
                    printf("</td>");
                    printf("<td height='80' align='center'>" . $cupdato[13] . "</td>");
                    printf("</tr>");
                }

                 printf("</table>");
            }    ?>
           

            <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                   <div class="modal-content">

                        <form  enctype="multipart/form-data" id="setvacanteform" action="../Controller/setVacantes_controller.php" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Vacante</h5>
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
                                                <label>Nombre de la Vacante</label>
                                                <input type="text" size="60" id="nombre" name="nombre" required>
                                                <input type="hidden" id="id_vacante" name="id_vacante">
                                                <input type="hidden" id="id_revision_objeto" name="id_revision_objeto">
                                            </div>
                                  
                                  
                                  
                                  <div class="col-12">
                                                <label class="col-2">Salario</label>
                                                <input class="col-6" type="text" id="salario" name="salario" required>

                                  </div>
                                            <div class="col-12">

                                                <label class="col-2">Horario:</label>
                                                <input class="col-6" type="text" size="20" id="horario" name="horario" required>

                                            </div>
                                  <div class="col-12">
                                                <label class="col-2">Escolaridad:</label>
                                                <input class="col-6" type="text" size="20" name="escolaridad" id="escolaridad" required>
                                    </div>
                                  <div class="col-12">

                                                <label class="col-2">Habilidades:</label>
                                                <input class="col-6" type="text" size="20" name="habilidades" id="habilidades" required>
                                  </div>

                                             <div class="col-12">

                                                <label class="col-2">Descripcion</label>
                                                <input class="col-6" type="text" size="20" id="descripcion" name="descripcion" required>
                                             </div>
                                            
                                            <div class="col-12">
                                                    <label class="col-2">Tiempo</label>
                                                     <?php
                                            printf("<select class='col-6' required name='tiempo' id='tiempo'>");
                                            printf("<option id='tiempodefault'></option>");
                                            printf("<option value='1'>Temporal</option>");
                                            printf("<option value='2'>Indefinido</option>");
                                           
                                            printf("</select>");
                                            ?>
                                             </div>
                            
                                                <div class="col-12">
                                                    <label class="col-2">Genero</label>
                                                     <?php
                                            printf("<select class='col-6' required name='genero' id='genero'>");
                                            printf("<option id='generodefault'></option>");
                                            printf("<option value='1'>Masculino</option>");
                                            printf("<option value='2'>Femenino</option>");
                                            printf("<option value='3'>Indistinto</option>");
                                            printf("</select>");
                                            ?>
                                             </div>
                                                <div class="col-12">
                                                    <label class="col-2">Rango de Edad</label>
                                                 
                                                    <?php
                                            printf("<select class='col-6' required name='rango_edad' id='rango_edad'>");
                                            printf("<option id='rangodefault'></option>");
                                            printf("<option value='1'> de 18 a 25 </option>");
                                            printf("<option value='2'> de 26 a 45 </option>");
                                            printf("<option value='3'> Sin especificar </option>");
                                            printf("</select>");
                                            ?>
                                                    
                                                    
                                                    
                                                    
                                                    
                                             </div>

                                            <div class="text-center">
                                                <br><br><br>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" id="actualizar" name="actualizar">Modificar</button>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                              
                                                                                               
                                            <form  id="f_eliminar" action="../controller/setVacantes_controller.php" method="POST"> 
                                                    <input type="hidden" id="id_vacante1" name="id_vacante1">
                                                    <input type="hidden" id="id_revision_objeto1" name="id_revision_objeto1">
                                                    <button type="submit" class="btn btn-danger"  id="eliminar" name="eliminar" onclick="if (!confirm('Estas seguro que quieres Eliminar esta Vacante')) {
                                                    return false
                                                    }">Eliminar Vacante</button>
                                            </form>
                                                
                                            </div>
                                  
                                  
                                  






                                <div class="modal-footer">
                                   
                                </div>


                            </div>  
                        </form> </div>
                </div>

            </div>
              
        <!-- </div> -->

       
        
        <script>                              $('#exampleModal').on('show.bs.modal', function (event) {
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
                                             
                                                    // Extract info from data-* attributes
                                                    document.getElementById('nombre').value = dat2;
                                                    document.getElementById('salario').value = dat3;
                                                    document.getElementById('id_vacante').value = dat0;
                                                    document.getElementById('id_vacante1').value = dat0;
                                                   

                                                    document.getElementById('id_revision_objeto').value = dat1;
                                                    document.getElementById('id_revision_objeto1').value = dat1;
                                                     
                                                    document.getElementById('nombre').value = dat2;
                                                    document.getElementById('salario').value = dat3;
                                                    document.getElementById('horario').value = dat4;
                                                     document.getElementById('escolaridad').value = dat5;
                                                     document.getElementById('habilidades').value = dat6;
                                                    document.getElementById('descripcion').value = dat7;
                                                    
                                                    if (dat8=='1')
                                                    {
                                                       document.getElementById('tiempodefault').value ='1'; 
                                                       document.getElementById('tiempodefault').text='Temporal';
                                                    }
                                                    else
                                                    {
                                                        document.getElementById('tiempodefault').value ='2'; 
                                                       document.getElementById('tiempodefault').text='Indefinido';
                                                    }
                                                     if (dat9=='1')
                                                    {
                                                       document.getElementById('generodefault').value ='1'; 
                                                       document.getElementById('generodefault').text='Masculino';
                                                    }
                                                    else
                                                    {
                                                        if (dat9=='2')
                                                        {
                                                           document.getElementById('generodefault').value ='2'; 
                                                       document.getElementById('generodefault').text='Femenino';
                                                        }
                                                        else
                                                        {
                                                           document.getElementById('generodefault').value ='3'; 
                                                       document.getElementById('generodefault').text='Indistinto';
                                                            
                                                        }
                                                       
                                                    }
                                                    if (dat11=='1')
                                                    {
                                                        document.getElementById('rangodefault').value ='1'; 
                                                       document.getElementById('rangodefault').text='de 18 a 25';
                                                    }
                                                    else
                                                    {
                                                        if (dat11=='2')
                                                        {
                                                          
                                                           document.getElementById('rangodefault').value ='2';  
                                                           document.getElementById('rangodefault').text='de 26 a 45';
                                                        }
                                                        else
                                                        {
                                                          
                                                             document.getElementById('rangodefault').value ='3';   
                                                                document.getElementById('rangodefault').text='Sin especificar';  
                                                            
                                                        }
                                                       
                                                    }
                                                    
                                                    
                                                     
                                                    
                                                    
                                                  
                                                 

// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                                                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                                                    var modal = $(this);
                                                    modal.find('.modal-title').text('Vacante  :  ' + dat2);
                                                    //modal.find('.modal-body input').val(recipient);
                                                });
        </script>
           
                    
<?php
include '../includes/footer.php';
?>
