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

if (empty($_POST['funci_id'])) {
    echo "<script>location.href = '/funcionarios.php';</script>";
}
$funcionario = new Funcionario();
$funcionario->setId($_POST['funci_id']);
$funcionarioDao = new FuncionarioDao($conexao, $funcionario);
$funcDados = $funcionarioDao->selectById();
?>
    <div class="page-container">
    <div class="page-menu">
        <ul class="menu-list">
            <li class="navlink active">
                <a href="funcionarios.php" class="navcation font-primary-bold_mediun">Filtrar</a>
            </li>
            <li class="navlink">
                <a href="grafico-cargos-funcionarios.php" class="navcation font-primary-bold_mediun">Gráfico</a>
            </li>
            <li class="navlink">
                <a href="funcionario-form.php" class="navcation font-primary-bold_mediun">Cadastrar</a>
            </li>
            <li class="navlink">
                <a href="localiza-funcionario.php" class="navcation font-primary-bold_mediun">Localizar</a>
            </li>
        </ul>
    </div>
    <h6 class="text-center">Dados complentos do funcionário</h6>
<?php include 'funcionario-dados.php' ?>
<?php include 'footer.php'; ?>