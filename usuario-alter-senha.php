<?php
session_start();
require_once 'class/fw/Conexao.php';
require_once 'class/dao/UsuarioDao.php';
require_once 'class/model/Usuario.php';
require_once 'class/model/Funcionario.php';
require_once 'class/model/Encryptor.php';

if (empty($_POST['password'])) {
    echo "<script>location.href = '/funcionarios.php';</script>";
    exit();
}
$funcionario = new Funcionario();
$funcionario->setId($_POST['funcionarioId']);

$usuario = new Usuario();

$encriptor = new Encryptor(trim($_POST['password']));
$senha = $encriptor->encrypt();

$usuario->setSenha($senha);
$usuario->setFuncionario($funcionario);

$usuarioDao = new UsuarioDao($conexao, $usuario);

$usuarioGravar = $usuarioDao->alterar();
$resultado = false;

if ($usuarioGravar) {
    $resultado = true;
}
$_SESSION['senhaAlterar'] = $resultado;
echo "<script>location.href = '/usuarios-lista.php';</script>";