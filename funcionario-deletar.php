<?php
session_start();

require_once 'class/model/Funcionario.php';
require_once 'class/model/Endereco.php';
require_once 'class/dao/FuncionarioDao.php';
require_once 'class/dao/EnderecoDao.php';
require_once 'class/fw/Conexao.php';
require_once 'class/dao/CargoFuncionarioDao.php';
require_once 'class/model/CargoFuncionario.php';
require_once 'class/dao/CargoFuncionarioDao.php';
require_once 'class/model/Usuario.php';
require_once 'class/dao/UsuarioDao.php';

$funcId = $_POST['funci_id'];


$funcionario = new Funcionario();
$funcionario->setId($funcId);
$endereco = new Endereco($funcionario);

$enderecoDao = new EnderecoDao($conexao, $endereco);
$funcionarioDao = new FuncionarioDao($conexao, $funcionario);

$user = new Usuario();
$user->setFuncionario($funcionario);

$userDao = new UsuarioDao($conexao, $user);
$userDao->deletar();

$cargoFuncionario = new CargoFuncionario();
$cargoFuncionario->setFuncionarioId($funcionario->getId());
$cargoFuncionarioDao = new CargoFuncionarioDao($conexao, $cargoFuncionario);

$cargoFuncionarioDao->deletar();
$enderecoDao->deletar();

$deletaResultado = false;

if ($funcionarioDao->deletar()) {
    $deletaResultado = true;
    $_SESSION['deleteResult'] = $deletaResultado;
}
header('Location: /funcionarios.php');

