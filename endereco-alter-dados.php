<?php
session_start();
require_once 'class/model/Funcionario.php';
require_once 'class/model/Endereco.php';
require_once 'class/dao/EnderecoDao.php';
require_once 'class/fw/Conexao.php';
require_once 'class/validation/EnderecoValidation.php';

if(empty($_POST['funcionarioId'])) {
    echo "<script>location.href = '/funcionarios.php';</script>";
    exit();
}

$imageFolder = "users-image";

$funcionario = new Funcionario();
$funcionario->setId($_POST['funcionarioId']);

$endereco = new Endereco($funcionario);
$endereco->setId($_POST['id']);
$endereco->setCep($_POST['cep']);
$endereco->setLogradouro($_POST['logradouro']);
$endereco->setNumero($_POST['numero']);
$endereco->setComplemento($_POST['complemento']);
$endereco->setBairro($_POST['bairro']);
$endereco->setCidade($_POST['cidade']);
$endereco->setEstado($_POST['estado']);

$enderecoValida = new EnderecoValidation($endereco);
$enderecoErros = $enderecoValida->enderecoValidation();
$enderecoData = $enderecoValida->recuperaDadosInseridos();

$resultInfo = '';
$resultType = array();
if (sizeof($enderecoErros) > 0) {
    $_SESSION['enderecoErros'] = $enderecoErros;
    $_SESSION['endereco'] = $enderecoData;
    $_SESSION['enderecoId'] = $endereco->getId();
    echo "<script>location.href = '/endereco-alterar.php';</script>";
    exit();
} else {
    $enderecoDao = new EnderecoDao($conexao, $endereco);
    $updateResult = $enderecoDao->update();
    $resultado = false;
    if ($updateResult) {
        $resultado = true;
    }
    $_SESSION['enderecoAtualiza'] = $resultado;
    echo "<script>location.href = 'funcionarios.php';</script>";
}
