<?php
include '../includes/header2.php';
?>
<link rel="stylesheet" href="../estilo.css" />
<script src="../js/jquery.min.js"></script>
<script src="../js/highcharts/js/highcharts.js"></script>
<script src="../js/highcharts/js/themes/grid.js"></script>
<script src="../js/highcharts/js/modules/exporting.js"></script>

<<<<<<< HEAD
<div class="contendor">
    <div id="consulta">
        <h1>Cupones Canjeados Durante la Promocion</h1><hr>
        <table>
            <thead>
                <tr>
                    <th>Titulo del Cupon</th>
                    <th>Cantidad de cupones</th>
                    <th>Porcentaje Cupones Canjeados</th>
                    <th>Total de Cupones Canjeados</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("../model/conexion.php");
                $con = new Conectar();
                $fa = date('Y-m-d');
                $conexion = $con->con();
                $query = "select c.vigencia_inicio,c.vigencia_fin,c.titulo,c.limite_codigos,count(q.id_codigo_qr) as total from turista t inner join codigo_qr q on t.username = q.username
=======
        <link rel="stylesheet" href="../estilo.css" />
        <script src="../js/jquery.min.js"></script>
        <script src="../js/highcharts/js/highcharts.js"></script>
        <script src="../js/highcharts/js/themes/grid.js"></script>
        <script src="../js/highcharts/js/modules/exporting.js"></script>




        <div class="contendor">
            <div id="consulta">
                <h1>Cupones Canjeados Durante la Promocion</h1><hr>
                <table>
                    <thead>
                        <tr>
                            <th>Titulo del Cupon</th>
                            <th>Cantidad de cupones</th>
                            <th>Porcentaje Cupones Canjeados</th>
                            <th>Total de Cupones Canjeados</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../model/conexion.php");
                        $con = new Conectar();
                        $fa = date('Y-m-d');
                        $conexion = $con->con();
                        $query = "select c.vigencia_inicio,c.vigencia_fin,c.titulo,c.limite_codigos,count(q.id_codigo_qr) as total from turista t inner join codigo_qr q on t.username = q.username
>>>>>>> 19564775ee80b2b3c46f91cec6bd41109ff9f5fd
inner join cupon c on c.id_cupon = q.id_cupon inner join revision_objeto r on c.id_revision_objeto = r.id_revision_objeto where (c.vigencia_inicio <= '$fa' and c.vigencia_fin >= '$fa') and r.id_empresa = " . $_SESSION['idemp'] . " and q.canjeado = 1 group by c.id_cupon;";
                $result = mysqli_query($conexion, $query);
                $c = 0;
                $a = 0;
                $total = 0;
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $titulo[$c] = $row["titulo"];
                    $cantidadcupones[$c] = $row["limite_codigos"];
                    $cuponescanjeados1 = $row["total"];
                    $cuponescanjeados [$c] = $row["total"];
                    $c++;
                }
                for ($j = 0; $j <= $c - 1; $j++) {
                    $a++;
                    echo "<tr><td>" . $titulo[$j];
                    echo "</td><td>" . $cantidadcupones[$j];

<<<<<<< HEAD
                    echo "</td><td>" . number_format(($cuponescanjeados[$j] * 100) / $cantidadcupones[$j]) . "%";
                    $por[$j] = round(($cuponescanjeados[$j] * 100) / $cantidadcupones[$j], 1);
                    echo "</td><td>" . $cuponescanjeados[$j];
                }
                mysqli_close($conexion);
                ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        $(function () {
            var colors = Highcharts.getOptions().colors,
                    categories = [<?php
                for ($y = 0; $y <= $c - 1; $y++) {
                    echo "'" . $titulo[$y] . "',";
                }
                ?>],
                    name = 'Cupones',
                    data = [
=======
                            echo "</td><td>" . number_format(($cuponescanjeados[$j] * 100) / $cantidadcupones[$j]) . "%";
                            $por[$j] = round(($cuponescanjeados[$j] * 100) / $cantidadcupones[$j], 1);
                            echo "</td><td>" . $cuponescanjeados[$j];
                        }
                        mysqli_close($conexion);
                        ?>
                    </tbody>
                </table>
            </div>
            <script type="text/javascript">
                $(function () {
                    var colors = Highcharts.getOptions().colors,
                            categories = [<?php
                        for ($y = 0; $y <= $c - 1; $y++) {
                            echo "'" . $titulo[$y] . "',";          
                        }
                        ?>],
                            name = 'Cupones',
                            data = [
>>>>>>> 19564775ee80b2b3c46f91cec6bd41109ff9f5fd
<?php for ($x = 0; $x <= $c - 1; $x++) { ?>
                            {
                                y: <?php echo $por[$x] ?>,
                                color: colors[<?php echo $x ?>],
                            },
<?php } ?>
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
                    text: 'Porcentaje de Cupones que han sido Cambiados Durante la Promocion'
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
                                click: function () {
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
                            formatter: function () {
                                return this.y + ' %';
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
<?php
include '../includes/footer.php';
?>
