<?php
session_start();
require_once 'class/model/Funcionario.php';
require_once 'class/model/Encryptor.php';
require_once 'class/dao/FuncionarioDao.php';
require_once 'class/validation/FuncionarioValidation.php';
require_once 'class/dao/CargoFuncionarioDao.php';
require_once 'class/model/CargoFuncionario.php';

if(empty($_POST['funcionarioId'])) {
	echo "<script>location.href = '/funcionarios.php';</script>";
	exit();
}

$funcionario = new Funcionario();

$funcionario->setId($_POST['funcionarioId']);
$funcionario->setFilho(false);
$funcionario->setNome(trim($_POST['nome']));
$funcionario->setEmail(trim($_POST['email']));
$funcionario->setCpf(trim($_POST['cpf']));
$funcionario->setDataNascimento(trim($_POST['dataNascimento']));
$funcionario->setTelefone(trim($_POST['telefone']));
if ($_POST['filho'] == 'true'){$funcionario->setFilho(true);}
$funcionario->setQuantidadeFilhos($_POST['quantidadeFilhos']);

$encryptor = new Encryptor($funcionario->getCpf() . $funcionario->getEmail());


$funcionarioDao = new FuncionarioDao($conexao, $funcionario);
$funcionarioValida = new FuncionarioValidation($funcionario, $funcionarioDao);

$funcionarioErros = $funcionarioValida->funcionarioValidation($conexao);
$funcionarioData = $funcionarioValida->recuperaDadosInseridos();


$cargoFuncionario = new CargoFuncionario();
$cargoFuncionario->setCargoId($_POST['__cargo']);
$cargoFuncionario->setFuncionarioId($funcionario->getId());
$cargoFuncDao = new CargoFuncionarioDao($conexao, $cargoFuncionario);

$resultType = '';

if (sizeof($funcionarioErros) > 0) {
	$_SESSION['funcionarioErros'] = $funcionarioErros;
	$_SESSION['funcionario'] = $funcionarioData;
	$erroAlterar = array();
	$erroAlterar['id'] = $funcionario->getId();
	$_SESSION['id'] = $erroAlterar;
	echo "<script> location.href= 'alterar-func-dados.php';</script>";
	exit();
} else {
	$resultado = false;
	$funcionarioDao = new FuncionarioDao($conexao, $funcionario);
	if($funcionarioDao->update() && $cargoFuncDao->update()) {
		$resultado = true;
	}
	$_SESSION['funcionarioAtualizar'] = $resultado;
	echo "<script>location.href = '/funcionarios.php';</script>";
}
