<?php
session_start();
require_once 'class/model/Funcionario.php';
require_once 'class/model/Endereco.php';
require_once 'class/model/Encryptor.php';
require_once 'class/dao/FuncionarioDao.php';
require_once 'class/dao/EnderecoDao.php';
require_once 'class/fw/Conexao.php';
require_once 'class/validation/FuncionarioValidation.php';
require_once 'class/validation/EnderecoValidation.php';
require_once 'class/dao/CargoFuncionarioDao.php';
require_once 'class/model/CargoFuncionario.php';

$funcionario = new Funcionario();

$funcionario->setFilho(false);
$funcionario->setNome(trim($_POST['nome']));
$funcionario->setEmail(trim($_POST['email']));
$funcionario->setCpf(trim($_POST['cpf']));
$funcionario->setDataNascimento(trim($_POST['dataNascimento']));
$funcionario->setTelefone(trim($_POST['telefone']));

if ($_POST['filho'] == 'true') {
    $funcionario->setFilho(true);
}

$funcionario->setQuantidadeFilhos(trim($_POST['quantidadeFilhos']));

$encryptor = new Encryptor($funcionario->getCpf() . $funcionario->getEmail());
$funcionario->setId($encryptor->encrypt());


$endereco = new Endereco($funcionario);
$dataNow = new DateTime();

$dataNow = $dataNow->format('Y-m-d H:i:s:m');
$encryptorEnderecoId = new Encryptor($funcionario->getCpf() . $funcionario->getEmail() . $dataNow);

$endereco->setId($encryptorEnderecoId->encrypt());
$endereco->setCep(trim($_POST['cep']));
$endereco->setLogradouro(trim($_POST['logradouro']));
$endereco->setNumero(trim($_POST['numero']));
$endereco->setComplemento(trim($_POST['complemento']));
$endereco->setBairro(trim($_POST['bairro']));
$endereco->setCidade(trim($_POST['cidade']));

if ($_POST['estado'] == '0') {
    $endereco->setEstado(null);
} else {
    $endereco->setEstado($_POST['estado']);
};

$endereco->setFuncionario($funcionario);

$cargoFuncionario = new CargoFuncionario();
$cargoFuncionario->setCargoId($_POST['__cargo']);
$cargoFuncionario->setFuncionarioId($funcionario->getId());

$funcionarioDao = new FuncionarioDao($conexao, $funcionario);
$enderecoDao = new EnderecoDao($conexao, $endereco);
$funcionarioValida = new FuncionarioValidation($funcionario, $funcionarioDao);
$enderecoValida = new EnderecoValidation($endereco);

$funcionarioErros = $funcionarioValida->funcionarioValidation($conexao);
$enderecoErros = $enderecoValida->enderecoValidation();
$funcionarioData = $funcionarioValida->recuperaDadosInseridos();
$enderecoData = $enderecoValida->recuperaDadosInseridos();

$cargoVeri = false;
if (!empty($_POST['__cargo'])) {
    $cargoEscolhido['cargoEscolha'] = $_POST['__cargo'];
    $_SESSION['cargoEscolha'] = $cargoEscolhido;
} else {
    $cargoErro['cargo'] = "Campo obrigátorio";
    $_SESSION['cargoErro'] = $cargoErro;
    $cargoVeri  = true;
}

if (sizeof($funcionarioErros) > 0 || sizeof($enderecoErros) > 0 || $cargoVeri) {
    $_SESSION['funcionarioErros'] = $funcionarioErros;
    $_SESSION['enderecoErros'] = $enderecoErros;
    $_SESSION['funcionario'] = $funcionarioData;
    $_SESSION['endereco'] = $enderecoData;
    echo "<script> location.href= 'funcionario-form.php';</script>";
    exit();
} else {
    $infortResult = true;
    $funcionarioDao = new FuncionarioDao($conexao, $funcionario);
    $enderecoDao = new EnderecoDao($conexao, $endereco);
    $cargoFuncDao = new CargoFuncionarioDao($conexao, $cargoFuncionario);
    if ($funcionarioDao->gravar()) {
        $enderecoDao->gravar();
        $cargoFuncDao->gravar();
    } else {
        $infortResult = false;
    }
    $_SESSION['funcionarioCadastrar'] = $infortResult;
    echo "<script>location.href = 'funcionarios.php';</script>";
}
