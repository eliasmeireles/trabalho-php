<?php
include 'menu.php'; ?>
<?php
require_once 'class/model/Funcionario.php';
require_once 'class/model/Endereco.php';
require_once 'class/dao/FuncionarioDao.php';
require_once 'class/dao/EnderecoDao.php';
require_once 'class/dao/CargoDao.php';
require_once 'class/model/Cargo.php';
require_once 'class/dao/CargoFuncionarioDao.php';
if (empty($_POST['funcionarioId'])) {
    echo "<script>location.href = '/lista-funcionarios.php';</script>";
}
$funcionario = new Funcionario();
$funcionario->setId($_POST['funcionarioId']);
$funcionarioDao = new FuncionarioDao($conexao, $funcionario);
$funcDados = $funcionarioDao->deletar();
?>
    <h6 class="text-center">Dados complentos do funcionário</h6>
<?php include 'funcionario-dados.php' ?>

    <div class="link-retornar">
        <a href="/lista-funcionarios.php" class="retornar">Retornar a lista</a>
    </div>
<?php include 'footer.php'; ?>