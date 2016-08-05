<?php
session_start();
require_once 'class/dao/CargoDao.php';
require_once 'class/model/Cargo.php';
require_once 'class/fw/Conexao.php';
$cargo = new Cargo();
$cargo->setBonificacao($_POST['bonus']);
$cargo->setId($_POST['cargo']);
$cargoDao = new CargoDao($conexao, $cargo);

$result = $cargoDao->updateBonificacao();
$resultado = false;

if ($result) {
    $resultado = true;
}
$_SESSION['resultadoBonificar'] = $resultado;
echo "<script>location.href = 'lista-cargos.php';</script>";