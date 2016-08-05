<?php
session_start();
require_once 'class/fw/Conexao.php';
require_once 'class/model/Usuario.php';
require_once 'class/model/Funcionario.php';
require_once 'class/dao/UsuarioDao.php';
require_once 'class/model/Encryptor.php';

if ((empty($_POST['__password']))) {
    header('Location: /');
    exit;
}

$encriptor = new Encryptor($_POST['__password']);
$senha = $cripted = $encriptor->encrypt();

$funcionario = new Funcionario();
$funcionario->setCpf($_POST['__funcionarioCpf']);

$usuario = new Usuario();
$usuario->setSenha($senha);
$usuario->setFuncionario($funcionario);

$usuarioDao = new UsuarioDao($conexao, $usuario);
$usuarioAtivo = $usuarioDao->select();

foreach ($usuarioAtivo as $user) {
    $funcionario->setId($user['id']);
    $funcionario->setNome($user['nome']);
    $funcionario->setEmail($user['email']);
    $funcionario->setCpf($user['cpf']);
    $funcionario->setDataNascimento($user['data_nascimento']);
    $funcionario->setTelefone($user['telefone']);
    $funcionario->setFilho($user['filho']);
    $funcionario->setQuantidadeFilhos($user['quantidade_filhos']);
    
}
if ($usuarioAtivo) {
    $_SESSION['__usuarioConectado'] = $funcionario;
    unset($_SESSION['__falhaLogin']);
    unset($_SESSION['__fazerLogin']);
} else {
    $_SESSION['__falhaLogin'] = 'erro';
}
header('Location: /');
