<?php
session_start();
require_once 'class/dao/CargoDao.php';
require_once 'class/model/Cargo.php';
require_once 'class/fw/Conexao.php';

$cardoId = $_POST['cargoId'];

$cargo = new Cargo();
$cargo->setId($cardoId);
$cargoDao = new CargoDao($conexao, $cargo);
$resultado = false;
if ($cargoDao->deletar()) {
	$resultado = true;
} 
$_SESSION['cargoDeletado'] = $resultado;
header('Location: /lista-cargos.php');