<?php
session_start();
require_once 'class/fw/Conexao.php';
require_once 'class/model/Cargo.php';
require_once 'class/dao/CargoDao.php';

$cargo = new Cargo();
$cargo->setId($_POST['cargoId']);
$cargo->setNome(trim($_POST['cargoNome']));
$cargo->setSalario(trim($_POST['valorSalario']));

$cargoDao = new CargoDao($conexao, $cargo);
$result = $cargoDao->update();
$resultado = false;

if ($result) {
    $resultado = true;
}
$_SESSION['cargoAtualidado'] = $resultado;

echo "<script>location.href = 'lista-cargos.php';</script>";