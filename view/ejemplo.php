<?php 

	require_once '../includes/header.php';

?>

	

        
	<table style='border: 1px solid black' align='center'>

        	<tr align='center'>
                	<th width='120' align='center'>Titulo</th>
	                <th width='220' align='center'>Descripcion</th>       
              		<th width='500' align='center'>Imagen Previa</th>
                	<th width='220' align='center'>Status</th>
                 	<th width='500' align='center'>Precio</th>
                  </tr>
	</table>

		<button class='btn-outline-primary'  data-toggle='modal' id='idcup' data-target='#exampleModal'>
			Ejemplo
		</button>


<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
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
                                                <label>Titulo del Video:</label>                    
                                                <input type="text" id="titulo" name="titulo" placeholder="Titulo del Video" readonly> 
                                                </span></div>
                                            <div class="row">
                                                <video id="videoo" style="width: 400px; height: 400px;" controls class="embed-responsive embed-responsive-16by9 z-depth-1-half"></video>                                               
                                                
                                            </div>
                                            </div>

                                        <div class="col-5 ">
                                            <div class="row"><span>
                                                    <label class="col-4">Precio:</label>
                                                    <input type="text" id="price" name="price" size="22" readonly>
                                                </span></div>
                                            <div class="row">
                                                <label class="col-3" for="Descripcion">Descripcion:</label><span>
                                                <textarea  id="Descripcion" name="Descripcion" rows="5" cols="40"  maxlength="490"  readonly></textarea>
                                                </span></div>

                                            <div class="row"><span>
                                                    <label class="col-4">Imagen Vista Previa:</label><span>
                                                        <img id='ImgVp' style="width: 190px; height: auto;"></span>
                                                </span></div>
                                            
                                        </div></div>
                                    <div class="form-group">
                                        <label for="messagetext" class="col-form-label">Comentario de Rechazo</label>
                                        <textarea id="messagetext" class="form-control" ></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>     
                            <button type="button" class="btn btn-primary" id="aprobar">Aprobar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" id="rechazar">Rechazar</button>
                        </div>
                    </div>
                </div>
            </div>








<?php 

       require_once '../includes/footer.php';

?>