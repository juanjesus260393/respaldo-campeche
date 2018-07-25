<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Proyecto Campeche 360</title>
        <link rel="stylesheet" href="../estilo.css" />
        <script src="../js/jquery.min.js"></script>
        <script src="../js/highcharts/js/highcharts.js"></script>
        <script src="../js/highcharts/js/themes/grid.js"></script>
        <script src="../js/highcharts/js/modules/exporting.js"></script>
    </head>
    <body>
        	<div class="contendor">
		<div id="consulta">
			<h1>Cantidad de Cupones Canjeados por dia</h1><hr>
			<table>
			<thead>
				<tr>
					<th>Titulo</th>
					<th>Cantidad de cupones</th>
                                        <th>Total</th>
				</tr>
			</thead>
			<tbody>
			<?php
			include("../model/conexion.php");
                        $con = new Conectar();
                        $conexion = $con->con();
			$query = 'select c.titulo, COUNT(r.id_revision_objeto) as total, r.status from cupon c inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto GROUP BY r.id_revision_objeto'; 
                        $result = mysqli_query($conexion, $query);
			$c=0;
			$a=0;
			$total=0;
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$categoria[$c] = $row["titulo"];
				$datos[$c] = $row["total"];  
				$total = $row["total"];
				$c++;
			}
			for ($j=0;$j<=$c-1;$j++)
			{
				$a++;
				echo "<tr><td>".$categoria[$j];
				echo "</td><td>".$datos[$j];
				echo "</td><td>".number_format((($datos[$j]/$total)*100), 1, ',', '')."%";
				$por[$j]= round( ($datos[$j]/$total)*100, 1);
			}
			mysqli_close($conexion);	  
			?>
			</tbody>
			</table>
		</div>
		<script type="text/javascript">
		$(function () {
			var colors = Highcharts.getOptions().colors,
			categories = [<?php for($y=0;$y<=$c-1;$y++){ echo "'".$categoria[$y]."',";}?>	],
			name = 'Cupones',
			data = [
			<?php for($x=0;$x<=$c-1;$x++){?>	
			{
				y: <?php echo $por[$x] ?>,
				color: colors[<?php echo $x?>],                   
			}, 
			<?php }?>	   
			];
			function setChart(name, categories, data, color) {
				chart.xAxis[0].setCategories(categories, false);
				chart.series[0].remove(false);
				chart.addSeries({
					name: name,
					data: data,
					color: color || 'white'
				}, false);
				chart.redraw();
			}
			var chart = $('#grafica').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: 'Cantidad de Cupones que han sido Cambiados por dia'
				},
				xAxis: {
					categories: categories
				},
				credits: {
					enabled: false
				},
				plotOptions: {
					column: {
						cursor: 'pointer',
						point: {
							events: {
								click: function() {
									var drilldown = this.drilldown;
									if (drilldown) { 
										setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
									} else { 
										setChart(name, categories, data);
									}
								}
							}
						},
						dataLabels: {
							enabled: true,
							color: colors[0],
							style: {
								fontWeight: 'bold'
							},
							formatter: function() {
								return this.y +' %';
							},
						}
					}
				},
				series: [{
					name: name,
					data: data,
					color: 'white'
				}],
				exporting: {
					enabled: true
				}
			})
			.highcharts(); 
		});
		</script>
		<div id="grafica"></div>
	</div>
    </body>
</html>