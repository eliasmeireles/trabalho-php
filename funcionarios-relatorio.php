﻿<?php
session_start();
require_once 'class/fw/Conexao.php';
require_once 'class/dao/FuncionarioDao.php';
require_once 'class/model/Funcionario.php';

if ((empty($_SESSION['__usuarioConectado'])) && ($basename != "index")) {
    $_SESSION['__fazerLogin'] = "error";
    header('Location: /');
    exit;
}

$funcionario = new Funcionario();

$funcionarioDao = new FuncionarioDao($conexao, $funcionario);

$funcDados = $funcionarioDao->selectAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Aulas PHP</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="resources/css/reset.css">
    <link href="//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,700,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="resources/css/pages/relatorio.css">
</head>
<body>
<main>
    <div class="header">
        <div class="logo-container">
			<h1 class="logo">
				<img class="logo-image" alt="Foto do usuario" src="/resources/img/logo_system_plus_black.png">
			</h1>
            </div>
        <h3 class="data-gerada">
            <?php
            date_default_timezone_set('America/Sao_Paulo');
            $date = date('d/m/Y H:i');
            echo $date;
            ?>
        </h3>
    </div>
    <div class="list-result">
        <h4 class="relatorio-info">Funcionários da System Plus</h4>
        <table class="table-container">
            <tr class="background-secondary-dark_light">
                <th class="table-title">Nome</th>
                <th class="table-title">Cpf</th>
                <th class="table-title">Email</th>
                <th class="table-title">Telefone</th>
                <th class="table-title">Cargo</th>
            </tr>

            <?php foreach ($funcDados as $funcionario) : ?>
                <tr class="container-info">
                    <td class="table-data"><?php echo $funcionario['funcionarioNome'] ?></td>
                    <td class="table-data"><?php echo $funcionario['cpf'] ?></td>
                    <td class="table-data"><?php echo $funcionario['email'] ?></td>
                    <td class="table-data"><?php echo $funcionario['telefone'] ?></td>
                    <td class="table-data"><?php echo $funcionario['cargoNome']; ?></td>
                </tr>
                <?php
            endforeach;
            ?>

        </table>
    </div>
</main>
<footer class="footer">
    <span class="footer-info">Desenvolvido por System Plus</span>
</footer>
</body>
</html>
