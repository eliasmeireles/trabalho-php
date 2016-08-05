<?php include 'menu.php';
require_once 'class/dao/FuncionarioDao.php';
require_once 'class/dao/EnderecoDao.php';
require_once 'class/dao/CargoDao.php';
require_once 'class/model/Cargo.php';
$funcionariosErros = array();
$enderecoErros = array();
$funcionario = array();
$endereco = array();
$cargoErro = array();
$cargoEscolhido = array();
$funciCargoId = "";

$cargo = new Cargo();
$cargoDao = new CargoDao($conexao, $cargo);
$cargos = $cargoDao->selectAll();

if (isset($_SESSION['funcionarioErros'])) {
    $funcionariosErros = $_SESSION['funcionarioErros'];
}
if (isset($_SESSION['enderecoErros'])) {
    $enderecoErros = $_SESSION['enderecoErros'];
}
if (isset($_SESSION['funcionario'])) {
    $funcionario = $_SESSION['funcionario'];
}
if (isset($_SESSION['endereco'])) {
    $endereco = $_SESSION['endereco'];
}
if (isset($_SESSION['cargoErro'])) {
    $cargoErro = $_SESSION['cargoErro'];
}
if (isset($_SESSION['cargoEscolha'])) {
    $cargoEscolhido = $_SESSION['cargoEscolha'];
}
?>
    <div class="page-menu">
        <ul class="menu-list">
            <li class="navlink">
                <a href="/funcionarios.php" class="navcation font-primary-bold_mediun active">Filtrar</a>
            </li>
            <li class="navlink active">
                <a href="funcionario-form.php" class="navcation font-primary-bold_mediun">Cadastrar</a>
            </li>
            <li class="navlink">
                <a href="localiza-funcionario.php" class="navcation font-primary-bold_mediun">Localizar</a>
            </li>
            <li class="navlink">
                <a href="grafico-cargos-funcionarios.php" class="navcation font-primary-bold_mediun active">Gráfio</a>
            </li>
            <li class="navlink">
                <a href="funcionarios-relatorio.php" class="navcation font-primary-bold_mediun">Relatório</a>
            </li>
        </ul>
    </div>
    <form action="cadastrar-funcionario.php" method="POST" class="form" enctype="multipart/form-data">
        <div class="form-container">
            <div class="input-conatiner">
                <div class="cool-form">
                    <?php include 'dados-pessoais-form.php'; ?>
                </div>
                <div class="cool-form">
                    <?php include 'endereco-form.php'; ?>
                </div>
            </div>
            <div class="button background-secondary btn-primary">
                <button type="submit" class="btn">Cadastrar</button>
            </div>
        </div>
    </form>

<?php unset($_SESSION['funcionario']); ?>
<?php unset($_SESSION['endereco']); ?>
<?php unset($_SESSION['funcionarioErros']); ?>
<?php unset($_SESSION['enderecoErros']); ?>
<?php unset($_SESSION['cargoErro']); ?>
<?php unset($_SESSION['cargoEscolha']) ?>
<?php include 'footer.php'; ?>