<?php include 'menu.php';
require_once 'class/dao/CargoDao.php';
require_once 'class/model/Cargo.php';

/*if ((empty($_SESSION['__usuarioConectado'])) && ($basename != "index")) {
    $_SESSION['__fazerLogin'] = "error";
    header('Location: /');
    exit;
}*/

$cargo = new Cargo();
$cargoDao = new CargoDao($conexao, $cargo);
$cargos = $cargoDao->selectPorcetagem();
?>
<div class="page-menu">
    <ul class="menu-list">
        <li class="navlink">
            <a href="funcionarios.php" class="navcation font-primary-bold_mediun active">Filtrar</a>
        </li>
        <li class="navlink">
            <a href="funcionario-form.php" class="navcation font-primary-bold_mediun">Cadastrar</a>
        </li>
        <li class="navlink">
            <a href="localiza-funcionario.php" class="navcation font-primary-bold_mediun">Localizar</a>
        </li>
        <li class="navlink active">
            <a href="grafico-cargos-funcionarios.php" class="navcation font-primary-bold_mediun active">Gráfio</a>
        </li>
        <li class="navlink">
            <a href="funcionarios-relatorio.php" class="navcation font-primary-bold_mediun">Relatório</a>
        </li>
    </ul>
</div>
<div class="base-grafica percentual-func">
    <div class="grafico-container">
        <h6 class="text-center">Percentual de funcionário por cargo</h6>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    // Create the chart
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: ''
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> do total<br/>'
        },

        series: [{
            name: 'Cargo',
            colorByPoint: true,
            data: [
                <?php
                $total = 0;
                foreach ($cargos as $cargo) {
                    $total += $cargo['total'];
                }
                for ($i = 0; $i < sizeof($cargos); $i++) :?>
                <?php if($i == sizeof($cargos) - 1) :?>
                {
                    name: '<?php echo $cargos[$i]["nome"]?>',
                    y: <?php echo ($cargos[$i]['total'] / $total) * 100 ?>
                }
                <?php
                endif;
                ?>
                <?php if($i != sizeof($cargos) - 1) :?>
                {
                    name: '<?php echo $cargos[$i]["nome"]?>',
                    y: <?php echo ($cargos[$i]['total'] / $total) * 100?>
                },
                <?php
                endif;
                ?>
                <?php
                endfor;
                ?>]
        }]
    });
});
		</script>
<div id="container" style="max-width: 600px; min-width: 350px; height: 400px; margin: 0 auto"></div>
    </div>
</div>
<?php include 'footer.php'; ?>