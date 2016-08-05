<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'World\'s largest cities per 2014'
        },
        subtitle: {
            text: 'Source: <a href="http://en.wikipedia.org/wiki/List_of_cities_proper_by_population">Wikipedia</a>'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Population in 2008: <b>{point.y:.1f} millions</b>'
        },
        series: [{
            name: 'Population',
            data: [
			
						<?php
						$conexao = mysqli_connect('localhost', 'root','');
						mysqli_select_db($conexao, 'trabalho_php');

						$sql="
								SELECT
									nome,salario, count(*) AS 'total'
								FROM
									cargo
								GROUP BY
									nome,salario
								ORDER BY
									nome,salario ASC
						";

						$dados = mysqli_query($conexao, $sql);
						$linhas = mysqli_num_rows($dados);

						for($x = 0; $x < $linhas; $x++){

							$linha = mysqli_fetch_assoc($dados);

							if($x + 1 == $linhas){
								echo " ['".$linha['nome']."', ".$linha['salario']."],";
							}else{
								echo " ['".$linha['nome']."', ".$linha['salario']."],";
							}
						
						}
						?>			
			],
            dataLabels: {
                enabled: true,
                rotation: 1,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 15, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
		</script>
	</head>
	<body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>

	</body>
</html>
