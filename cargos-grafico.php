<?php include 'menu.php';
require_once 'class/dao/CargoDao.php';
require_once 'class/model/Cargo.php';
$cargo = new Cargo();
$cargoDao = new CargoDao($conexao, $cargo);
$cargos = $cargoDao->selectAll();
$cargoAtivos = $cargoDao->selectAtivos();
?>
    <div class="page-menu">
        <ul class="menu-list">
            <li class="navlink ">
                <a href="/lista-cargos.php" class="navcation font-primary-bold_mediun">Lista</a>
            </li>
            <li class="navlink">
                <a href="/cargo-cadastro.php" class="navcation font-primary-bold_mediun">Adicionar</a>
            </li>
            <li class="navlink">
                <a href="/cad-bonificacao.php" class="navcation font-primary-bold_mediun">Bonificar</a>
            </li>
            <li class="navlink active">
                <a href="cargos-grafico.php" class="navcation font-primary-bold_mediun">Gráfico</a>
            </li>
        </ul>
    </div>
    <div class="base-grafica">
        <div class="grafico-container">
            <h6 class="text-center">Base salarial</h6>
            <script type="text/javascript"
                    src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
            <style type="text/css">
                ${demo.css}
            </style>
            <script type="text/javascript">
                $(function () {
                    $('#container').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: ''
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [{
                            data: [
                                <?php
                                for ($i = 0; $i < sizeof($cargos); $i++) :?>
                                <?php if($i == sizeof($cargos) - 1) :?>
                                {
                                    name: '<?php echo $cargos[$i]["nome"]?>',
                                    y: <?php echo $cargos[$i]["salario"] ?>
                                }
                                <?php
                                endif;
                                ?>
                                <?php if($i != sizeof($cargos) - 1) :?>
                                {
                                    name: '<?php echo $cargos[$i]["nome"]?>',
                                    y: <?php echo $cargos[$i]["salario"] ?>


                                    <?php if ($i == 0) {
                                    echo ', sliced: true,
                              selected: true';
                                }?>
                                },
                                <?php
                                endif;
                                ?>
                                <?php
                                endfor;
                                ?>
                            ],
                            name: 'Salário',
                            colorByPoint: true
                        }]
                    });
                });
            </script>
            <div id="container" style="min-width: 310px; overflow= hidden
    ; height: 400px; max-width: 850px; margin: 0 auto">
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>