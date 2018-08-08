<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Proyecto Campeche</title>

        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="../css/bootstrap.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../estilo.css" />
        <script src="../js/jquery.min.js"></script>
        <script src="../js/highcharts/js/highcharts.js"></script>
        <script src="../js/highcharts/js/themes/grid.js"></script>
        <script src="../js/highcharts/js/modules/exporting.js"></script>
    </head>
    <body>
        <?phprequire_once '../view/modals.php'; ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="margin:24px 0;">
                    <a class="navbar-brand" href="">Bienvenido : <?php printf($_SESSION['username']); ?></a>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navb">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link " href="../Controller/IniciodeSesion.php" >
                                    HOME
                                </a>

                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    Sitios
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="../Controller/ControladorSitios.php">Ver Sitios</a>
                                    <a class="dropdown-item" href="../Controller/add_Sitios_controller.php">Agregar Sitios</a>

                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="../Controller/crtCupones.php" id="navbardrop" data-toggle="dropdown">
                                                    Cupones
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="../Controller/crtCupones.php">Cupones  </a>
                                                    <a class="dropdown-item" href="../view/Addcupon.php">Agregar Cupon</a>

                                                </div>
                             </li>
                             <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle" href="../Controller/crtcVideos.php" id="navbardrop" data-toggle="dropdown">
                                                    Videos
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="../Controller/crtcVideos.php">Videos  </a>
                                                    <a class="dropdown-item" href="../view/Addvideo.php">Agregar Cupon</a>

                                                </div>
                             </li>
                             <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle" href="../Controller/crtcFlyers.php" id="navbardrop" data-toggle="dropdown">
                                                    Flyers & Banners
                                                </a>
                                                <div class="dropdown-menu">
                                                    <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#modalFlyer">Que es un Flyer???</button>
                                                    <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#modalBanner">Que es un Banner???</button>
                                                    <a class="dropdown-item" href="../Controller/crtcFlyers.php">Flyers & Banners  </a>
                                                    <a class="dropdown-item" href="../view/Addflyerybanner.php">Agregar Flyers & Banners</a>
                                                </div>
                             </li>
                             <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                                    Graficas
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="../Controller/crtEstadisticacupones.php">Estadisticas Cupones </a>
                                                    <a class="dropdown-item" href="#">  </a>
                                                </div>
                             </li>
                             <li class="nav-item dropdown">
                                 <a class="nav-link" href="../Controller/cambiaPass_controller.php" >
                                                    Cambia Contraseña
                                                </a>       
                             </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0" action="../Controller/cerrarSession.php">
                            <button class="btn btn-warning my-2 my-sm-0" type="submit">Cerrar Sesion</button>
                        </form>
                    </div>
                </nav>
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
                        $query = "select c.vigencia_inicio,c.vigencia_fin,c.titulo,c.limite_codigos,count(q.id_codigo_qr) as total from turista t inner join codigo_qr q on t.username = q.turista_username
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
    </body>
</html>