<?php 

	require_once '../includes/header.php';

?>

	

        
	<table class="table" style='border: 1px solid grey; -moz-border-radius: 15px;' align='center'>
                
                     <thead class="thead-dark" align='center'>
			<tr>
                  	<th scope="col" width='120' align='center'>Titulo</th>
	                <th scope="col" width='220' align='center'>Descripcion</th>       
              		<th scope="col" width='500' align='center'>Imagen Previa</th>
                	<th scope="col" width='220' align='center'>Status</th>
                 	<th scope="col" width='500' align='center'>Precio</th>
                  </tr>
		  </thead>
		  <tbody>
		  <tr class='btn-outline-primary'>
			<td></td>
			<th></th>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr class='btn-outline-primary'>
			<td></td>
			<th></th>
			<td></td>
			<td></td>
			<td></td>
		  </tr>

		  </tbody>
	</table>

		<button class='btn-outline-primary'  data-toggle='modal' id='idcup' data-target='#exampleModal'>
			Ejemplo ventana modal
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
