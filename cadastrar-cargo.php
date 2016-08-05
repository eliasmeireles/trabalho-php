<?php
session_start();
require_once 'class/dao/CargoDao.php';
require_once 'class/model/Cargo.php';
require_once 'class/fw/Conexao.php';

$nome = $_POST['nome'];
$salario = $_POST['salario'];

$cargo = new Cargo();
$cargo->setNome($nome);
$cargo->setSalario($salario);
$cargoDao = new CargoDao($conexao, $cargo);

$gravar = $cargoDao->gravar();

if ($gravar) {
    $_SESSION['__cadastroCargo'] = "O novo cargo foi adicionado com sucesso!";
    $_SESSION['resultado'] = "sucesso";
} else {
    $_SESSION['__cadastroCargo'] = "Não foi possivel adicionar o novo cargo, certifique-se que o mesmo já está cadastrado no sistema!";
    $_SESSION['resultado'] = "error";
}
header('Location: /cargo-cadastro.php');