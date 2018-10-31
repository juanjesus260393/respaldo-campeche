<?php

include '../includes/header2.php';
?>
<div class="container" id="formulario" >
    <center><h3>Intención de paquete </h3></center>
            <form  enctype="multipart/form-data" action="../Controller/add_Eventos_controller.php" method="post">
           
                <table class="table" style="width: 100%;">
                    <tr>
                        <td>     
                            <label>Nombre:</label>
                        </td>
                        <td>
                            <input type="text" size="50" name="nombre" id="nombre">
                        </td>
                    </tr>
                    <tr>
                        <td>     
                            <label>Fecha</label>
                        </td>
                        <td>
                            <input type="date" size="50" name="fecha" id="fecha">
                        </td>
                    </tr>
                    <tr>
                        <td>     
                            <label>Descripción</label>
                        </td>
                        <td>
                            <input type="text" size="50" name="descripcion" id="descripcion">
                        </td>
                    </tr>
                    
                     <tr>
                        <td>     
                            <label>Total de personas</label>
                        </td>
                        <td>
                            <input type="number" name="totalpersona" id="totalpersona">
                        </td>
                    </tr>   
                    <tr>
                        <td colspan="2">
                    <div class="pull-right"><a href="#" onclick="AgregarCampos();">Añadir Actividad</a></div>
                      </td>
                    </tr>
                    <tr>
                        <div class="form-group row" id="campos">
                     
                      
                    </div>
                        
                    </tr>
                    <tr>
                        <td colspan="2">
                    <input type="submit" class="btn btn-primary" name="submit1" value="Agregar Intencion de paquete">
                        </td>
                    </tr>
            </table>
       </form>
        </div>

<script type="text/javascript">
var nextinput = 0;
function AgregarCampos(){
nextinput++;
campo='<label class="col-sm-1 form-control-label">'+nextinput+'</label><div class="col-md-3"><label>Campo</label><input type="text" name="texto'+nextinput+'"></div>';
 campo=campo . '<input type="hidden" name="final'+nextinput+'" value="'+(nextinput+1)+'">';
            
$("#campos").append(campo);
}
</script>


<?php
include '../includes/footer.php';
?>
