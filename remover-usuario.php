<?php
session_start();
require_once 'class/model/Usuario.php';
require_once 'class/model/Funcionario.php';
require_once 'class/dao/UsuarioDao.php';
require_once 'class/fw/Conexao.php';

$funcionario = new Funcionario();

$funcionario->setId($_POST['funcionarioId']);

$usuario = new Usuario();
$usuario->setFuncionario($funcionario);

$usuarioDao = new UsuarioDao($conexao, $usuario);

$resultado = $usuarioDao->deletar();